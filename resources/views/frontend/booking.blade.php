@extends('layouts.app')

@section('content')
<div class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-8">Booking & Estimasi Harga</h1>

        <form method="POST" action="{{ route('booking.store') }}" id="booking-form">
            @csrf
            <div class="grid lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="lg:col-span-2">
                    <div class="rounded-xl border bg-card text-card-foreground shadow-sm bg-white">
                        <div class="p-6 border-b">
                            <h3 class="text-xl font-semibold leading-none tracking-tight">Form Booking</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            
                            <!-- Personal info dihilangkan karena mengambil langsung dari User Profile -->

                            <div class="space-y-2">
                                <label for="truck_id" class="text-sm font-medium leading-none">Pilih Truk *</label>
                                @php
                                    $trucks = \App\Models\Truck::where('status', 'available')->get();
                                    $selectedTruckId = old('truck_id', request('truck'));
                                @endphp
                                <select id="truck_id" name="truck_id" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    <option value="">Pilih truk yang sesuai</option>
                                    @foreach($trucks as $truck)
                                        <option value="{{ $truck->id }}" data-max-weight="{{ $truck->max_weight ?? 0 }}" data-volume="{{ $truck->total_volume ?? 0 }}" data-price="{{ $truck->starting_price ?? 0 }}" data-name="{{ $truck->name }}" {{ $selectedTruckId == $truck->id ? 'selected' : '' }}>
                                            {{ $truck->name }} - Max {{ $truck->max_weight ?? 0 }}kg, {{ $truck->total_volume ?? 0 }} CBM
                                        </option>
                                    @endforeach
                                </select>
                                @error('truck_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="cargo_weight" class="text-sm font-medium leading-none">Berat Barang (Kg) *</label>
                                    <input type="number" id="cargo_weight" name="cargo_weight" value="{{ old('cargo_weight') }}" required placeholder="Contoh: 1000" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-600">
                                    <p id="weight-error" class="text-sm text-red-600 hidden">Melebihi kapasitas maksimal truk!</p>
                                    @error('cargo_weight') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="cargo_volume" class="text-sm font-medium leading-none">Volume Barang (CBM) *</label>
                                    <input type="number" id="cargo_volume" name="cargo_volume" value="{{ old('cargo_volume') }}" required placeholder="Contoh: 5" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-600">
                                    <p id="volume-error" class="text-sm text-red-600 hidden">Melebihi kapasitas volume truk!</p>
                                    @error('cargo_volume') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="cargo_type" class="text-sm font-medium leading-none">Jenis Barang *</label>
                                <input type="text" id="cargo_type" name="cargo_type" value="{{ old('cargo_type') }}" required placeholder="Contoh: Furniture, Elektronik, dll" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-600">
                                @error('cargo_type') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="pickup_address" class="text-sm font-medium leading-none">Alamat Penjemputan *</label>
                                <textarea id="pickup_address" name="pickup_address" required rows="3" placeholder="Masukkan alamat lengkap penjemputan" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-600">{{ old('pickup_address') }}</textarea>
                                @error('pickup_address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="destination_address" class="text-sm font-medium leading-none">Alamat Tujuan *</label>
                                <textarea id="destination_address" name="destination_address" required rows="3" placeholder="Masukkan alamat lengkap tujuan" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-600">{{ old('destination_address') }}</textarea>
                                @error('destination_address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="distance_km" class="text-sm font-medium leading-none">Estimasi Jarak (Km) *</label>
                                <input type="number" id="distance_km" name="distance_km" value="{{ old('distance_km') }}" required placeholder="Contoh: 50" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-600">
                                <p class="text-sm text-gray-600">Anda bisa gunakan Google Maps untuk menghitung jarak</p>
                                @error('distance_km') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="rounded-xl border bg-card text-card-foreground shadow-sm bg-white sticky top-20">
                        <div class="p-6 border-b">
                            <h3 class="text-xl font-semibold leading-none tracking-tight">Estimasi Harga</h3>
                        </div>
                        <div class="p-6 space-y-6" id="summary-section" style="display: none;">
                            <div class="text-center py-6 bg-blue-50 rounded-lg">
                                <p class="text-sm text-gray-600 mb-2">Total Estimasi</p>
                                <p class="text-4xl font-bold text-blue-600" id="estimated-price">Rp 0</p>
                            </div>

                            <div class="space-y-3 text-sm">
                                <h3 class="font-semibold">Ringkasan:</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Truk:</span>
                                        <span class="font-medium" id="summary-truck-name">-</span>
                                    </div>
                                    <div class="flex justify-between" id="summary-weight-row">
                                        <span class="text-gray-600">Berat:</span>
                                        <span class="font-medium" id="summary-weight">- kg</span>
                                    </div>
                                    <div class="flex justify-between" id="summary-volume-row">
                                        <span class="text-gray-600">Volume:</span>
                                        <span class="font-medium" id="summary-volume">- CBM</span>
                                    </div>
                                    <div class="flex justify-between" id="summary-distance-row">
                                        <span class="text-gray-600">Jarak:</span>
                                        <span class="font-medium" id="summary-distance">- km</span>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t pt-4">
                                <p class="text-xs text-gray-500 mb-4">
                                    * Harga estimasi dapat berubah sesuai kondisi lapangan dan jarak aktual
                                </p>
                                <button type="submit" id="btn-submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white shadow hover:bg-blue-600/90 h-11 px-8 w-full">
                                    Buat Booking Sekarang
                                </button>
                            </div>
                        </div>
                        <div class="p-6 text-center text-gray-500" id="empty-state">
                            Isi form di samping untuk melihat estimasi harga
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const truckSelect = document.getElementById('truck_id');
    const weightInput = document.getElementById('cargo_weight');
    const volumeInput = document.getElementById('cargo_volume');
    const distanceInput = document.getElementById('distance_km');
    
    const weightError = document.getElementById('weight-error');
    const volumeError = document.getElementById('volume-error');
    
    const summarySection = document.getElementById('summary-section');
    const emptyState = document.getElementById('empty-state');
    const estimatedPriceEl = document.getElementById('estimated-price');
    const summaryTruckName = document.getElementById('summary-truck-name');
    const summaryWeight = document.getElementById('summary-weight');
    const summaryVolume = document.getElementById('summary-volume');
    const summaryDistance = document.getElementById('summary-distance');
    const btnSubmit = document.getElementById('btn-submit');

    function calculatePrice() {
        const selectedOption = truckSelect.options[truckSelect.selectedIndex];
        
        const weight = parseFloat(weightInput.value);
        const volume = parseFloat(volumeInput.value);
        const distance = parseFloat(distanceInput.value);

        if (!selectedOption || !selectedOption.value || isNaN(distance) || distance <= 0) {
            summarySection.style.display = 'none';
            emptyState.style.display = 'block';
            return;
        }

        summarySection.style.display = 'block';
        emptyState.style.display = 'none';

        const maxWeight = parseFloat(selectedOption.getAttribute('data-max-weight')) || 0;
        const maxVolume = parseFloat(selectedOption.getAttribute('data-volume')) || 0;
        const pricePerKm = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        
        // Validation visually
        if (weight > maxWeight) {
            weightError.classList.remove('hidden');
        } else {
            weightError.classList.add('hidden');
        }

        if (volume > maxVolume) {
            volumeError.classList.remove('hidden');
        } else {
            volumeError.classList.add('hidden');
        }

        summaryTruckName.textContent = selectedOption.getAttribute('data-name') || '-';
        summaryWeight.textContent = isNaN(weight) ? '- kg' : weight + ' kg';
        summaryVolume.textContent = isNaN(volume) ? '- CBM' : volume + ' CBM';
        summaryDistance.textContent = isNaN(distance) ? '- km' : distance + ' km';

        let estimatedPrice = 0;
        if (!isNaN(distance) && distance > 0) {
            let basePrice = pricePerKm * distance;
            let weightSurcharge = (!isNaN(weight) && weight > maxWeight * 0.8) ? basePrice * 0.1 : 0;
            estimatedPrice = Math.round(basePrice + weightSurcharge);
        }

        estimatedPriceEl.textContent = 'Rp ' + estimatedPrice.toLocaleString('id-ID');
        
        // Button state visual only (HTML5 required will handle the rest)
        if (weight > maxWeight || volume > maxVolume) {
            btnSubmit.classList.add('opacity-50');
        } else {
            btnSubmit.classList.remove('opacity-50');
        }
    }

    [truckSelect, weightInput, volumeInput, distanceInput].forEach(el => {
        el.addEventListener('input', calculatePrice);
        el.addEventListener('change', calculatePrice);
    });

    // Initial calculate if fields are pre-filled via old() or URL
    if(truckSelect.value && distanceInput.value) {
        calculatePrice();
    }
});
</script>
@endsection