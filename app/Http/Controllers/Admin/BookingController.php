<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('truck')->latest()->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load('truck');

        return view('admin.bookings.show', compact('booking'));
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
                return back()->with('error', 'Truk sedang tidak tersedia, booking tidak bisa dikonfirmasi.');
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

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Data booking berhasil dihapus.');
    }
}