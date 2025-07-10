<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MaintenanceScheduleController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Halaman awal (public)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard redirect ke halaman sesuai role
Route::get('/dashboard', function () {
    $user = Auth::user(); // aman karena sudah pakai middleware 'auth'

    switch ($user->role) {
        case 'admin':
            return redirect('/admin');
        case 'manager':
            return redirect('/manager');
        case 'pic':
            return redirect('/pic');
        case 'pelaksana':
            return redirect('/pelaksana');
        default:
            abort(403, 'Role tidak dikenali.');
    }
})->middleware('auth')->name('dashboard');


// ==========================
// Admin Routes
// ==========================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/jadwal', function () {
        return view('admin.jadwal');
    })->name('admin.jadwal');

    Route::get('/admin/aset', function () {
        return view('admin.aset');
    })->name('admin.aset');
});


// ==========================
// Manager Routes
// ==========================
Route::middleware(['auth', 'role:manager'])->get('/manager', function () {
    return view('manager.dashboard');
})->name('manager.dashboard');

// ==========================
// PIC Routes
// ==========================
Route::middleware(['auth', 'role:pic'])->get('/pic', function () {
    return view('pic.dashboard');
})->name('pic.dashboard');

// ==========================
// Pelaksana Routes
// ==========================
Route::middleware(['auth', 'role:pelaksana'])->group(function () {
    Route::get('/pelaksana', fn() => view('pelaksana.dashboard'))->name('pelaksana.dashboard');

    Route::get('/pelaksana/jadwal', [MaintenanceScheduleController::class, 'index'])->name('pelaksana.daftarjadwal');
    Route::get('/pelaksana/jadwal/{jadwal}', [MaintenanceScheduleController::class, 'show'])->name('pelaksana.jadwal.show');
    Route::get('/pelaksana/jadwal/{jadwal}/edit', [MaintenanceScheduleController::class, 'edit'])->name('pelaksana.asetjadwal');
    Route::patch('/pelaksana/jadwal/{jadwal}/approve', [MaintenanceScheduleController::class, 'approve'])->name('pelaksana.jadwal.approve');
    Route::delete('/pelaksana/jadwal/{jadwal}', [MaintenanceScheduleController::class, 'destroy'])->name('pelaksana.jadwal.destroy');
    Route::put('/pelaksana/jadwal/{jadwal}', [MaintenanceScheduleController::class, 'update'])->name('pelaksana.jadwal.update');
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
require __DIR__.'/auth.php';
