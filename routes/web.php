<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/about', function () {
    return view('about');
});
// Route untuk Home
Route::get('/', function () {
    return view('welcome'); // atau view landing page kamu
})->name('home');

// Route untuk About
Route::get('/about', function () {
    return view('about');
})->name('about');

// Tambahkan placeholder untuk yang lain agar tidak error
Route::get('/trucks', function () {
    return "Halaman Trucks";
})->name('trucks');

Route::get('/booking', function () {
    return "Halaman Booking";
})->name('booking');

Route::get('/contact', function () {
    return "Halaman Contact";
})->name('contact');
require __DIR__.'/auth.php';
