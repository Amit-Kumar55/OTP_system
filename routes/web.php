<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Livewire\Volt\Volt;

// Register Livewire update route (fixes "Route [livewire.update] not defined" error)
// Livewire::setUpdateRoute();

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route (requires authentication & email verification)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user routes (Profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ✅ Livewire Volt OTP Verification Route
Volt::route('/otp-verification', 'otp-verification');


// Include authentication routes
require __DIR__.'/auth.php';
