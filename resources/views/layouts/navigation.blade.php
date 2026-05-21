<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="text-blue-600 text-3xl">🚚</span>
                    <span class="text-2xl font-bold text-gray-900">TruckRental</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 font-medium">
                    Home
                </a>

                <a href="{{ route('about') }}"
                   class="{{ request()->routeIs('about') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 font-medium">
                    About
                </a>

                <a href="{{ route('trucks') }}"
                   class="{{ request()->routeIs('trucks') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 font-medium">
                    Trucks
                </a>

                <a href="{{ route('booking.create') }}"
                   class="{{ request()->routeIs('booking.*') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 font-medium">
                    Booking
                </a>

                <a href="{{ route('contact') }}"
                   class="bg-black text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800">
                    Contact
                </a>

                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="text-gray-700 hover:text-blue-600 font-medium">
                            Admin Panel
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>