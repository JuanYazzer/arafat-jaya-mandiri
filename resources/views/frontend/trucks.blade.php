@extends('layouts.frontend')

@section('content')
<div class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-8">Pilih Armada</h1>

        <!-- Filter Form -->
        <div class="mb-8 flex justify-center">
            <div class="w-64">
                <form action="{{ route('trucks') }}" method="GET" x-data>
                    <select 
                        name="filter" 
                        @change="$el.form.submit()"
                        class="flex h-10 w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                        <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>Semua Truk</option>
                        <option value="available" {{ $filter === 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="small" {{ $filter === 'small' ? 'selected' : '' }}>Kecil (&le; 5 ton)</option>
                        <option value="medium" {{ $filter === 'medium' ? 'selected' : '' }}>Sedang (5-8 ton)</option>
                        <option value="large" {{ $filter === 'large' ? 'selected' : '' }}>Besar (&gt; 8 ton)</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Data Looping: Space for Backend Team -->
            @forelse($trucks as $truck)
            @php
                $isSelected = $selectedId == $truck['id'];
                $statusColor = match($truck['status']) {
                    'Available' => 'bg-green-100 text-green-800',
                    'In Use'    => 'bg-yellow-100 text-yellow-800',
                    'Repair'    => 'bg-red-100 text-red-800',
                    default     => 'bg-gray-100 text-gray-800',
                };
            @endphp
            <div 
                id="truck-{{ $truck['id'] }}"
                class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden {{ $isSelected ? 'ring-2 ring-blue-600' : '' }}"
            >
                <div class="grid md:grid-cols-3 gap-0">
                    <div class="md:col-span-1">
                        <img
                            src="{{ $truck['image'] }}"
                            alt="{{ $truck['name'] }}"
                            class="w-full h-64 md:h-full object-cover"
                        >
                    </div>
                    <div class="md:col-span-2 p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h2 class="text-2xl font-bold mb-2">{{ $truck['name'] }}</h2>
                                    <p class="text-gray-600">License Plate: {{ $truck['licensePlate'] }}</p>
                                </div>
                                <span class="inline-flex items-center rounded-full border border-transparent px-2.5 py-0.5 text-xs font-semibold {{ $statusColor }}">
                                    {{ $truck['status'] }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <h3 class="font-semibold text-sm text-gray-600 mb-1">Maximum Weight Capacity</h3>
                                    <p class="text-lg font-semibold">{{ number_format($truck['maxWeight']) }} kg</p>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm text-gray-600 mb-1">Total Volume</h3>
                                    <p class="text-lg font-semibold">{{ $truck['volume'] }} CBM</p>
                                </div>
                                <div class="col-span-2">
                                    <h3 class="font-semibold text-sm text-gray-600 mb-1">Allowed Cargo Types</h3>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach($truck['allowedCargo'] as $cargo)
                                        <div class="inline-flex items-center rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-semibold text-gray-900">
                                            {{ $cargo }}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <h3 class="font-semibold text-sm text-gray-600 mb-1">Starting Price</h3>
                                    <p class="text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($truck['pricePerKm']) }} <span class="text-sm text-gray-600 font-normal">/ km</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            @if($truck['status'] === 'Available')
                            <a href="{{ route('booking', ['truck' => $truck['id']]) }}" class="w-full md:w-auto inline-flex items-center justify-center rounded-md font-medium px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 transition">
                                Cek Harga
                            </a>
                            @else
                            <button disabled class="w-full md:w-auto inline-flex items-center justify-center rounded-md font-medium px-4 py-2 bg-gray-300 text-gray-500 cursor-not-allowed">
                                Tidak Tersedia
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 py-12">
                Tidak ada truk yang sesuai dengan filter.
            </div>
            @endforelse
        </div>
    </div>
</div>

@if($selectedId)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectedElement = document.getElementById('truck-{{ $selectedId }}');
        if (selectedElement) {
            selectedElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>
@endif
@endsection
