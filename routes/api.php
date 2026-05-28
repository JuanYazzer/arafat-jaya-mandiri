<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\TruckController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route;

Route::get('/trucks', [TruckController::class, 'index']);
Route::get('/trucks/{truck}', [TruckController::class, 'show']);

Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/{booking}', [BookingController::class, 'show']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus']);
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);

Route::post('/chatbot', [ChatbotController::class, 'chat']);