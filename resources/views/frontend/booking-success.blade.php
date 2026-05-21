<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Berhasil
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold mb-4">Data Booking Berhasil Disimpan</h3>

                <div class="space-y-2">
                    <p><strong>Nama:</strong> {{ $booking->customer_name }}</p>
                    <p><strong>No. WhatsApp:</strong> {{ $booking->customer_phone }}</p>
                    <p><strong>Truk:</strong> {{ $booking->truck->name ?? '-' }}</p>
                    <p><strong>Jenis Barang:</strong> {{ $booking->cargo_type }}</p>
                    <p><strong>Berat:</strong> {{ $booking->cargo_weight }} kg</p>
                    <p><strong>Volume:</strong> {{ $booking->cargo_volume }} CBM</p>
                    <p><strong>Alamat Jemput:</strong> {{ $booking->pickup_address }}</p>
                    <p><strong>Alamat Tujuan:</strong> {{ $booking->destination_address }}</p>
                    <p><strong>Estimasi Jarak:</strong> {{ $booking->distance_km }} km</p>
                    <p>
                        <strong>Estimasi Harga:</strong>
                        Rp {{ number_format($booking->estimated_price, 0, ',', '.') }}
                    </p>
                    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                </div>

                @php
                    $message = "Halo Admin AJM, saya ingin konfirmasi booking truk.%0A%0A"
                        . "Nama: {$booking->customer_name}%0A"
                        . "No. WhatsApp: {$booking->customer_phone}%0A"
                        . "Truk: " . ($booking->truck->name ?? '-') . "%0A"
                        . "Jenis Barang: {$booking->cargo_type}%0A"
                        . "Berat: {$booking->cargo_weight} kg%0A"
                        . "Volume: {$booking->cargo_volume} CBM%0A"
                        . "Alamat Jemput: {$booking->pickup_address}%0A"
                        . "Alamat Tujuan: {$booking->destination_address}%0A"
                        . "Jarak: {$booking->distance_km} km%0A"
                        . "Estimasi Harga: Rp " . number_format($booking->estimated_price, 0, ',', '.');
                @endphp

                <div class="mt-6 flex gap-2">
                    <a href="https://wa.me/6281328356694?text={{ $message }}"
                       target="_blank"
                       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Konfirmasi via WhatsApp
                    </a>

                    <a href="{{ route('booking.create') }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Buat Booking Lagi
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>