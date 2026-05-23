<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $trucks = Truck::where('status', 'available')
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.home', compact('trucks'));
    }

    public function about()
    {
        $totalTrucks = Truck::count();
        return view('frontend.about', compact('totalTrucks'));
    }

    public function trucks(Request $request)
    {
        $query = Truck::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $trucks = $query->latest()->get();

        return view('frontend.trucks', compact('trucks'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}