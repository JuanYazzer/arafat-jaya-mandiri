@extends('layouts.frontend')

@section('content')
<div class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-8">Booking & Estimasi Harga</h1>

        <!-- Backend Team: Pass the available trucks JSON to AlpineJS -->
        <div 
            class="grid lg:grid-cols-3 gap-8 max-w-6xl mx-auto"
            x-data="bookingForm({{ json_encode($availableTrucks) }}, '{{ request()->query('truck') }}')"
        >
            <div class="lg:col-span-2">
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
                    <div class="flex flex-col space-y-1.5 p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold leading-none tracking-tight">Form Booking</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        
                        <div class="space-y-2">
                            <label for="truck" class="text-sm font-medium leading-none">Pilih Truk *</label>
                            <select 
                                id="truck" 
                                x-model="selectedTruckId"
                                class="flex h-10 w-full bg-white rounded-md border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            >
                                <option value="">Pilih truk yang sesuai</option>
                                <template x-for="truck in trucks" :key="truck.id">
                                    <option :value="truck.id" x-text="`${truck.name} - Max ${truck.maxWeight}kg, ${truck.volume} CBM`"></option>
                                </template>
                            </select>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="weight" class="text-sm font-medium leading-none">Berat Barang (Kg) *</label>
                                <input
                                    id="weight"
                                    type="number"
                                    placeholder="Contoh: 1000"
                                    x-model="weight"
                                    class="flex h-10 w-full rounded-md border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                >
                                <p x-show="isWeightExceeded" class="text-sm text-red-600" style="display: none;">Melebihi kapasitas maksimal truk!</p>
                            </div>

                            <div class="space-y-2">
                                <label for="volume" class="text-sm font-medium leading-none">Volume Barang (CBM) *</label>
                                <input
                                    id="volume"
                                    type="number"
                                    placeholder="Contoh: 5"
                                    x-model="volume"
                                    class="flex h-10 w-full rounded-md border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                >
                                <p x-show="isVolumeExceeded" class="text-sm text-red-600" style="display: none;">Melebihi kapasitas volume truk!</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="cargoType" class="text-sm font-medium leading-none">Jenis Barang *</label>
                            <input
                                id="cargoType"
                                type="text"
                                placeholder="Contoh: Furniture, Elektronik, dll"
                                x-model="cargoType"
                                class="flex h-10 w-full rounded-md border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            >
                        </div>

                        <div class="space-y-2">
                            <label for="pickup" class="text-sm font-medium leading-none">Alamat Penjemputan *</label>
                            <textarea
                                id="pickup"
                                placeholder="Masukkan alamat lengkap penjemputan"
                                x-model="pickupAddress"
                                rows="3"
                                class="flex min-h-[80px] w-full rounded-md border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            ></textarea>
                        </div>

                        <div class="space-y-2">
                            <label for="delivery" class="text-sm font-medium leading-none">Alamat Tujuan *</label>
                            <textarea
                                id="delivery"
                                placeholder="Masukkan alamat lengkap tujuan"
                                x-model="deliveryAddress"
                                rows="3"
                                class="flex min-h-[80px] w-full rounded-md border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            ></textarea>
                        </div>

                        <div class="space-y-2">
                            <label for="distance" class="text-sm font-medium leading-none">Estimasi Jarak (Km) *</label>
                            <input
                                id="distance"
                                type="number"
                                placeholder="Contoh: 50"
                                x-model="distance"
                                class="flex h-10 w-full rounded-md border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            >
                            <p class="text-sm text-gray-600">
                                Anda bisa gunakan Google Maps untuk menghitung jarak
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="rounded-xl border border-gray-100 bg-white shadow-sm sticky top-20">
                    <div class="flex flex-col space-y-1.5 p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold leading-none tracking-tight">Estimasi Harga</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        
                        <template x-if="selectedTruck">
                            <div>
                                <div class="text-center py-6 bg-blue-50 rounded-lg mb-6">
                                    <p class="text-sm text-gray-600 mb-2">Total Estimasi</p>
                                    <p class="text-4xl font-bold text-blue-600" x-text="'Rp ' + formatRupiah(estimatedPrice)"></p>
                                </div>

                                <div class="space-y-3 text-sm mb-6">
                                    <h3 class="font-semibold">Ringkasan:</h3>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Truk:</span>
                                            <span class="font-medium" x-text="selectedTruck.name"></span>
                                        </div>
                                        <template x-if="weight">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Berat:</span>
                                                <span class="font-medium" x-text="weight + ' kg'"></span>
                                            </div>
                                        </template>
                                        <template x-if="volume">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Volume:</span>
                                                <span class="font-medium" x-text="volume + ' CBM'"></span>
                                            </div>
                                        </template>
                                        <template x-if="distance">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Jarak:</span>
                                                <span class="font-medium" x-text="distance + ' km'"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-4">
                                    <p class="text-xs text-gray-500 mb-4">
                                        * Harga estimasi dapat berubah sesuai kondisi lapangan dan jarak aktual
                                    </p>
                                    <button
                                        @click="handleWhatsAppClick"
                                        :disabled="!isFormValid"
                                        class="w-full inline-flex items-center justify-center h-11 px-8 rounded-md font-medium text-white transition disabled:opacity-50 disabled:cursor-not-allowed bg-green-600 hover:bg-green-700"
                                    >
                                        <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                                        Lanjut via WhatsApp
                                    </button>
                                </div>
                            </div>
                        </template>

                        <template x-if="!selectedTruck">
                            <div class="text-center py-8 text-gray-500">
                                Pilih truk untuk melihat estimasi harga
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('bookingForm', (trucksData, initialTruckId) => ({
            trucks: trucksData,
            selectedTruckId: initialTruckId || '',
            weight: '',
            volume: '',
            cargoType: '',
            pickupAddress: '',
            deliveryAddress: '',
            distance: '',

            get selectedTruck() {
                return this.trucks.find(t => t.id == this.selectedTruckId);
            },

            get isWeightExceeded() {
                return this.selectedTruck && this.weight && parseFloat(this.weight) > this.selectedTruck.maxWeight;
            },

            get isVolumeExceeded() {
                return this.selectedTruck && this.volume && parseFloat(this.volume) > this.selectedTruck.volume;
            },

            get estimatedPrice() {
                if (!this.selectedTruck || !this.distance || parseFloat(this.distance) <= 0) return 0;
                const basePrice = this.selectedTruck.pricePerKm * parseFloat(this.distance);
                const weightVal = parseFloat(this.weight);
                const weightSurcharge = (weightVal && weightVal > (this.selectedTruck.maxWeight * 0.8)) ? basePrice * 0.1 : 0;
                return Math.round(basePrice + weightSurcharge);
            },

            get isFormValid() {
                return this.selectedTruckId && this.weight && this.volume && this.cargoType && this.pickupAddress && this.deliveryAddress && this.distance && !this.isWeightExceeded && !this.isVolumeExceeded;
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            },

            generateWhatsAppMessage() {
                const message = `Halo, saya ingin menyewa truk dengan detail berikut:

*Detail Truk:*
- Nama: ${this.selectedTruck?.name || '-'}
- Tipe: ${this.selectedTruck?.type || '-'}

*Detail Barang:*
- Berat: ${this.weight || '-'} kg
- Volume: ${this.volume || '-'} CBM
- Jenis Barang: ${this.cargoType || '-'}

*Alamat:*
- Penjemputan: ${this.pickupAddress || '-'}
- Tujuan: ${this.deliveryAddress || '-'}
- Estimasi Jarak: ${this.distance || '-'} km

*Estimasi Harga:* Rp ${this.formatRupiah(this.estimatedPrice)}

Mohon konfirmasi ketersediaan dan informasi lebih lanjut. Terima kasih!`;

                return encodeURIComponent(message);
            },

            handleWhatsAppClick() {
                const message = this.generateWhatsAppMessage();
                window.open(`https://wa.me/6281234567890?text=${message}`, '_blank');
            }
        }))
    })
</script>
@endsection
