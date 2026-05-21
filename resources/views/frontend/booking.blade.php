<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking & Estimasi Harga
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Pilih Truk</label>
                        <select name="truck_id" class="w-full border-gray-300 rounded">
                            <option value="">-- Pilih Truk --</option>
                            @foreach ($trucks as $truck)
                                <option value="{{ $truck->id }}" {{ old('truck_id') == $truck->id ? 'selected' : '' }}>
                                    {{ $truck->name }} - Rp {{ number_format($truck->starting_price, 0, ',', '.') }}/km
                                    - Kapasitas {{ $truck->max_weight }} kg / {{ $truck->total_volume }} CBM
                                </option>
                            @endforeach
                        </select>
                        @error('truck_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Nama Pelanggan</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                                   class="w-full border-gray-300 rounded">
                            @error('customer_name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Nomor WhatsApp</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}"
                                   placeholder="Contoh: 081234567890"
                                   class="w-full border-gray-300 rounded">
                            @error('customer_phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Berat Barang (Kg)</label>
                            <input type="number" name="cargo_weight" value="{{ old('cargo_weight') }}"
                                   class="w-full border-gray-300 rounded">
                            @error('cargo_weight')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Volume Barang (CBM)</label>
                            <input type="number" name="cargo_volume" value="{{ old('cargo_volume') }}"
                                   class="w-full border-gray-300 rounded">
                            @error('cargo_volume')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Jenis Barang</label>
                        <input type="text" name="cargo_type" value="{{ old('cargo_type') }}"
                               placeholder="Contoh: Furniture, Elektronik, dll"
                               class="w-full border-gray-300 rounded">
                        @error('cargo_type')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Alamat Penjemputan</label>
                        <textarea name="pickup_address" rows="3"
                                  class="w-full border-gray-300 rounded">{{ old('pickup_address') }}</textarea>
                        @error('pickup_address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Alamat Tujuan</label>
                        <textarea name="destination_address" rows="3"
                                  class="w-full border-gray-300 rounded">{{ old('destination_address') }}</textarea>
                        @error('destination_address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Estimasi Jarak (Km)</label>
                        <input type="number" name="distance_km" value="{{ old('distance_km') }}"
                               placeholder="Contoh: 50"
                               class="w-full border-gray-300 rounded">
                        @error('distance_km')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Buat Booking
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>