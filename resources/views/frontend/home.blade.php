<x-app-layout>
    <section class="bg-blue-600 text-white py-20 text-center">
        <h1 class="text-4xl font-bold mb-4">Sewa Truk Cepat, Harga Transparan</h1>
        <p class="text-lg mb-6">Solusi terpercaya untuk kebutuhan logistik Anda</p>

        <a href="{{ route('booking.create') }}"
           class="bg-white text-blue-600 px-6 py-3 rounded font-semibold">
            Book Now
        </a>
    </section>

    <section class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-8">Armada Kami</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($trucks as $truck)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $truck->name }}</h3>
                        <p>Max Weight: {{ $truck->max_weight }} kg</p>
                        <p>Volume: {{ $truck->total_volume }} CBM</p>
                        <p class="font-semibold mt-2">
                            Rp {{ number_format($truck->starting_price, 0, ',', '.') }} / km
                        </p>

                        <a href="{{ route('booking.create') }}"
                           class="inline-block mt-4 bg-gray-900 text-white px-4 py-2 rounded">
                            Cek Harga
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('trucks') }}"
                   class="px-4 py-2 border rounded">
                    Lihat Semua Armada
                </a>
            </div>
        </div>
    </section>
</x-app-layout>