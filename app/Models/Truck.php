<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = [
        'name',
        'license_plate',
        'max_weight',
        'total_volume',
        'starting_price',
        'allowed_cargo_types',
        'status',
        'image',
        'description',
    ];

    protected $casts = [
        'allowed_cargo_types' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}