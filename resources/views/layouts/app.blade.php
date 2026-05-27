<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TruckRental') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        </main>

        <!-- Footer -->
        <footer class="bg-[#0f172a] text-gray-300 py-12 mt-16 border-t border-gray-800">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="grid md:grid-cols-2 gap-12">
                    <!-- Left: Company Info -->
                    <div>
                        <div class="flex items-center gap-2 text-white font-bold text-xl mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M8 7h10l3 3v6h-1m-14 0H4V7h4m0 0v10m12 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            TruckRental
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-sm leading-relaxed">
                                    Jatirangon, RT 010/002, Jatisampurna<br>
                                    Bekasi, Jawa Barat
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <p class="text-sm">+62 813-1513-1442</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right: FAQ Accordion -->
                    <div>
                        <h3 class="text-white font-semibold text-lg mb-6">Pertanyaan Umum</h3>
                        <div class="space-y-4" id="faq-accordion">
                            <!-- FAQ Item 1 -->
                            <div class="border-b border-gray-700 pb-2">
                                <button class="faq-button flex justify-between items-center w-full text-left text-sm py-2 hover:text-white transition-colors">
                                    Apakah bisa kirim luar kota?
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="faq-content hidden text-sm text-gray-400 pb-3 leading-relaxed">
                                    Ya, kami melayani pengiriman ke seluruh indonesia dengan harga kompetitif.
                                </div>
                            </div>
                            
                            <!-- FAQ Item 2 -->
                            <div class="border-b border-gray-700 pb-2">
                                <button class="faq-button flex justify-between items-center w-full text-left text-sm py-2 hover:text-white transition-colors">
                                    Barang apa saja yang tidak boleh di kirim?
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="faq-content hidden text-sm text-gray-400 pb-3 leading-relaxed">
                                    Barang terlarang meliputi: narkoba, senjata api, bahan peledak, dan barang illegal lainnya.
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="border-b border-gray-700 pb-2">
                                <button class="faq-button flex justify-between items-center w-full text-left text-sm py-2 hover:text-white transition-colors">
                                    Bagaimana cara pembayaran?
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="faq-content hidden text-sm text-gray-400 pb-3 leading-relaxed">
                                    Kami menerima transfer bank, e-wallet, dan cash. Pembayaran 50% di awal, sisanya setelah barang sampai.
                                </div>
                            </div>

                            <!-- FAQ Item 4 -->
                            <div class="border-b border-gray-700 pb-2">
                                <button class="faq-button flex justify-between items-center w-full text-left text-sm py-2 hover:text-white transition-colors">
                                    Berapa lama estimasi pengiriman?
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="faq-content hidden text-sm text-gray-400 pb-3 leading-relaxed">
                                    Tergantung jarak. Dalam kota 1-2 hari, luar kota 3-7 hari tergantung tujuan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-12 pt-8 text-center text-sm text-gray-500">
                    &copy; 2026 TruckRental. Hak Cipta Dilindungi.
                </div>
            </div>
        </footer>

        <!-- AI Chat Placeholder -->
        <div class="fixed bottom-6 right-6 z-50">
            <button class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg flex items-center justify-center transition-transform hover:scale-110 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <!-- Tooltip -->
                <span class="absolute -top-10 right-0 w-max bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                    Chat AI (FAQ)
                </span>
            </button>
        </div>
    </div>

    <!-- Script for FAQ Accordion -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.faq-button');
            
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const content = button.nextElementSibling;
                    const icon = button.querySelector('svg');
                    
                    // Close all other accordions (optional)
                    buttons.forEach(otherBtn => {
                        if (otherBtn !== button) {
                            otherBtn.nextElementSibling.classList.add('hidden');
                            otherBtn.querySelector('svg').style.transform = 'rotate(0deg)';
                        }
                    });

                    // Toggle current accordion
                    if (content.classList.contains('hidden')) {
                        content.classList.remove('hidden');
                        icon.style.transform = 'rotate(180deg)';
                    } else {
                        content.classList.add('hidden');
                        icon.style.transform = 'rotate(0deg)';
                    }
                });
            });
        });
    </script>
    </div>
</body>
</html>