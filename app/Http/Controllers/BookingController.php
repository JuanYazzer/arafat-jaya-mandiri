<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Truck;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        $trucks = Truck::where('status', 'available')->get();

        return view('booking', compact('trucks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'truck_id' => 'required|exists:trucks,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:30',
            'cargo_weight' => 'required|integer|min:1',
            'cargo_volume' => 'required|integer|min:1',
            'cargo_type' => 'required|string|max:255',
            'pickup_address' => 'required|string',
            'destination_address' => 'required|string',
            'distance_km' => 'required|integer|min:1',
        ]);

        $truck = Truck::findOrFail($validated['truck_id']);

        if ($truck->status !== 'available') {
            return back()
                ->withInput()
                ->withErrors(['truck_id' => 'Truk ini sedang tidak tersedia.']);
        }

        if ($validated['cargo_weight'] > $truck->max_weight) {
            return back()
                ->withInput()
                ->withErrors(['cargo_weight' => 'Berat barang melebihi kapasitas truk.']);
        }

        if ($validated['cargo_volume'] > $truck->total_volume) {
            return back()
                ->withInput()
                ->withErrors(['cargo_volume' => 'Volume barang melebihi kapasitas truk.']);
        }

        $validated['estimated_price'] = $truck->starting_price * $validated['distance_km'];
        $validated['status'] = 'pending';

        $booking = Booking::create($validated);

        return redirect()
            ->route('booking.success', $booking)
            ->with('success', 'Booking berhasil dibuat.');
    }

    public function success(Booking $booking)
    {
        $booking->load('truck');

        return view('booking-success', compact('booking'));
    }
}