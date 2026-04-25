@extends('layouts.frontend')

@section('content')
<div>
    <!-- Profil & Visi Misi -->
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

    <!-- Track Record -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Track Record Kami</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="p-8 text-center">
                        <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="award" class="h-8 w-8 text-blue-600"></i>
                        </div>
                        <div class="text-4xl font-bold text-blue-600 mb-2">11+</div>
                        <div class="text-gray-600">Tahun Pengalaman</div>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="p-8 text-center">
                        <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="truck" class="h-8 w-8 text-green-600"></i>
                        </div>
                        <div class="text-4xl font-bold text-green-600 mb-2">50+</div>
                        <div class="text-gray-600">Total Armada</div>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="p-8 text-center">
                        <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="users" class="h-8 w-8 text-purple-600"></i>
                        </div>
                        <div class="text-4xl font-bold text-purple-600 mb-2">5000+</div>
                        <div class="text-gray-600">Pelanggan Puas</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Legalitas -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Legalitas & Sertifikasi</h2>
            <div class="grid md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="p-6 text-center">
                        <i data-lucide="shield" class="h-12 w-12 text-blue-600 mx-auto mb-3"></i>
                        <h3 class="font-semibold mb-1">SIUP</h3>
                        <p class="text-sm text-gray-600">Surat Izin Usaha Perdagangan</p>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="p-6 text-center">
                        <i data-lucide="shield" class="h-12 w-12 text-green-600 mx-auto mb-3"></i>
                        <h3 class="font-semibold mb-1">TDP</h3>
                        <p class="text-sm text-gray-600">Tanda Daftar Perusahaan</p>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="p-6 text-center">
                        <i data-lucide="shield" class="h-12 w-12 text-purple-600 mx-auto mb-3"></i>
                        <h3 class="font-semibold mb-1">ISO 9001</h3>
                        <p class="text-sm text-gray-600">Quality Management</p>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="p-6 text-center">
                        <i data-lucide="shield" class="h-12 w-12 text-orange-600 mx-auto mb-3"></i>
                        <h3 class="font-semibold mb-1">NPWP</h3>
                        <p class="text-sm text-gray-600">Nomor Pokok Wajib Pajak</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mengapa Memilih Kami -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih Kami?</h2>
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center">
                            <i data-lucide="award" class="h-6 w-6 text-blue-600"></i>
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
                            <i data-lucide="shield" class="h-6 w-6 text-green-600"></i>
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
                            <i data-lucide="users" class="h-6 w-6 text-purple-600"></i>
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
                            <i data-lucide="truck" class="h-6 w-6 text-orange-600"></i>
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
