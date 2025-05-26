<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlotWaktuController;
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

    Route::resource('lapangan', LapanganController::class)->middleware('auth');
    Route::resource('slot_waktu', SlotWaktuController::class)->middleware('auth');
    Route::resource('metode_pembayaran', MetodePembayaranController::class)->middleware('auth');
    Route::resource('bookings', BookingController::class)->middleware('auth');
    Route::resource('laporan', laporanController::class)->middleware('auth');
});

require __DIR__.'/auth.php';
