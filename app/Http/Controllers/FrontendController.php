<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Dummy Data - BACKEND TEAM: Hapus ini dan ganti dengan query database misal: Truck::where('status', 'Available')->get();
    private $dummyTrucks;
    private $dummyTestimonials;

    public function __construct()
    {
        $this->dummyTrucks = [
            [
                'id' => '1',
                'name' => 'Isuzu Giga FVR',
                'type' => 'Wingbox',
                'licensePlate' => 'B 9123 VAA',
                'maxWeight' => 15000,
                'volume' => 45,
                'allowedCargo' => ['Furniture', 'Electronics', 'Consumer Goods'],
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800',
                'status' => 'Available',
                'pricePerKm' => 15000,
            ],
            [
                'id' => '2',
                'name' => 'Hino Ranger FL',
                'type' => 'Flatbed',
                'licensePlate' => 'B 9456 XYZ',
                'maxWeight' => 12000,
                'volume' => 35,
                'allowedCargo' => ['Construction Materials', 'Steel', 'Pipes'],
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=800',
                'status' => 'Available',
                'pricePerKm' => 12000,
            ],
            [
                'id' => '3',
                'name' => 'Mitsubishi Fuso Canter',
                'type' => 'Box',
                'licensePlate' => 'B 9789 DEF',
                'maxWeight' => 5000,
                'volume' => 18,
                'allowedCargo' => ['Food & Beverages', 'Apparel', 'Small Packages'],
                'image' => 'https://images.unsplash.com/photo-1591768793355-74d7c869ea39?w=800',
                'status' => 'Available',
                'pricePerKm' => 8000,
            ],
            [
                'id' => '4',
                'name' => 'Toyota Dyna',
                'type' => 'Open Cargo',
                'licensePlate' => 'B 9012 GHI',
                'maxWeight' => 4000,
                'volume' => 15,
                'allowedCargo' => ['Agriculture', 'General Cargo'],
                'image' => 'https://images.unsplash.com/photo-1519003722824-194d4455a60c?w=800',
                'status' => 'In Use',
                'pricePerKm' => 7000,
            ]
        ];

        $this->dummyTestimonials = [
            [
                'id' => '1',
                'name' => 'Budi Santoso',
                'role' => 'Owner',
                'company' => 'PT Maju Jaya Furniture',
                'quote' => 'Sangat puas dengan pelayanan TruckRental. Armada selalu tepat waktu dan drivernya sangat profesional.',
                'photo' => 'https://i.pravatar.cc/150?u=budi',
            ],
            [
                'id' => '2',
                'name' => 'Siti Rahma',
                'role' => 'Logistics Manager',
                'company' => 'Global Mart',
                'quote' => 'Harga yang transparan memudahkan kami dalam budgeting biaya pengiriman barang ke gudang.',
                'photo' => 'https://i.pravatar.cc/150?u=siti',
            ],
            [
                'id' => '3',
                'name' => 'Andi Wijaya',
                'role' => 'Operations',
                'company' => 'Tekno Solusi',
                'quote' => 'Proses booking sangat mudah dan cepat. Sistem estimasi harganya sangat membantu.',
                'photo' => 'https://i.pravatar.cc/150?u=andi',
            ]
        ];
    }

    public function home()
    {
        // Menyaring truk yang statusnya Available saja (maksimal 3 data untuk Home)
        $availableTrucks = collect($this->dummyTrucks)
            ->filter(fn($truck) => $truck['status'] === 'Available')
            ->take(3)
            ->all();

        $testimonials = $this->dummyTestimonials;

        return view('frontend.home', compact('availableTrucks', 'testimonials'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function trucks(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $selectedId = $request->query('selected');
        
        // BACKEND TEAM: Filter by database query in the future
        $trucks = collect($this->dummyTrucks)->filter(function ($truck) use ($filter) {
            if ($filter === 'all') return true;
            if ($filter === 'available') return $truck['status'] === 'Available';
            if ($filter === 'small') return $truck['maxWeight'] <= 5000;
            if ($filter === 'medium') return $truck['maxWeight'] > 5000 && $truck['maxWeight'] <= 8000;
            if ($filter === 'large') return $truck['maxWeight'] > 8000;
            return true;
        })->all();

        return view('frontend.trucks', compact('trucks', 'filter', 'selectedId'));
    }

    public function booking(Request $request)
    {
        // BACKEND TEAM: Panggil data Truck yang Available saja
        $availableTrucks = collect($this->dummyTrucks)
            ->filter(fn($truck) => $truck['status'] === 'Available')
            ->all();

        return view('frontend.booking', compact('availableTrucks'));
    }
}
