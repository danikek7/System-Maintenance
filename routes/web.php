<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\AsetController;
use App\Http\Controllers\Admin\ParameterController;

// ==========================
// Halaman Utama
// ==========================
Route::get('/', fn() => view('welcome'));

// ==========================
// Redirect Dashboard per Role
// ==========================
Route::get('/dashboard', function () {
    $user = Auth::user();
    return match ($user->role) {
        'admin'     => redirect()->route('admin.dashboard'),
        'manager'   => redirect()->route('manager.dashboard'),
        'pic'       => redirect()->route('pic.dashboard'),
        'pelaksana' => redirect()->route('pelaksana.dashboard'),
        default     => abort(403, 'Role tidak dikenali.'),
    };
})->middleware('auth')->name('dashboard');

// ==========================
// Admin Routes (auth + role:admin)
// ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Jadwal Maintenance
    Route::prefix('jadwal')->name('jadwal.')->controller(JadwalController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create'); // Ganti dari /form
        Route::post('/store', 'store')->name('store');   // Ganti juga dari /tambah
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Aset
    Route::prefix('aset')->name('aset.')->controller(AsetController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Parameter
    Route::prefix('parameter')->name('parameter.')->controller(ParameterController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
});

// ==========================
// Manager Routes
// ==========================
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::view('/', 'manager.dashboard')->name('dashboard');
});

// ==========================
// PIC Routes
// ==========================
Route::middleware(['auth', 'role:pic'])->prefix('pic')->name('pic.')->group(function () {
    Route::view('/', 'pic.dashboard')->name('dashboard');
});

// ==========================
// Pelaksana Routes
// ==========================
Route::middleware(['auth', 'role:pelaksana'])->prefix('pelaksana')->name('pelaksana.')->group(function () {
    Route::view('/', 'pelaksana.dashboard')->name('dashboard');
});

// ==========================
// Profile Routes
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// Auth Routes (login, register, logout)
// ==========================
require __DIR__ . '/auth.php';
