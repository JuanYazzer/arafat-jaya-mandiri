@extends('layouts.frontend')

@section('content')
<div>
    <!-- Hero Section -->
    <section 
        class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20"
        style="background-image: linear-gradient(rgba(37, 99, 235, 0.9), rgba(29, 78, 216, 0.9)), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1600'); background-size: cover; background-position: center;"
    >
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Sewa Truk Cepat, Harga Transparan</h1>
            <p class="text-xl mb-8 text-blue-100">Solusi terpercaya untuk kebutuhan logistik Anda</p>
            <a href="{{ route('booking') }}" class="inline-block bg-white text-blue-600 hover:bg-gray-100 font-medium text-lg px-8 py-3 rounded-md shadow-sm transition">
                Book Now
            </a>
        </div>
    </section>

    <!-- Armada Kami -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Armada Kami</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Data Looping: Space for Backend Team -->
                @forelse($availableTrucks as $truck)
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden flex flex-col">
                    <img 
                        src="{{ $truck['image'] }}" 
                        alt="{{ $truck['name'] }}" 
                        class="w-full h-48 object-cover"
                    >
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="font-bold text-xl mb-2">{{ $truck['name'] }}</h3>
                        <div class="space-y-1 text-sm text-gray-600 mb-6 flex-grow">
                            <p>Max Weight: {{ number_format($truck['maxWeight']) }} kg</p>
                            <p>Volume: {{ $truck['volume'] }} CBM</p>
                            <p>Type: {{ $truck['type'] }}</p>
                        </div>
                        <a href="{{ route('trucks', ['selected' => $truck['id']]) }}" class="w-full inline-flex justify-center items-center h-10 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-medium transition">
                            Cek Harga
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500 py-8">
                    Tidak ada armada tersedia saat ini.
                </div>
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('trucks') }}" class="inline-flex justify-center items-center h-11 px-8 rounded-md border border-gray-200 bg-transparent hover:bg-gray-100 text-gray-900 font-medium transition text-lg">
                    Lihat Semua Armada
                </a>
            </div>
        </div>
    </section>

    <!-- Cara Sewa -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Cara Sewa</h2>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="search" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="font-semibold mb-2">1. Pilih Truk</h3>
                    <p class="text-gray-600 text-sm">Pilih truk sesuai kebutuhan Anda</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="file-text" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="font-semibold mb-2">2. Input Detail</h3>
                    <p class="text-gray-600 text-sm">Isi data barang dan alamat</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="check-circle" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="font-semibold mb-2">3. Dapatkan Estimasi</h3>
                    <p class="text-gray-600 text-sm">Lihat estimasi harga langsung</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="message-circle" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="font-semibold mb-2">4. Konfirmasi via WA</h3>
                    <p class="text-gray-600 text-sm">Hubungi kami untuk konfirmasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Pelanggan -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Testimoni Pelanggan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Data Looping: Space for Backend Team -->
                @forelse($testimonials as $testi)
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="relative flex h-12 w-12 shrink-0 overflow-hidden rounded-full bg-gray-100">
                            <img src="{{ $testi['photo'] }}" alt="{{ $testi['name'] }}">
                        </div>
                        <div>
                            <h4 class="font-semibold">{{ $testi['name'] }}</h4>
                            <p class="text-sm text-gray-600">{{ $testi['company'] }}</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"{{ $testi['quote'] }}"</p>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500">Belum ada testimoni.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap untuk Sewa Truk?</h2>
            <p class="text-xl mb-8 text-blue-100">Dapatkan penawaran terbaik hari ini!</p>
            <a href="{{ route('booking') }}" class="inline-block bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-md text-lg font-medium shadow-sm transition">
                Book Now
            </a>
        </div>
    </section>
</div>
@endsection
