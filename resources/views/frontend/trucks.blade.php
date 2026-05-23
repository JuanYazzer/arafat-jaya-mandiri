@extends('layouts.app')

@section('content')
<div class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-8">Pilih Armada</h1>

        <div class="mb-8 flex justify-center">
            <div class="flex items-center gap-2 bg-white rounded-xl border border-gray-200 shadow-sm p-1.5">
                <button class="filter-btn px-5 py-2 rounded-lg text-sm font-medium bg-blue-600 text-white transition-all" data-filter="all">Semua Truk</button>
                <button class="filter-btn px-5 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition-all" data-filter="available">Available</button>
                <button class="filter-btn px-5 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition-all" data-filter="in_use">In Use</button>
                <button class="filter-btn px-5 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition-all" data-filter="repair">Repair</button>
            </div>
        </div>

        <div class="space-y-6" id="trucks-container">
            @foreach($trucks as $truck)
            <div class="truck-card bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden {{ request('selected') == $truck->id ? 'ring-2 ring-blue-600' : '' }}" 
                 data-status="{{ strtolower($truck->status) }}" 
                 data-weight="{{ $truck->max_weight ?? 0 }}"
                 id="truck-{{ $truck->id }}">
                
                <div class="grid md:grid-cols-3 gap-0">
                    <div class="md:col-span-1 bg-gray-100 flex items-center justify-center min-h-[200px] md:min-h-full">
                        @if($truck->image)
                            @php
                                $imagePath = str_starts_with($truck->image, 'http') || str_starts_with($truck->image, '/') ? $truck->image : asset('images/trucks/' . $truck->image);
                            @endphp
                            <img src="{{ $imagePath }}" alt="{{ $truck->name }}" class="w-full h-64 md:h-full object-cover" />
                        @else
                            <div class="flex flex-col items-center justify-center text-gray-400 py-12 px-4 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M8 7h10l3 3v6h-1m-14 0H4V7h4m0 0v10m12 0a2 2 0 11-4 0m-8 0a2 2 0 11-4 0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                </svg>
                                <p class="text-sm font-medium">Foto Segera Hadir</p>
                            </div>
                        @endif
                    </div>
                    <div class="md:col-span-2 p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="text-2xl font-bold mb-2">{{ $truck->name }}</h2>
                                <p class="text-gray-600">License Plate: {{ $truck->license_plate ?? '-' }}</p>
                            </div>
                            
                            @php
                                $statusColor = 'bg-gray-100 text-gray-800';
                                if(strtolower($truck->status) === 'available') $statusColor = 'bg-green-100 text-green-800';
                                elseif(strtolower($truck->status) === 'in use') $statusColor = 'bg-yellow-100 text-yellow-800';
                                elseif(strtolower($truck->status) === 'repair') $statusColor = 'bg-red-100 text-red-800';
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 {{ $statusColor }}">
                                {{ ucfirst($truck->status) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <h3 class="font-semibold text-sm text-gray-600 mb-1">Maximum Weight Capacity</h3>
                                <p class="text-lg font-semibold">{{ number_format($truck->max_weight ?? 0) }} kg</p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-sm text-gray-600 mb-1">Total Volume</h3>
                                <p class="text-lg font-semibold">{{ $truck->total_volume ?? 0 }} CBM</p>
                            </div>
                            <div class="col-span-2">
                                <h3 class="font-semibold text-sm text-gray-600 mb-1">Allowed Cargo Types</h3>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @php
                                        // Assume allowed_cargo_types is stored as JSON or string
                                        $cargos = is_array($truck->allowed_cargo_types) ? $truck->allowed_cargo_types : explode(',', $truck->allowed_cargo_types ?? 'General Cargo');
                                    @endphp
                                    @foreach($cargos as $cargo)
                                        <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">{{ trim($cargo) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-span-2">
                                <h3 class="font-semibold text-sm text-gray-600 mb-1">Starting Price</h3>
                                <p class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($truck->starting_price ?? 0, 0, ',', '.') }} <span class="text-sm text-gray-600 font-normal">/ km</span>
                                </p>
                            </div>
                            @if($truck->description)
                            <div class="col-span-2 border-t pt-4 mt-2">
                                <h3 class="font-semibold text-sm text-gray-600 mb-2">Deskripsi & Spesifikasi</h3>
                                <p class="text-sm text-gray-700 leading-relaxed">{{ $truck->description }}</p>
                            </div>
                            @endif
                        </div>

                        @if(strtolower($truck->status) === 'available')
                            <a href="{{ route('booking.create', ['truck' => $truck->id]) }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white shadow hover:bg-blue-600/90 h-10 px-8 py-2 w-full md:w-auto">
                                Cek Harga
                            </a>
                        @else
                            <button disabled class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-gray-300 text-gray-500 cursor-not-allowed h-10 px-8 py-2 w-full md:w-auto">
                                Tidak Tersedia
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.truck-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active button style
                filterBtns.forEach(b => {
                    b.classList.remove('bg-blue-600', 'text-white');
                    b.classList.add('text-gray-600', 'hover:bg-gray-100');
                });
                this.classList.add('bg-blue-600', 'text-white');
                this.classList.remove('text-gray-600', 'hover:bg-gray-100');

                const filter = this.getAttribute('data-filter');

                cards.forEach(card => {
                    const status = card.getAttribute('data-status');
                    const show = filter === 'all' || status === filter;
                    card.style.display = show ? 'block' : 'none';
                });
            });
        });

        // Auto scroll to selected truck if any
        const selectedId = new URLSearchParams(window.location.search).get('selected');
        if(selectedId) {
            const el = document.getElementById('truck-' + selectedId);
            if(el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
</script>
@endsection