<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MataKuliahPraktikumController;
use Illuminate\Support\Facades\Route;

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


// Route::get('/dashboard', [LandingPageController::class, 'index']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/landingpage', function () {
    return view('landingpage');
});


Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('mata_kuliah_praktikum', MataKuliahPraktikumController::class);


// Route::middleware('auth')->group(function () {
// Auth::routes();
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

