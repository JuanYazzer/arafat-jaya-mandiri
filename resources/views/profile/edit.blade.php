<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Statistics Block -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border-l-4 border-blue-600">
                    <div class="text-gray-500 text-sm font-medium">Total Pesanan Keseluruhan</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalBookings }} <span class="text-base font-normal text-gray-500">pesanan</span></div>
                </div>
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border-l-4 border-orange-500">
                    <div class="text-gray-500 text-sm font-medium">Pesanan Dikonfirmasi</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $confirmedBookings }} <span class="text-base font-normal text-gray-500">pesanan</span></div>
                </div>
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm font-medium">Pesanan Selesai</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $completedBookings }} <span class="text-base font-normal text-gray-500">pesanan</span></div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
