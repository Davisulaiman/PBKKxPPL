<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaboranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsistenPraktikumController;
use App\Http\Controllers\LaporanPraktikumController;
use App\Http\Controllers\MahasiswaPraktikumController;
use App\Http\Controllers\MataKuliahPraktikumController;
use App\Http\Controllers\AsistenPraktikumPraktikumController;
use App\Http\Controllers\AbsensiMahasiswaMataKuliahPraktikumController;
use App\Http\Controllers\PenilaianPraktikumController;


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


    //Resources routes for kepala_lab role
    Route::middleware('role:kepala_lab')->group(function () {
        Route::resource('laboran', LaboranController::class);
    });


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

    // Resources routes for kepala_lab & laboran role
    Route::middleware(['role:kepala_lab,laboran'])->group(function () {
        Route::get('/absensi_praktikum/{mataKuliahId}/laporan', [AbsensiMahasiswaMataKuliahPraktikumController::class, 'showLaporanPresensi'])->name('laporan.absensi');
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

    Route::middleware(['auth', 'role:asisten_dosen'])->group(function () {
        // Route to display the form to create Penilaian Praktikum
        Route::get('penilaian_praktikum/create', [PenilaianPraktikumController::class, 'create'])->name('penilaian_praktikum.create');
        // Route to store Penilaian Praktikum
        Route::post('penilaian_praktikum', [PenilaianPraktikumController::class, 'store'])->name('penilaian_praktikum.store');
        Route::get('/penilaian-praktikum/download-template', [PenilaianPraktikumController::class, 'downloadTemplate'])->name('penilaian_praktikum.download_template');
    });

    Route::middleware(['auth', 'role:kepala_lab,laboran,asisten_dosen'])->group(function () {
        // Route to view Penilaian Praktikum (List view)
        Route::get('penilaian_praktikum', [PenilaianPraktikumController::class, 'index'])->name('penilaian_praktikum.index');
    });

    Route::middleware(['auth', 'role:laboran,kepala_lab,asisten_dosen'])->group(function () {
        Route::resource('laporan_praktikum', LaporanPraktikumController::class)->only(['index', 'show']);
    });

    // Route untuk Asisten Dosen (create)
    Route::middleware(['auth', 'role:asisten_dosen'])->group(function () {
        Route::resource('laporan_praktikum', LaporanPraktikumController::class)->only(['store']);

        Route::get('/laporan_praktikum/{mata_kuliah_id}/{pertemuan}/create', [LaporanPraktikumController::class, 'create'])
        ->name('laporan_praktikum.create');
    });

    // Route untuk Laboran dan Kepala Lab (view)
    Route::middleware(['auth', 'role:laboran,kepala_lab'])->group(function () {
        Route::get('/laporan_praktikum/{mata_kuliah_id}/{pertemuan}', [LaporanPraktikumController::class, 'print'])
            ->name('laporan_praktikum.print');
    });
});

// Load authentication routes
require __DIR__ . '/auth.php';
