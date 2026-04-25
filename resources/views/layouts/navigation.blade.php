<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> <div class="flex w-full justify-between items-center">
                <div class="shrink-0 flex items-center space-x-2">
                    <a href="/" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke-width="2">
                            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            <path d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1m-7-1a1 1 0 011 1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"></path>
                        </svg>
                        <span class="text-2xl font-bold text-gray-900">TruckRental</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:flex items-center">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-blue-600">
                        {{ __('About') }}
                    </x-nav-link>
                    <x-nav-link :href="route('trucks')" :active="request()->routeIs('trucks')">
                        {{ __('Trucks') }}
                    </x-nav-link>
                    <x-nav-link :href="route('booking')" :active="request()->routeIs('booking')">
                        {{ __('Booking') }}
                    </x-nav-link>

                    @guest
                        <a href="{{ route('contact') }}" class="ml-4 inline-flex items-center px-6 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:bg-gray-800 active:bg-gray-900 transition ease-in-out duration-150">
                            {{ __('Contact') }}
                        </a>
                        
                        <div class="flex items-center space-x-4 ml-4 border-l pl-4 border-gray-200">
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-blue-600 transition font-medium">Log in</a>
                            <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-blue-600 transition font-medium">Register</a>
                        </div>
                    @endguest

                    @auth
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endauth
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="..."> </button>
            </div>
        </div>
    </div>
    
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        </div>
</nav>