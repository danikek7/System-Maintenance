<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\JadwalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard sesuai role
Route::get('/dashboard', function () {
    $user = Auth::user();

    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'manager':
            return redirect()->route('manager.dashboard');
        case 'pic':
            return redirect()->route('pic.dashboard');
        case 'pelaksana':
            return redirect()->route('pelaksana.dashboard');
        default:
            abort(403, 'Role tidak dikenali.');
    }
})->middleware('auth')->name('dashboard');

// ==========================
// Admin Routes
// ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Daftar jadwal maintenance
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('admin.jadwal');

    // Form tambah jadwal maintenance
    Route::get('/jadwal/form', [JadwalController::class, 'create'])->name('admin.jadwal.form');

    // Simpan jadwal maintenance
    Route::post('/jadwal/tambah', [JadwalController::class, 'store'])->name('admin.jadwal.tambah');

    // Halaman Aset (sementara pakai closure, bisa dibuat controller juga)
    Route::get('/aset', function () {
        return view('admin.aset');
    })->name('admin.aset');
});

// ==========================
// Manager Routes
// ==========================
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager', function () {
        return view('manager.dashboard');
    })->name('manager.dashboard');
});

// ==========================
// PIC Routes
// ==========================
Route::middleware(['auth', 'role:pic'])->group(function () {
    Route::get('/pic', function () {
        return view('pic.dashboard');
    })->name('pic.dashboard');
});

// ==========================
// Pelaksana Routes
// ==========================
Route::middleware(['auth', 'role:pelaksana'])->group(function () {
    Route::get('/pelaksana', function () {
        return view('pelaksana.dashboard');
    })->name('pelaksana.dashboard');
});

// ==========================
// Profile Routes (Breeze default)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// Auth Routes (Breeze default)
// ==========================
require __DIR__ . '/auth.php';
