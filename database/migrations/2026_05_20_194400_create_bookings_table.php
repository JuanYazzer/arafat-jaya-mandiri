<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('truck_id')
                ->nullable()
                ->constrained('trucks')
                ->nullOnDelete();

            $table->string('customer_name');
            $table->string('customer_phone');

            $table->integer('cargo_weight');
            $table->integer('cargo_volume');
            $table->string('cargo_type');

            $table->text('pickup_address');
            $table->text('destination_address');

            $table->integer('distance_km');
            $table->bigInteger('estimated_price');

            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])
                ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};