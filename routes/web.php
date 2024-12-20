<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstimationController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\GaussJordanController;

// Route untuk halaman home
Route::get('/', function () {
    return view('home');
})->name('home');

// Route untuk halaman about
Route::get('/about', function () {
    return view('about');
})->name('about');

// Route untuk halaman register
// Route::get('/register', function () {
//     return view('register');
// })->name('register');

Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Route utama untuk estimasi
Route::get('/estimation', function () {
})->middleware('role.redirect')->name('input.form');


// Halaman estimasi untuk
Route::get('/user-estimation', [EstimationController::class, 'showForm'])->name('input.form');
Route::post('/process', [EstimationController::class, 'processData'])->name('process.data');

// Halaman estimasi untuk admin
Route::get('/gauss-jordan', [GaussJordanController::class, 'showForm'])->name('gauss.form');
Route::post('/gauss-jordan', [GaussJordanController::class, 'processData'])->name('gauss.process');

