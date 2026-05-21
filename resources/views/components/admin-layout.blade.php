<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - {{ config('app.name', 'TruckRental') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

        <!-- Sidebar Admin -->
        <aside class="w-64 bg-white border-r border-gray-200 min-h-screen fixed left-0 top-0">
            <div class="p-6 border-b">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <span class="text-blue-600 text-2xl">🚚</span>
                    <span class="text-xl font-bold text-gray-900">AdminPanel</span>
                </a>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-3 rounded-lg font-medium
                   {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.trucks.index') }}"
                   class="block px-4 py-3 rounded-lg font-medium
                   {{ request()->routeIs('admin.trucks.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    Kelola Truk
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                   class="block px-4 py-3 rounded-lg font-medium
                   {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    Kelola Booking
                </a>

                <a href="{{ route('home') }}"
                   class="block px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100">
                    Lihat Website
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 w-full p-4 border-t bg-white">
                <div class="mb-3">
                    <p class="text-sm text-gray-500">Login sebagai</p>
                    <p class="font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="w-full text-left px-4 py-3 rounded-lg font-medium text-red-600 hover:bg-red-50">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Konten Admin -->
        <div class="flex-1 ml-64">
            @isset($header)
                <header class="bg-white border-b">
                    <div class="px-8 py-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="p-8">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>
</html>