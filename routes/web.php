<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MaintenanceScheduleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\AsetController;
use App\Http\Controllers\Admin\ParameterController; // ✅ Tambahkan ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard sesuai role setelah login
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
    Route::controller(JadwalController::class)->prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/form', 'create')->name('form');
        Route::post('/tambah', 'store')->name('tambah');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Aset
    Route::controller(AsetController::class)->prefix('aset')->name('aset.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // ✅ Parameter
    Route::controller(ParameterController::class)->prefix('parameter')->name('parameter.')->group(function () {
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
<<<<<<< HEAD
Route::middleware(['auth', 'role:pelaksana'])->group(function () {
    Route::get('/pelaksana', fn() => view('pelaksana.dashboard'))->name('pelaksana.dashboard');

    Route::get('/pelaksana/jadwal', [MaintenanceScheduleController::class, 'index'])->name('pelaksana.daftarjadwal');
    Route::get('/pelaksana/jadwal/{jadwal}', [MaintenanceScheduleController::class, 'show'])->name('pelaksana.jadwal.show');
    Route::get('/pelaksana/jadwal/{jadwal}/edit', [MaintenanceScheduleController::class, 'edit'])->name('pelaksana.asetjadwal');
    Route::patch('/pelaksana/jadwal/{jadwal}/approve', [MaintenanceScheduleController::class, 'approve'])->name('pelaksana.jadwal.approve');
    Route::delete('/pelaksana/jadwal/{jadwal}', [MaintenanceScheduleController::class, 'destroy'])->name('pelaksana.jadwal.destroy');
    Route::put('/pelaksana/jadwal/{jadwal}', [MaintenanceScheduleController::class, 'update'])->name('pelaksana.jadwal.update');
});



=======
Route::middleware(['auth', 'role:pelaksana'])->prefix('pelaksana')->name('pelaksana.')->group(function () {
    Route::view('/', 'pelaksana.dashboard')->name('dashboard');
});
>>>>>>> 2ee3ae382efb6fae6098d1ccc99418a08c306b01

// ==========================
// Profile Routes
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, etc.)
require __DIR__ . '/auth.php';
