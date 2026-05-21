<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TruckController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public / User Routes
|--------------------------------------------------------------------------
| Halaman ini bisa diakses tanpa login.
| Pengunjung langsung diarahkan ke tampilan user seperti Home, About,
| Trucks, Booking, dan Contact.
*/

Route::get('/', [FrontendController::class, 'home'])->name('home');

Route::get('/about', [FrontendController::class, 'about'])->name('about');

Route::get('/trucks', [FrontendController::class, 'trucks'])->name('trucks');

Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{booking}', [BookingController::class, 'success'])->name('booking.success');

Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');


/*
|--------------------------------------------------------------------------
| Dashboard Redirect Based on Role
|--------------------------------------------------------------------------
| Jika admin login, arahkan ke dashboard admin.
| Jika user biasa login, arahkan ke halaman home.
*/

Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Halaman admin hanya bisa diakses oleh user yang sudah login
| dan memiliki role admin.
*/

Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('trucks', TruckController::class);

        Route::get('/bookings', [AdminBookingController::class, 'index'])
            ->name('bookings.index');

        Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])
            ->name('bookings.show');

        Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])
            ->name('bookings.update-status');

        Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])
            ->name('bookings.destroy');
    });


/*
|--------------------------------------------------------------------------
| Profile Routes from Laravel Breeze
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Auth Routes from Laravel Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';