<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Booking
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Booking Masuk</h3>

                    <a href="{{ route('admin.dashboard') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Kembali ke Dashboard
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border p-3">ID</th>
                                <th class="border p-3">Nama Pelanggan</th>
                                <th class="border p-3">No. WhatsApp</th>
                                <th class="border p-3">Truk</th>
                                <th class="border p-3">Jarak</th>
                                <th class="border p-3">Estimasi Harga</th>
                                <th class="border p-3">Status</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td class="border p-3">{{ $booking->id }}</td>
                                    <td class="border p-3 font-semibold">{{ $booking->customer_name }}</td>
                                    <td class="border p-3">{{ $booking->customer_phone }}</td>
                                    <td class="border p-3">{{ $booking->truck->name ?? '-' }}</td>
                                    <td class="border p-3">{{ $booking->distance_km }} km</td>
                                    <td class="border p-3">
                                        Rp {{ number_format($booking->estimated_price, 0, ',', '.') }}
                                    </td>
                                    <td class="border p-3">
                                        @if ($booking->status === 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-sm">
                                                Pending
                                            </span>
                                        @elseif ($booking->status === 'confirmed')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-sm">
                                                Confirmed
                                            </span>
                                        @elseif ($booking->status === 'completed')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">
                                                Completed
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">
                                                Cancelled
                                            </span>
                                        @endif
                                    </td>
                                    <td class="border p-3">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.bookings.show', $booking) }}"
                                               class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                Detail
                                            </a>

                                            <form action="{{ route('admin.bookings.destroy', $booking) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="border p-3 text-center">
                                        Belum ada data booking.
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