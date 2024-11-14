<?php

use App\Http\Controllers\AbsensiMahasiswaMataKuliahPraktikumController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsistenPraktikumController;
use App\Http\Controllers\MahasiswaPraktikumController;
use App\Http\Controllers\MataKuliahPraktikumController;
use App\Http\Controllers\AsistenPraktikumPraktikumController;

// Default landing pages
Route::get('/', function () {
    return view('welcome');
});

Route::get('/landingpage', function () {
    return view('landingpage');
});

// Middleware for authenticated users with specific roles
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
        Route::post('/import-mahasiswa/{mataKuliahPraktikumId}', [MahasiswaPraktikumController::class, 'import'])->name('import.mahasiswa');
        Route::delete('/mahasiswa_praktikum/delete_all/{mataKuliah}', [MahasiswaPraktikumController::class, 'deleteAll'])->name('mahasiswa_praktikum.deleteAll');
         // Route to display attendance form
         Route::get('/attendance/{mahasiswaMataKuliahId}', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'indexMahasiswa'])->name('attendance.index');
         Route::get('/attendance/{mahasiswaMataKuliahId}/print', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'printMahasiswa'])->name('attendance.print');
         // Route to update attendance
         Route::post('/attendance/{mahasiswaMataKuliahId}', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'update'])->name('attendance.update');
    });

    // Attendance routes for asisten dosen
    Route::middleware('role:asisten_dosen')->group(function () {
        // Route to display attendance form
        Route::get('/absensi_praktikum', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'index'])->name('absensi_praktikum.index');
        Route::get('/absensi_praktikum/{id}', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'show'])->name('absensi_praktikum.show');
        Route::get('/absensi_praktikum/{mataKuliahId}/{pertemuan}', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'showAbsensiPertemuan'])->name('absensi.showPertemuan');
        Route::get('/absensi_praktikum/{mataKuliahId}/{pertemuan}/print', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'showPrint'])->name('absensi.showPrint');
        Route::post('/update_absensi/{mataKuliahId}/{pertemuan}', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'updateAbsensiPertemuan'])->name('absensi.updatePertemuan');
        // Route to update attendance
        Route::post('/absensi_praktikum/update', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'asistenPraktikumUpdate'])->name('attendance.asisten_dosen.update');
    });
});

// Load authentication routes
require __DIR__ . '/auth.php';
