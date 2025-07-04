<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Dashboard default (boleh dihapus kalau redirect per role dibuat)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routing berdasarkan role
Route::middleware(['auth', 'role:admin'])->get('/admin', function () {
    return 'Halo Admin!';
});

Route::middleware(['auth', 'role:manager'])->get('/manager', function () {
    return 'Halo Manager!';
});

Route::middleware(['auth', 'role:pic'])->get('/pic', function () {
    return 'Halo PIC!';
});

Route::middleware(['auth', 'role:pelaksana'])->get('/pelaksana', function () {
    return 'Halo Pelaksana!';
});

// Fitur profile (bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes dari Breeze
require __DIR__.'/auth.php';