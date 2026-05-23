@extends('layouts.app')

@section('content')
<div class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Booking Berhasil Disimpan!</h1>
                <p class="text-gray-600 mt-2">Terima kasih, pesanan Anda telah masuk ke dalam sistem kami.</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="p-6 border-b bg-gray-50/50">
                    <h3 class="text-xl font-semibold text-gray-800">Detail Pesanan (ID: #INV-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }})</h3>
                </div>
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                        <div>
                            <span class="block text-gray-500 mb-1">Nama Pemesan</span>
                            <span class="font-medium text-gray-900">{{ $booking->customer_name }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">No. WhatsApp</span>
                            <span class="font-medium text-gray-900">{{ $booking->customer_phone }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Truk yang Dipilih</span>
                            <span class="font-medium text-gray-900">{{ $booking->truck->name ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Jenis Barang</span>
                            <span class="font-medium text-gray-900">{{ $booking->cargo_type }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Berat & Volume</span>
                            <span class="font-medium text-gray-900">{{ $booking->cargo_weight }} kg / {{ $booking->cargo_volume }} CBM</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Estimasi Jarak</span>
                            <span class="font-medium text-gray-900">{{ $booking->distance_km }} km</span>
                        </div>
                        <div class="md:col-span-2">
                            <span class="block text-gray-500 mb-1">Alamat Penjemputan</span>
                            <span class="font-medium text-gray-900">{{ $booking->pickup_address }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <span class="block text-gray-500 mb-1">Alamat Tujuan</span>
                            <span class="font-medium text-gray-900">{{ $booking->destination_address }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-50 p-6 flex flex-col md:flex-row md:items-center justify-between border-t border-blue-100">
                    <div>
                        <span class="block text-blue-800 text-sm font-medium mb-1">Total Estimasi Harga</span>
                        <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($booking->estimated_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            Status: Menunggu Konfirmasi
                        </span>
                    </div>
                </div>
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

            <div class="text-center space-y-4">
                <p class="text-gray-600">Untuk memproses pesanan Anda, silakan hubungi Customer Service kami via WhatsApp untuk konfirmasi dan negosiasi harga final.</p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-4">
                    <a href="https://wa.me/6281315131442?text={{ $message }}" target="_blank" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-[#25D366] text-white shadow hover:bg-[#128C7E] h-12 px-8 w-full sm:w-auto transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                        Lanjut Konfirmasi via WhatsApp
                    </a>
                    
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-white border border-gray-300 text-gray-700 shadow-sm hover:bg-gray-50 h-12 px-8 w-full sm:w-auto transition-colors">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection