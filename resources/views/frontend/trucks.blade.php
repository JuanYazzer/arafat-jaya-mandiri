<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pilih Armada
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('trucks') }}" class="mb-6">
                <select name="status" onchange="this.form.submit()" class="border-gray-300 rounded">
                    <option value="all">Semua Truk</option>
                    <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="in_use" {{ request('status') === 'in_use' ? 'selected' : '' }}>In Use</option>
                    <option value="repair" {{ request('status') === 'repair' ? 'selected' : '' }}>Repair</option>
                </select>
            </form>

            <div class="space-y-6">
                @foreach ($trucks as $truck)
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between">
                            <div>
                                <h3 class="text-xl font-bold">{{ $truck->name }}</h3>
                                <p>License Plate: {{ $truck->license_plate }}</p>
                                <p>Maximum Weight Capacity: {{ $truck->max_weight }} kg</p>
                                <p>Total Volume: {{ $truck->total_volume }} CBM</p>
                                <p>
                                    Starting Price:
                                    <strong>Rp {{ number_format($truck->starting_price, 0, ',', '.') }} / km</strong>
                                </p>

                                <p class="mt-2">
                                    Allowed Cargo:
                                    {{ $truck->allowed_cargo_types ? implode(', ', $truck->allowed_cargo_types) : '-' }}
                                </p>
                            </div>

                            <div>
                                @if ($truck->status === 'available')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded">
                                        Available
                                    </span>
                                @elseif ($truck->status === 'in_use')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded">
                                        In Use
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded">
                                        Repair
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if ($truck->status === 'available')
                            <a href="{{ route('booking.create') }}"
                               class="inline-block mt-4 bg-gray-900 text-white px-4 py-2 rounded">
                                Cek Harga
                            </a>
                        @else
                            <button class="mt-4 bg-gray-400 text-white px-4 py-2 rounded" disabled>
                                Tidak Tersedia
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>