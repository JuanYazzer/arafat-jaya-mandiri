<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class ChatbotService
{
    private $apiKey;
    private $apiEndpoint;
    private $model = 'gemini-2.5-flash';
    private ?User $currentUser = null;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
        $this->apiEndpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent";
    }

    public function processMessage(string $userMessage, ?User $user = null)
    {
        $this->currentUser = $user;

        $messages = [
            ['role' => 'system', 'content' => $this->buildSystemPrompt()],
            ['role' => 'user', 'content' => $userMessage],
        ];

        $aiResponse = $this->callGeminiAPI($messages);
        $finalResponse = $this->processAIResponse($aiResponse);

        return $finalResponse;
    }

    private function buildSystemPrompt(): string
    {
        $truckInfo = $this->getTruckCatalog();

        return <<<PROMPT
Anda adalah asisten rekomendasi truk sederhana untuk platform BookingTruk Pro.

Instruksi penting:
- Tanggapi setiap permintaan sebagai satu sesi independen.
- Jangan mengingat percakapan sebelumnya.
- Bila pengguna memberikan detail lengkap dalam satu pesan, jawab langsung dengan rekomendasi truk.
- Bila pengguna ingin membuat booking, tanyakan semua informasi yang dibutuhkan sekaligus dalam satu pesan.
- Jangan langsung buat booking tanpa data lengkap.
- Bila informasi kurang jelas atau tidak lengkap, minta detail yang dibutuhkan sekali saja.
- Gunakan jawaban singkat dan profesional.
- Bila ingin menebalkan teks, gunakan format yang benar seperti **teks** atau <strong>teks</strong>, bukan placeholder acak.

Untuk booking, minta minimal:
1. ID atau nama truk yang diinginkan
2. Alamat penjemputan
3. Alamat tujuan
4. Jenis barang / cargo type
5. Berat barang (kg)
6. Volume barang (CBM)
7. Jarak perjalanan (km)
8. Nama pemesan
9. Nomor telepon pemesan

Informasi truk yang tersedia saat ini:
{$truckInfo}

Gunakan data ini saat merekomendasikan truk.
PROMPT;
    }

    private function getTruckCatalog(): string
    {
        $trucks = Truck::all();
        $catalog = "Katalog Truk Kami:\n";

        foreach ($trucks as $truck) {
            $catalog .= "- {$truck->name} (ID: {$truck->id}): ";
            $catalog .= "Kapasitas {$truck->capacity}kg, ";
            $catalog .= "Harga Rp{$truck->price_per_day}/hari, ";
            $catalog .= "Status: " . ($truck->status === 'available' ? 'Tersedia' : 'Tidak Tersedia') . "\n";
        }

        return $catalog;
    }

    private function callGeminiAPI(array $messages): array
    {
        // Convert messages to Gemini REST `contents` format
        $contents = array_map(function ($m) {
            $role = strtolower($m['role'] ?? 'user');

            // Gemini REST expects roles like 'USER' or 'MODEL'. 'system' is not supported,
            // so map it to 'MODEL' (system instructions sent as a model part).
            switch ($role) {
                case 'system':
                    $mappedRole = 'MODEL';
                    break;
                case 'model':
                    $mappedRole = 'MODEL';
                    break;
                case 'user':
                default:
                    $mappedRole = 'USER';
                    break;
            }

            return [
                'role' => $mappedRole,
                'parts' => [[
                    'text' => $m['content'] ?? '',
                ]],
            ];
        }, $messages);

        // Minimal valid REST payload: only `contents` is required by the REST endpoint.
        // Advanced options (temperature, config, function declarations) are handled
        // by the official SDKs or different fields per model; including them
        // directly caused HTTP 400 errors on some endpoints.
        $payload = [
            'contents' => $contents,
        ];

        $response = Http::withHeaders([
            'x-goog-api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiEndpoint, $payload);

        if (! $response->successful()) {
            $body = $response->body();
            throw new \Exception("Gemini API error: HTTP {$response->status()} - {$body}");
        }

        $json = $response->json();

        if (isset($json['error'])) {
            $err = is_array($json['error']) ? json_encode($json['error']) : $json['error'];
            throw new \Exception("Gemini API returned error: {$err}");
        }

        return $json;
    }

    private function defineTools(): array
    {
        return [
            [
                'name' => 'get_trucks',
                'description' => 'Get list of available trucks dengan filtering',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'capacity_min' => [
                            'type' => 'number',
                            'description' => 'Minimum kapasitas dalam kg',
                        ],
                        'capacity_max' => [
                            'type' => 'number',
                            'description' => 'Maximum kapasitas dalam kg',
                        ],
                        'type' => [
                            'type' => 'string',
                            'enum' => ['pickup', 'cargo', 'flatbed', 'refrigerated'],
                            'description' => 'Tipe truk',
                        ],
                    ],
                ],
            ],
            [
                'name' => 'check_availability',
                'description' => 'Check ketersediaan truk untuk tanggal tertentu',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'truck_id' => [
                            'type' => 'integer',
                            'description' => 'ID truk',
                        ],
                        'start_date' => [
                            'type' => 'string',
                            'description' => 'Tanggal mulai (YYYY-MM-DD)',
                        ],
                        'end_date' => [
                            'type' => 'string',
                            'description' => 'Tanggal selesai (YYYY-MM-DD)',
                        ],
                    ],
                    'required' => ['truck_id', 'start_date', 'end_date'],
                ],
            ],
            [
                'name' => 'get_recommendation',
                'description' => 'Get truck recommendation berdasarkan kebutuhan customer',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'cargo_type' => [
                            'type' => 'string',
                            'description' => 'Tipe barang yang akan dibawa',
                        ],
                        'cargo_weight' => [
                            'type' => 'number',
                            'description' => 'Berat barang dalam kg',
                        ],
                        'distance' => [
                            'type' => 'string',
                            'description' => 'Jarak perjalanan',
                        ],
                    ],
                ],
            ],
            [
                'name' => 'create_booking',
                'description' => 'Buat booking truk baru',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'truck_id' => [
                            'type' => 'integer',
                            'description' => 'ID truk',
                        ],
                        'pickup_address' => [
                            'type' => 'string',
                            'description' => 'Alamat penjemputan',
                        ],
                        'destination_address' => [
                            'type' => 'string',
                            'description' => 'Alamat tujuan',
                        ],
                        'cargo_type' => [
                            'type' => 'string',
                            'description' => 'Jenis barang',
                        ],
                        'cargo_weight' => [
                            'type' => 'integer',
                            'description' => 'Berat barang dalam kg',
                        ],
                        'cargo_volume' => [
                            'type' => 'integer',
                            'description' => 'Volume barang dalam CBM',
                        ],
                        'distance_km' => [
                            'type' => 'integer',
                            'description' => 'Jarak perjalanan dalam km',
                        ],
                    ],
                    'required' => ['truck_id', 'pickup_address', 'destination_address'],
                ],
            ],
        ];
    }

    private function processAIResponse(array $aiResponse): string
    {
        // Gemini REST returns candidates[].content.parts[].text and may include function_call in parts
        $candidate = $aiResponse['candidates'][0] ?? null;
        if (! $candidate) {
            return 'Maaf, saya tidak bisa memproses permintaan Anda.';
        }

        $content = $candidate['content'] ?? null;
        $part = $content['parts'][0] ?? null;
        if (! $part) {
            return 'Maaf, saya tidak bisa memproses permintaan Anda.';
        }

        // Function call handling (Gemini may return function_call on the part)
        if (isset($part['function_call']) && is_array($part['function_call'])) {
            $fc = $part['function_call'];
            $toolName = $fc['name'] ?? null;
            $toolArgs = $fc['args'] ?? ($fc['arguments'] ?? null);

            // Args may be an associative array or a JSON string
            if (is_string($toolArgs)) {
                $toolInput = json_decode($toolArgs, true) ?: [];
            } elseif (is_array($toolArgs)) {
                $toolInput = $toolArgs;
            } else {
                $toolInput = [];
            }

            if ($toolName) {
                $toolResult = $this->executeTool($toolName, $toolInput);

                // If the tool result looks like a list of trucks, render HTML snippet
                if (is_array($toolResult)) {
                    // Numeric array of trucks (each item has id or name)
                    $isList = array_values($toolResult) === $toolResult;
                    if ($isList && isset($toolResult[0]) && (isset($toolResult[0]['name']) || isset($toolResult[0]['id']))) {
                        return $this->renderTruckListHtml($toolResult);
                    }

                    // Associative result with message or status
                    if (isset($toolResult['message'])) {
                        return is_string($toolResult['message']) ? $toolResult['message'] : json_encode($toolResult['message'], JSON_UNESCAPED_UNICODE);
                    }

                    return json_encode($toolResult, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                }

                if (is_string($toolResult)) {
                    return $toolResult;
                }
            }
        }

        // Default: return text content
        return $part['text'] ?? 'Maaf, saya tidak bisa memproses permintaan Anda.';
    }

    private function executeTool(string $toolName, array $params): array
    {
        return match ($toolName) {
            'get_trucks' => $this->getTrucksFiltered($params),
            'check_availability' => $this->checkTruckAvailability($params),
            'get_recommendation' => $this->recommendTrucks($params),
            'create_booking' => $this->createBooking($params),
            default => ['error' => 'Tool tidak dikenali'],
        };
    }

    private function getTrucksFiltered(array $params): array
    {
        $query = Truck::query();

        if (isset($params['capacity_min'])) {
            $query->where('capacity', '>=', $params['capacity_min']);
        }
        if (isset($params['capacity_max'])) {
            $query->where('capacity', '<=', $params['capacity_max']);
        }
        if (isset($params['type'])) {
            $query->where('type', $params['type']);
        }

        return $query->where('status', 'available')->get()->toArray();
    }

    private function checkTruckAvailability(array $params): array
    {
        $truck = Truck::find($params['truck_id']);

        $bookings = Booking::where('truck_id', $params['truck_id'])
            ->exists();

        return [
            'truck_id' => $params['truck_id'],
            'available' => !$bookings,
            'message' => $bookings ? 'Truk sudah dipesan di tanggal tersebut' : 'Truk tersedia',
        ];
    }

    private function recommendTrucks(array $params): array
    {
        $cargoWeight = $params['cargo_weight'] ?? 1000;

        return Truck::where('capacity', '>=', $cargoWeight)
            ->where('status', 'available')
            ->orderBy('capacity')
            ->limit(3)
            ->get()
            ->map(fn ($t) => [
                'id' => $t->id,
                'name' => $t->name,
                'capacity' => $t->capacity,
                'price' => $t->price_per_day,
                'why_recommended' => "Cocok untuk barang {$params['cargo_type']} seberat {$cargoWeight}kg",
            ])
            ->toArray();
    }

    private function createBooking(array $params): array
    {
        $customerName = $params['customer_name'] ?? $this->currentUser?->name;
        $customerPhone = $params['customer_phone'] ?? 'Tidak Tersedia';
        $pickupAddress = $params['pickup_address'] ?? $params['pickup_location'] ?? '';
        $destinationAddress = $params['destination_address'] ?? $params['dropoff_location'] ?? '';
        $distanceKm = $params['distance_km'] ?? 0;
        $estimatedPrice = $params['estimated_price'] ?? 0;
        $cargoWeight = $params['cargo_weight'] ?? 0;
        $cargoVolume = $params['cargo_volume'] ?? 0;
        $cargoType = $params['cargo_type'] ?? 'Umum';

        if (empty($customerName)) {
            return [
                'success' => false,
                'message' => 'Nama customer tidak ditemukan. Mohon login atau sertakan nama Anda.',
            ];
        }

        if (empty($pickupAddress) || empty($destinationAddress)) {
            return [
                'success' => false,
                'message' => 'Alamat penjemputan dan tujuan diperlukan untuk membuat booking.',
            ];
        }

        try {
            $booking = Booking::create([
                'truck_id' => $params['truck_id'],
                'customer_name' => $customerName,
                'customer_phone' => $customerPhone,
                'cargo_weight' => $cargoWeight,
                'cargo_volume' => $cargoVolume,
                'cargo_type' => $cargoType,
                'pickup_address' => $pickupAddress,
                'destination_address' => $destinationAddress,
                'distance_km' => $distanceKm,
                'estimated_price' => $estimatedPrice,
                'status' => 'pending',
            ]);

            return [
                'success' => true,
                'booking_id' => $booking->id,
                'message' => "Booking berhasil dibuat! ID: {$booking->id}",
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Gagal membuat booking: ' . $e->getMessage(),
            ];
        }
    }

    private function renderTruckListHtml(array $trucks): string
    {
        $html = '<div class="space-y-4">';

        foreach ($trucks as $truck) {
            $id = htmlspecialchars($truck['id'] ?? '');
            $name = htmlspecialchars($truck['name'] ?? 'Unnamed Truck');
            $status = htmlspecialchars($truck['status'] ?? 'Tidak Tersedia');
            $maxWeight = number_format($truck['max_weight'] ?? ($truck['capacity'] ?? 0));
            $volume = htmlspecialchars($truck['total_volume'] ?? ($truck['total_volume'] ?? 0));
            $price = number_format($truck['starting_price'] ?? ($truck['price_per_day'] ?? ($truck['price'] ?? 0)), 0, ',', '.');

            // Resolve image url if present
            $img = $truck['image'] ?? null;
            if ($img && !str_starts_with($img, 'http') && !str_starts_with($img, '/')) {
                $img = asset('images/trucks/' . $img);
            }

            $html .= '<div class="truck-card bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden" id="truck-' . $id . '">';
            $html .= '<div class="grid md:grid-cols-3">';

            $html .= '<div class="md:col-span-1 bg-gray-100 flex items-center justify-center min-h-[140px]">';
            if ($img) {
                $html .= '<img src="' . htmlspecialchars($img) . '" alt="' . $name . '" class="w-full h-40 object-cover" />';
            } else {
                $html .= '<div class="text-gray-400 py-6 text-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M8 7h10l3 3v6h-1m-14 0H4V7h4m0 0v10" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg><div class="text-sm font-medium">Foto Segera Hadir</div></div>';
            }
            $html .= '</div>';

            $html .= '<div class="md:col-span-2 p-4">';
            $html .= '<div class="flex items-start justify-between mb-2">';
            $html .= '<div><h3 class="text-lg font-bold">' . $name . '</h3><p class="text-sm text-gray-600">Kapasitas: ' . $maxWeight . ' kg • Volume: ' . $volume . ' CBM</p></div>';
            $statusClass = strtolower($status) === 'available' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
            $html .= '<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ' . $statusClass . '">' . $status . '</span>';
            $html .= '</div>';

            $html .= '<div class="mt-3 flex items-center justify-between"><p class="text-xl font-bold text-blue-600">Rp ' . $price . ' <span class="text-sm text-gray-600">/ km</span></p>';
            if (strtolower($status) === 'available') {
                $html .= '<a href="/booking/create?truck=' . $id . '" class="inline-flex items-center rounded-md bg-blue-600 text-white h-10 px-4">Pesan</a>';
            } else {
                $html .= '<button disabled class="inline-flex items-center rounded-md bg-gray-300 text-gray-500 h-10 px-4">Tidak Tersedia</button>';
            }
            $html .= '</div>';

            if (!empty($truck['description'])) {
                $html .= '<p class="mt-3 text-sm text-gray-700">' . htmlspecialchars($truck['description']) . '</p>';
            }

            $html .= '</div>'; // detail col
            $html .= '</div></div>'; // grid + card
        }

        $html .= '</div>';
        return $html;
    }

    private function getConversationHistory(?User $user, int $limit = 5): array
    {
        return [];
    }

    private function saveChatHistory(?User $user, string $message, string $response): void
    {
        // Implement nanti untuk menyimpan history di database
    }
}
