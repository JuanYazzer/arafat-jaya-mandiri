@extends('layouts.app')

@section('content')
<div>
    <!-- Section: Tentang Kami -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center mb-8">Tentang Kami</h1>

            <div class="max-w-3xl mx-auto space-y-6 text-gray-700">
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Profil Perusahaan</h2>
                    <p class="leading-relaxed">
                        TruckRental adalah perusahaan penyedia jasa rental truk terpercaya yang telah melayani ribuan pelanggan
                        di seluruh Indonesia sejak tahun 2015. Kami berkomitmen untuk memberikan layanan logistik terbaik dengan
                        armada lengkap dan harga yang kompetitif.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-4">Visi & Misi</h2>
                    <div class="space-y-3">
                        <div>
                            <h3 class="font-semibold text-lg">Visi</h3>
                            <p class="leading-relaxed">
                                Menjadi penyedia jasa rental truk nomor satu di Indonesia yang dikenal dengan pelayanan profesional.
                            </p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Misi</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Layanan aman, cepat, dan terpercaya</li>
                                <li>Armada sesuai standar keselamatan</li>
                                <li>Harga transparan</li>
                                <li>Pelayanan inovatif</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Track Record -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Track Record Kami</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white shadow rounded-2xl p-8 text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        🏆
                    </div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">5+</div>
                    <div class="text-gray-600">Tahun Pengalaman</div>
                </div>

                <div class="bg-white shadow rounded-2xl p-8 text-center">
                    <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        🚚
                    </div>
                    <div class="text-4xl font-bold text-green-600 mb-2">5</div>
                    <div class="text-gray-600">Total Armada</div>
                </div>

                <div class="bg-white shadow rounded-2xl p-8 text-center">
                    <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        👥
                    </div>
                    <div class="text-4xl font-bold text-purple-600 mb-2">100+</div>
                    <div class="text-gray-600">Pelanggan Puas</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Legalitas -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Legalitas & Sertifikasi</h2>

            <div class="grid md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                @php
                    $legalitas = [
                        ['title' => 'SIUP', 'desc' => 'Surat Izin Usaha Perdagangan'],
                        ['title' => 'TDP', 'desc' => 'Tanda Daftar Perusahaan'],
                        ['title' => 'ISO 9001', 'desc' => 'Quality Management'],
                        ['title' => 'NPWP', 'desc' => 'Nomor Pokok Wajib Pajak'],
                    ];
                @endphp

                @foreach($legalitas as $item)
                    <div class="bg-white shadow rounded-2xl p-6 text-center">
                        <div class="text-3xl mb-3">🛡️</div>
                        <h3 class="font-semibold mb-1">{{ $item['title'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section: Kenapa Memilih Kami -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih Kami?</h2>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                @php
                    $reasons = [
                        ['title' => 'Armada Terawat', 'desc' => 'Truk selalu dalam kondisi prima', 'icon' => '🏆'],
                        ['title' => 'Harga Transparan', 'desc' => 'Tanpa biaya tersembunyi', 'icon' => '🛡️'],
                        ['title' => 'Driver Profesional', 'desc' => 'Berpengalaman dan terlatih', 'icon' => '👥'],
                        ['title' => 'Layanan 24/7', 'desc' => 'Siap kapan saja', 'icon' => '🚚'],
                    ];
                @endphp

                @foreach($reasons as $item)
                    <div class="flex gap-4">
                        <div class="bg-gray-100 rounded-full w-12 h-12 flex items-center justify-center">
                            {{ $item['icon'] }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-2">{{ $item['title'] }}</h3>
                            <p class="text-gray-600">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection