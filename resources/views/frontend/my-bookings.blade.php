@extends('layouts.app')

@section('content')
<div class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Riwayat Pesanan Saya</h1>

        @if($bookings->isEmpty())
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-500 mb-6">Anda belum pernah melakukan pemesanan truk.</p>
                <a href="{{ route('trucks') }}" class="inline-flex items-center justify-center bg-blue-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Lihat Armada Kami
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($bookings as $booking)
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="border-b border-gray-100 bg-gray-50 px-6 py-4 flex items-center justify-between">
                        <div>
                            <span class="text-sm text-gray-500">Tanggal Booking:</span>
                            <span class="font-medium text-gray-900 ml-2">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'confirmed' => 'bg-blue-100 text-blue-800',
                                    'completed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusLabels = [
                                    'pending' => 'Menunggu Konfirmasi',
                                    'confirmed' => 'Dikonfirmasi',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                                $color = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                                $label = $statusLabels[$booking->status] ?? ucfirst($booking->status);
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                {{ $label }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h10l3 3v6h-1m-14 0H4V7h4m0 0v10m12 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0" />
                                    </svg>
                                    Detail Truk
                                </h3>
                                @if($booking->truck)
                                    <p class="font-medium text-gray-900">{{ $booking->truck->name }}</p>
                                    <p class="text-sm text-gray-600">Pelat: {{ $booking->truck->license_plate }}</p>
                                @else
                                    <p class="text-red-500 italic">Truk sudah tidak tersedia / dihapus</p>
                                @endif
                                
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <p class="text-sm text-gray-600 mb-1">Total Estimasi Harga:</p>
                                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($booking->estimated_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Rute Pengiriman
                                </h3>
                                <div class="relative pl-6 border-l-2 border-gray-200 space-y-6">
                                    <div class="relative">
                                        <div class="absolute -left-[29px] top-1 h-4 w-4 rounded-full border-4 border-white bg-blue-600"></div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Alamat Penjemputan</p>
                                        <p class="text-sm text-gray-900">{{ $booking->pickup_address }}</p>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute -left-[29px] top-1 h-4 w-4 rounded-full border-4 border-white bg-green-600"></div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Alamat Tujuan</p>
                                        <p class="text-sm text-gray-900">{{ $booking->destination_address }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 text-sm text-gray-600">
                                    Jarak Estimasi: <span class="font-semibold">{{ $booking->distance_km }} km</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
