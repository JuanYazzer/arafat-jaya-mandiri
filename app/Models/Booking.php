<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'truck_id',
        'customer_name',
        'customer_phone',
        'cargo_weight',
        'cargo_volume',
        'cargo_type',
        'pickup_address',
        'destination_address',
        'distance_km',
        'estimated_price',
        'status',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}