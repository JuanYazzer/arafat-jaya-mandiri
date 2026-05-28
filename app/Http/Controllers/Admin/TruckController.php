<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::latest()->get();

        return view('admin.trucks.index', compact('trucks'));
    }

    public function create()
    {
        return view('admin.trucks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:50|unique:trucks,license_plate',
            'max_weight' => 'required|integer|min:1',
            'total_volume' => 'required|integer|min:1',
            'starting_price' => 'required|integer|min:1',
            'allowed_cargo_types' => 'nullable|string',
            'status' => 'required|in:available,in_use,repair',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $validated['allowed_cargo_types'] = $this->formatCargoTypes($request->allowed_cargo_types);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('trucks', 'cloudinary');
            $validated['image'] = Storage::disk('cloudinary')->url($path);
        }

        Truck::create($validated);

        return redirect()
            ->route('admin.trucks.index')
            ->with('success', 'Data truk berhasil ditambahkan.');
    }

    public function edit(Truck $truck)
    {
        return view('admin.trucks.edit', compact('truck'));
    }

    public function update(Request $request, Truck $truck)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:50|unique:trucks,license_plate,' . $truck->id,
            'max_weight' => 'required|integer|min:1',
            'total_volume' => 'required|integer|min:1',
            'starting_price' => 'required|integer|min:1',
            'allowed_cargo_types' => 'nullable|string',
            'status' => 'required|in:available,in_use,repair',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $validated['allowed_cargo_types'] = $this->formatCargoTypes($request->allowed_cargo_types);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('trucks', 'cloudinary');
            $validated['image'] = Storage::disk('cloudinary')->url($path);
        } else {
            // Keep the old image if no new image is uploaded
            unset($validated['image']);
        }

        $truck->update($validated);

        return redirect()
            ->route('admin.trucks.index')
            ->with('success', 'Data truk berhasil diperbarui.');
    }

    public function destroy(Truck $truck)
    {
        $truck->delete();

        return redirect()
            ->route('admin.trucks.index')
            ->with('success', 'Data truk berhasil dihapus.');
    }

    private function formatCargoTypes(?string $cargoTypes): array
    {
        if (!$cargoTypes) {
            return [];
        }

        return collect(explode(',', $cargoTypes))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->toArray();
    }
}