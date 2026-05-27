@extends('layouts.app')

@section('content')
<div>
    <section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20"
        style="background-image: linear-gradient(rgba(37, 99, 235, 0.9), rgba(29, 78, 216, 0.9)), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1600'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Sewa Truk Cepat, Harga Transparan</h1>
            <p class="text-xl mb-8 text-blue-100">Solusi terpercaya untuk kebutuhan logistik Anda</p>
            <a href="{{ route('booking.create') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-10 px-8 py-2 bg-white text-blue-600 hover:bg-gray-100 text-lg">
                Pesan Sekarang
            </a>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Armada Kami</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($trucks as $truck)
                <div class="rounded-xl border bg-card text-card-foreground shadow overflow-hidden flex flex-col">
                    @if($truck->image)
                        @php
                            $imagePath = str_starts_with($truck->image, 'http') || str_starts_with($truck->image, '/') ? $truck->image : asset('images/trucks/' . $truck->image);
                        @endphp
                        <img src="{{ $imagePath }}" alt="{{ $truck->name }}" class="w-full h-48 object-cover" />
                    @else
                        <div class="w-full h-48 bg-gray-100 flex flex-col items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M8 7h10l3 3v6h-1m-14 0H4V7h4m0 0v10m12 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                            </svg>
                            <p class="text-xs font-medium">Foto Segera Hadir</p>
                        </div>
                    @endif
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="font-bold text-xl mb-2">{{ $truck->name }}</h3>
                        <div class="space-y-1 text-sm text-gray-600 mb-4 flex-1">
                            <p>Berat Maks: {{ number_format($truck->max_weight ?? 0) }} kg</p>
                            <p>Volume: {{ $truck->total_volume ?? 0 }} CBM</p>
                            <p>Harga: Rp {{ number_format($truck->starting_price ?? 0, 0, ',', '.') }} / km</p>
                        </div>
                        <a href="{{ route('trucks', ['selected' => $truck->id]) }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white shadow hover:bg-blue-600/90 h-9 px-4 py-2 w-full">
                            Cek Harga
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('trucks') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-10 px-8 py-2">
                    Lihat Semua Armada
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Cara Sewa</h2>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold mb-2">1. Pilih Truk</h3>
                    <p class="text-gray-600 text-sm">Pilih truk sesuai kebutuhan Anda</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold mb-2">2. Input Detail</h3>
                    <p class="text-gray-600 text-sm">Isi data barang dan alamat</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold mb-2">3. Dapatkan Estimasi</h3>
                    <p class="text-gray-600 text-sm">Lihat estimasi harga langsung</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold mb-2">4. Konfirmasi via WA</h3>
                    <p class="text-gray-600 text-sm">Hubungi kami untuk konfirmasi</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Testimoni Pelanggan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="rounded-xl border bg-card text-card-foreground shadow-sm p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="h-12 w-12 rounded-full overflow-hidden bg-gray-200">
                            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" alt="Budi Santoso" />
                        </div>
                        <div>
                            <h4 class="font-semibold">Budi Santoso</h4>
                            <p class="text-sm text-gray-600">PT Maju Mundur</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">&ldquo;Pelayanan sangat cepat dan armada dalam kondisi prima. Sangat membantu bisnis kami.&rdquo;</p>
                </div>
                <div class="rounded-xl border bg-card text-card-foreground shadow-sm p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="h-12 w-12 rounded-full overflow-hidden bg-gray-200">
                            <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=random" alt="Siti Aminah" />
                        </div>
                        <div>
                            <h4 class="font-semibold">Siti Aminah</h4>
                            <p class="text-sm text-gray-600">CV Sumber Rezeki</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">&ldquo;Harga sangat transparan, tidak ada biaya tersembunyi. Sopir juga sangat ramah.&rdquo;</p>
                </div>
                <div class="rounded-xl border bg-card text-card-foreground shadow-sm p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="h-12 w-12 rounded-full overflow-hidden bg-gray-200">
                            <img src="https://ui-avatars.com/api/?name=Agus+Pratama&background=random" alt="Agus Pratama" />
                        </div>
                        <div>
                            <h4 class="font-semibold">Agus Pratama</h4>
                            <p class="text-sm text-gray-600">Individu</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">&ldquo;Sangat mudah untuk booking truk saat pindahan rumah. Sangat direkomendasikan!&rdquo;</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap untuk Sewa Truk?</h2>
            <p class="text-xl mb-8 text-blue-100">Dapatkan penawaran terbaik hari ini!</p>
            <a href="{{ route('booking.create') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-10 px-8 py-2 bg-white text-blue-600 hover:bg-gray-100 text-lg">
                Pesan Sekarang
            </a>
        </div>
    </section>
</div>
@endsection