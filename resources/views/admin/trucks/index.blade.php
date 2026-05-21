<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Truk
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Armada</h3>

                    <a href="{{ route('admin.trucks.create') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        + Tambah Truk
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border p-3">ID</th>
                                <th class="border p-3">Nama Truk</th>
                                <th class="border p-3">Plat Nomor</th>
                                <th class="border p-3">Berat</th>
                                <th class="border p-3">Volume</th>
                                <th class="border p-3">Harga / Km</th>
                                <th class="border p-3">Status</th>
                                <th class="border p-3">Jenis Barang</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($trucks as $truck)
                                <tr>
                                    <td class="border p-3">{{ $truck->id }}</td>
                                    <td class="border p-3 font-semibold">{{ $truck->name }}</td>
                                    <td class="border p-3">{{ $truck->license_plate }}</td>
                                    <td class="border p-3">{{ number_format($truck->max_weight) }} kg</td>
                                    <td class="border p-3">{{ $truck->total_volume }} CBM</td>
                                    <td class="border p-3">
                                        Rp {{ number_format($truck->starting_price, 0, ',', '.') }}
                                    </td>
                                    <td class="border p-3">
                                        @if ($truck->status === 'available')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">
                                                Available
                                            </span>
                                        @elseif ($truck->status === 'in_use')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-sm">
                                                In Use
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">
                                                Repair
                                            </span>
                                        @endif
                                    </td>
                                    <td class="border p-3">
                                        @if ($truck->allowed_cargo_types)
                                            {{ implode(', ', $truck->allowed_cargo_types) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="border p-3">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.trucks.edit', $truck) }}"
                                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.trucks.destroy', $truck) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data truk ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="border p-3 text-center">
                                        Belum ada data truk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-admin-layout>