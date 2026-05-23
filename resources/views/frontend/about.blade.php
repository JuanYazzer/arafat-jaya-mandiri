@extends('layouts.app')

@section('content')
<div>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center mb-8">Tentang Kami</h1>

            <div class="max-w-3xl mx-auto space-y-6 text-gray-700">
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Profil Perusahaan</h2>
                    <p class="leading-relaxed">
                        TruckRental adalah perusahaan penyedia jasa rental truk terpercaya yang telah melayani ribuan pelanggan
                        di seluruh Indonesia sejak tahun 2015. Kami berkomitmen untuk memberikan layanan logistik terbaik dengan
                        armada lengkap dan harga yang kompetitif. Dengan pengalaman lebih dari 11 tahun, kami memahami kebutuhan
                        transportasi barang Anda dan siap memberikan solusi terbaik.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-4">Visi & Misi</h2>
                    <div class="space-y-3">
                        <div>
                            <h3 class="font-semibold text-lg">Visi</h3>
                            <p class="leading-relaxed">
                                Menjadi penyedia jasa rental truk nomor satu di Indonesia yang dikenal dengan pelayanan profesional,
                                armada berkualitas, dan harga transparan.
                            </p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Misi</h3>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Memberikan layanan logistik yang aman, cepat, dan terpercaya</li>
                                <li>Menyediakan armada truk yang terawat dan sesuai standar keselamatan</li>
                                <li>Memberikan harga yang kompetitif dan transparan kepada pelanggan</li>
                                <li>Meningkatkan kepuasan pelanggan melalui inovasi dan pelayanan terbaik</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Track Record Kami</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="p-8 text-center">
                        <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-blue-600 mb-2">11+</div>
                        <div class="text-gray-600">Tahun Pengalaman</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="p-8 text-center">
                        <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M8 7h10l3 3v6h-1m-14 0H4V7h4m0 0v10m12 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-green-600 mb-2">{{ $totalTrucks ?? 0 }}</div>
                        <div class="text-gray-600">Total Armada</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="p-8 text-center">
                        <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-purple-600 mb-2">5000+</div>
                        <div class="text-gray-600">Pelanggan Puas</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Legalitas & Sertifikasi</h2>
            <div class="grid md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <h3 class="font-semibold mb-1">SIUP</h3>
                        <p class="text-sm text-gray-600">Surat Izin Usaha Perdagangan</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <h3 class="font-semibold mb-1">TDP</h3>
                        <p class="text-sm text-gray-600">Tanda Daftar Perusahaan</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <h3 class="font-semibold mb-1">ISO 9001</h3>
                        <p class="text-sm text-gray-600">Quality Management</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <h3 class="font-semibold mb-1">NPWP</h3>
                        <p class="text-sm text-gray-600">Nomor Pokok Wajib Pajak</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih Kami?</h2>
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-2">Armada Terawat</h3>
                        <p class="text-gray-600">Semua truk kami selalu dalam kondisi prima dan terawat dengan baik</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="bg-green-100 rounded-full w-12 h-12 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-2">Harga Transparan</h3>
                        <p class="text-gray-600">Tidak ada biaya tersembunyi, semua biaya jelas dan transparan</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="bg-purple-100 rounded-full w-12 h-12 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-2">Driver Profesional</h3>
                        <p class="text-gray-600">Driver berpengalaman dan terlatih untuk mengantarkan barang Anda dengan aman</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="bg-orange-100 rounded-full w-12 h-12 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M8 7h10l3 3v6h-1m-14 0H4V7h4m0 0v10m12 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-2">Layanan 24/7</h3>
                        <p class="text-gray-600">Kami siap melayani Anda kapan saja, termasuk hari libur</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection