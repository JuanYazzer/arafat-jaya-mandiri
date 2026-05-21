<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Booking
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Informasi Booking</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Nama Pelanggan</p>
                        <p class="font-semibold">{{ $booking->customer_name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Nomor WhatsApp</p>
                        <p class="font-semibold">{{ $booking->customer_phone }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Truk</p>
                        <p class="font-semibold">{{ $booking->truck->name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status Booking</p>
                        <p class="font-semibold">{{ ucfirst($booking->status) }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Jenis Barang</p>
                        <p class="font-semibold">{{ $booking->cargo_type }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Estimasi Harga</p>
                        <p class="font-semibold">
                            Rp {{ number_format($booking->estimated_price, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Berat Barang</p>
                        <p class="font-semibold">{{ $booking->cargo_weight }} kg</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Volume Barang</p>
                        <p class="font-semibold">{{ $booking->cargo_volume }} CBM</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Estimasi Jarak</p>
                        <p class="font-semibold">{{ $booking->distance_km }} km</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Booking</p>
                        <p class="font-semibold">{{ $booking->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500">Alamat Penjemputan</p>
                    <p class="font-semibold">{{ $booking->pickup_address }}</p>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-500">Alamat Tujuan</p>
                    <p class="font-semibold">{{ $booking->destination_address }}</p>
                </div>

                <hr class="my-6">

                <h3 class="text-lg font-semibold mb-4">Ubah Status Booking</h3>

                <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded">
                            <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>
                                Confirmed
                            </option>
                            <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                            <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                        </select>

                        @error('status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Update Status
                        </button>

                        <a href="{{ route('admin.bookings.index') }}"
                           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-admin-layout>