<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TruckRental') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50 flex flex-col min-h-screen">

    <!-- Navigation Header -->
    <header class="bg-white border-b sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16" x-data="{ mobileMenuOpen: false }">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-blue-600">
                    <i data-lucide="truck" class="w-8 h-8"></i>
                    <span class="font-bold text-xl tracking-tight">TruckRental</span>
                </a>

                <!-- Right Side Navigation & Actions -->
                <div class="hidden md:flex items-center gap-8">
                    <nav class="flex items-center gap-8 font-medium text-gray-600">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-600' : 'hover:text-blue-600' }}">Beranda</a>
                        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-blue-600' : 'hover:text-blue-600' }}">Tentang</a>
                        <a href="{{ route('trucks') }}" class="{{ request()->routeIs('trucks') ? 'text-blue-600' : 'hover:text-blue-600' }}">Armada</a>
                    </nav>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('booking') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium shadow-sm transition">
                            Booking Now
                        </a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-600">
                    <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                    <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen" style="display: none;"></i>
                </button>

                <!-- Mobile Menu Panel -->
                <div x-show="mobileMenuOpen" class="absolute top-16 left-0 w-full bg-white border-b shadow-lg md:hidden z-40" style="display: none;" @click.away="mobileMenuOpen = false">
                    <div class="flex flex-col p-4 space-y-4">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 py-2 border-b">Beranda</a>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-blue-600 py-2 border-b">Tentang</a>
                        <a href="{{ route('trucks') }}" class="text-gray-600 hover:text-blue-600 py-2 border-b">Armada</a>
                        <a href="{{ route('booking') }}" class="bg-blue-600 text-white text-center py-2 rounded-md font-medium mt-4">Booking Now</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-auto">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 text-white mb-6">
                        <i data-lucide="truck" class="w-6 h-6"></i>
                        <span class="font-bold text-xl">TruckRental</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed mb-6">
                        Penyedia jasa rental truk terpercaya untuk kebutuhan logistik Anda di seluruh Indonesia.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('trucks') }}" class="hover:text-blue-400">Sewa Truk Wingbox</a></li>
                        <li><a href="{{ route('trucks') }}" class="hover:text-blue-400">Sewa Truk Box</a></li>
                        <li><a href="{{ route('trucks') }}" class="hover:text-blue-400">Sewa Flatbed</a></li>
                        <li><a href="{{ route('trucks') }}" class="hover:text-blue-400">Logistik Proyek</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('about') }}" class="hover:text-blue-400">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-blue-400">Karir</a></li>
                        <li><a href="#" class="hover:text-blue-400">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-blue-400">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-blue-500 shrink-0"></i>
                            <span>Jl. Raya Logistik No. 123, Jakarta Selatan, 12345</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="w-5 h-5 text-blue-500 shrink-0"></i>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" class="w-5 h-5 text-blue-500 shrink-0"></i>
                            <span>info@truckrental.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-sm text-center text-gray-500">
                &copy; {{ date('Y') }} TruckRental. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
