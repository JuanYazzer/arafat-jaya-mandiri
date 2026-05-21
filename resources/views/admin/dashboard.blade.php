<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Total Truk</p>
                    <h3 class="text-2xl font-bold">{{ $totalTrucks }}</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Truk Tersedia</p>
                    <h3 class="text-2xl font-bold">{{ $availableTrucks }}</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Truk Aktif</p>
                    <h3 class="text-2xl font-bold">{{ $inUseTrucks }}</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Maintenance</p>
                    <h3 class="text-2xl font-bold">{{ $repairTrucks }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Manajemen Truk</h3>
                    <a href="{{ route('admin.trucks.index') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded">
                        Kelola Truk
                    </a>

                    <a href="{{ route('admin.bookings.index') }}"
                        class="px-4 py-2 bg-green-600 text-white rounded">
                        Kelola Booking
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border p-3">ID</th>
                                <th class="border p-3">Nama Truk</th>
                                <th class="border p-3">Plat Nomor</th>
                                <th class="border p-3">Kapasitas</th>
                                <th class="border p-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trucks as $truck)
                                <tr>
                                    <td class="border p-3">{{ $truck->id }}</td>
                                    <td class="border p-3">{{ $truck->name }}</td>
                                    <td class="border p-3">{{ $truck->license_plate }}</td>
                                    <td class="border p-3">
                                        {{ $truck->max_weight }} kg / {{ $truck->total_volume }} CBM
                                    </td>
                                    <td class="border p-3">
                                        {{ ucfirst(str_replace('_', ' ', $truck->status)) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border p-3 text-center">
                                        Belum ada data truk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>