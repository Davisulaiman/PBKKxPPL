<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MataKuliahPraktikumController;
use App\Http\Controllers\AsistenPraktikumController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/landingpage', function () {
    return view('landingpage');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin routes
Route::middleware(['auth','role:kepala lab'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
});


//agent routes
Route::middleware(['auth','role:laboran'])->group(function () {
    // Route::get('/dashboard',[AgentController::class,'dashboard'])->name('agent.dashboard');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
        // Route untuk fitur Mata Kuliah Praktikum
        Route::resource('mata_kuliah_praktikum', MataKuliahPraktikumController::class);
        Route::resource('asisten_praktikum', AsistenPraktikumController::class);
});

//user routes
Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/user/dashboard',[AgentController::class,'dashboard'])->name('user.dashboard');
    Route::get('/user/dashboard',[AgentController::class,'dashboard'])->name('dashboard');
});



require __DIR__.'/auth.php';
