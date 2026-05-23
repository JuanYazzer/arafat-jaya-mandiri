<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Truk
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.trucks.update', $truck) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Nama Truk</label>
                        <input type="text" name="name" value="{{ old('name', $truck->name) }}"
                               class="w-full border-gray-300 rounded">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Plat Nomor</label>
                        <input type="text" name="license_plate" value="{{ old('license_plate', $truck->license_plate) }}"
                               class="w-full border-gray-300 rounded">
                        @error('license_plate')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Kapasitas Berat (Kg)</label>
                            <input type="number" name="max_weight" value="{{ old('max_weight', $truck->max_weight) }}"
                                   class="w-full border-gray-300 rounded">
                            @error('max_weight')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-medium">Total Volume (CBM)</label>
                            <input type="number" name="total_volume" value="{{ old('total_volume', $truck->total_volume) }}"
                                   class="w-full border-gray-300 rounded">
                            @error('total_volume')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Harga per Km</label>
                        <input type="number" name="starting_price" value="{{ old('starting_price', $truck->starting_price) }}"
                               class="w-full border-gray-300 rounded">
                        @error('starting_price')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Jenis Barang yang Diizinkan</label>
                        <input type="text"
                               name="allowed_cargo_types"
                               value="{{ old('allowed_cargo_types', $truck->allowed_cargo_types ? implode(', ', $truck->allowed_cargo_types) : '') }}"
                               placeholder="Contoh: Furniture, Electronics, General Cargo"
                               class="w-full border-gray-300 rounded">
                        @error('allowed_cargo_types')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded">
                            <option value="available" {{ old('status', $truck->status) === 'available' ? 'selected' : '' }}>
                                Available
                            </option>
                            <option value="in_use" {{ old('status', $truck->status) === 'in_use' ? 'selected' : '' }}>
                                In Use
                            </option>
                            <option value="repair" {{ old('status', $truck->status) === 'repair' ? 'selected' : '' }}>
                                Repair
                            </option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Gambar / URL Gambar</label>
                        <input type="text" name="image" value="{{ old('image', $truck->image) }}"
                               placeholder="Contoh: truk-1.jpg"
                               class="w-full border-gray-300 rounded">
                        <p class="text-xs text-gray-500 mt-1">Simpan foto di dalam folder <code>public/images/trucks/</code> lalu ketikkan nama filenya saja di atas.</p>
                        @error('image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="w-full border-gray-300 rounded">{{ old('description', $truck->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Update
                        </button>

                        <a href="{{ route('admin.trucks.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-admin-layout>