<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index(Request $request)
    {
        $query = Truck::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $trucks = $query->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data truk berhasil diambil.',
            'data' => $trucks,
        ]);
    }

    public function show(Truck $truck)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail truk berhasil diambil.',
            'data' => $truck,
        ]);
    }
}