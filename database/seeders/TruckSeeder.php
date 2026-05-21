<?php

namespace Database\Seeders;

use App\Models\Truck;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    public function run(): void
    {
        Truck::create([
            'name' => 'Isuzu CDE',
            'license_plate' => 'B 1234 XYZ',
            'max_weight' => 3500,
            'total_volume' => 12,
            'starting_price' => 15000,
            'allowed_cargo_types' => ['Furniture', 'Electronics', 'General Cargo'],
            'status' => 'available',
            'image' => null,
            'description' => 'Truk ringan untuk pengiriman barang skala kecil hingga menengah.',
        ]);

        Truck::create([
            'name' => 'Isuzu CDD',
            'license_plate' => 'B 5678 ABC',
            'max_weight' => 5000,
            'total_volume' => 18,
            'starting_price' => 18000,
            'allowed_cargo_types' => ['Furniture', 'Electronics', 'Construction Materials', 'General Cargo'],
            'status' => 'available',
            'image' => null,
            'description' => 'Truk medium untuk kebutuhan logistik umum.',
        ]);

        Truck::create([
            'name' => 'Mitsubishi Fuso',
            'license_plate' => 'B 9012 DEF',
            'max_weight' => 8000,
            'total_volume' => 25,
            'starting_price' => 25000,
            'allowed_cargo_types' => ['Furniture', 'Electronics', 'Construction Materials', 'Industrial Equipment', 'General Cargo'],
            'status' => 'in_use',
            'image' => null,
            'description' => 'Truk besar untuk barang berat dan pengiriman industri.',
        ]);

        Truck::create([
            'name' => 'Isuzu Giga',
            'license_plate' => 'B 3456 GHI',
            'max_weight' => 12000,
            'total_volume' => 35,
            'starting_price' => 35000,
            'allowed_cargo_types' => ['Heavy Machinery', 'Construction Materials', 'Industrial Equipment', 'General Cargo'],
            'status' => 'available',
            'image' => null,
            'description' => 'Truk kapasitas besar untuk pengiriman barang berat.',
        ]);

        Truck::create([
            'name' => 'Hino Ranger',
            'license_plate' => 'B 7890 JKL',
            'max_weight' => 6000,
            'total_volume' => 20,
            'starting_price' => 20000,
            'allowed_cargo_types' => ['Furniture', 'Electronics', 'Construction Materials', 'General Cargo'],
            'status' => 'repair',
            'image' => null,
            'description' => 'Truk medium yang sedang dalam perawatan.',
        ]);

        Truck::create([
            'name' => 'Mitsubishi Canter',
            'license_plate' => 'B 2468 MNO',
            'max_weight' => 4000,
            'total_volume' => 15,
            'starting_price' => 16000,
            'allowed_cargo_types' => ['Furniture', 'Electronics', 'General Cargo'],
            'status' => 'available',
            'image' => null,
            'description' => 'Truk ringan untuk pengiriman cepat dalam kota.',
        ]);
    }
}