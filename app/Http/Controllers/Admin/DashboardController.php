<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Truck;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTrucks = Truck::count();
        $availableTrucks = Truck::where('status', 'available')->count();
        $inUseTrucks = Truck::where('status', 'in_use')->count();
        $repairTrucks = Truck::where('status', 'repair')->count();

        $trucks = Truck::latest()->get();

        return view('admin.dashboard', compact(
            'totalTrucks',
            'availableTrucks',
            'inUseTrucks',
            'repairTrucks',
            'trucks'
        ));
    }
}