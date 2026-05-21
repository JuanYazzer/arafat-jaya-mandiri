<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Truck;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('truck')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data booking berhasil diambil.',
            'data' => $bookings,
        ]);
    }

    public function show(Booking $booking)
    {
        $booking->load('truck');

        return response()->json([
            'success' => true,
            'message' => 'Detail booking berhasil diambil.',
            'data' => $booking,
        ]);
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
            return response()->json([
                'success' => false,
                'message' => 'Truk ini sedang tidak tersedia.',
            ], 422);
        }

        if ($validated['cargo_weight'] > $truck->max_weight) {
            return response()->json([
                'success' => false,
                'message' => 'Berat barang melebihi kapasitas truk.',
            ], 422);
        }

        if ($validated['cargo_volume'] > $truck->total_volume) {
            return response()->json([
                'success' => false,
                'message' => 'Volume barang melebihi kapasitas truk.',
            ], 422);
        }

        $validated['estimated_price'] = $truck->starting_price * $validated['distance_km'];
        $validated['status'] = 'pending';

        $booking = Booking::create($validated);
        $booking->load('truck');

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibuat.',
            'data' => $booking,
        ], 201);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $newStatus = $validated['status'];
        $truck = $booking->truck;

        if ($newStatus === 'confirmed') {
            if ($truck && $truck->status !== 'available' && $booking->status !== 'confirmed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Truk sedang tidak tersedia, booking tidak bisa dikonfirmasi.',
                ], 422);
            }
        }

        $booking->update([
            'status' => $newStatus,
        ]);

        if ($truck) {
            if ($newStatus === 'confirmed') {
                $truck->update([
                    'status' => 'in_use',
                ]);
            }

            if (in_array($newStatus, ['completed', 'cancelled']) && $truck->status === 'in_use') {
                $truck->update([
                    'status' => 'available',
                ]);
            }
        }

        $booking->load('truck');

        return response()->json([
            'success' => true,
            'message' => 'Status booking berhasil diperbarui.',
            'data' => $booking,
        ]);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dihapus.',
        ]);
    }
}