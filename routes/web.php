<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsistenPraktikumController;
use App\Http\Controllers\MahasiswaPraktikumController;
use App\Http\Controllers\MataKuliahPraktikumController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/landingpage', function () {
    return view('landingpage');
});

Route::middleware(['auth', 'role:asisten_dosen,laboran,kepala_lab'])->group(function () {
    // Unified dashboard route for all roles
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes for laboran role
    Route::middleware('role:laboran')->group(function () {
        Route::resource('mata_kuliah_praktikum', MataKuliahPraktikumController::class);
        Route::resource('asisten_praktikum', AsistenPraktikumController::class);
        Route::resource('mahasiswa_praktikum', MahasiswaPraktikumController::class);
    });
});

require __DIR__.'/auth.php';
