<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\ManagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// 🔐 Redirect ke dashboard berdasarkan role setelah login
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
// ✅ Admin Routes
// ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
    Route::get('/jadwal', fn () => view('admin.jadwal'))->name('jadwal');
    Route::get('/aset', fn () => view('admin.aset'))->name('aset');
});


// ==========================
// ✅ Manager Routes
// ==========================
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/', fn () => view('manager.dashboard'))->name('dashboard');

    // Daftar semua jadwal
    Route::get('/jadwal', [ManagerController::class, 'index'])->name('jadwal');

    // Detail jadwal dan form inspeksi
    Route::get('/jadwal/{id}', [ManagerController::class, 'detail'])->name('jadwal.detail');

    // Ganti status menjadi Dilaksanakan
    Route::post('/jadwal/{id}/start', [ManagerController::class, 'mulai'])->name('jadwal.mulai');

    // Ganti status menjadi Terlaksana
    Route::post('/jadwal/{id}/selesai', [ManagerController::class, 'selesai'])->name('jadwal.selesai');
});


// ==========================
// ✅ PIC Routes
// ==========================
Route::middleware(['auth', 'role:pic'])->prefix('pic')->name('pic.')->group(function () {
    Route::get('/', [PicController::class, 'dashboard'])->name('dashboard');

    // Daftar jadwal
    Route::get('/jadwal', [PicController::class, 'jadwal'])->name('jadwal');

    // Lihat form laporan / detail
    Route::get('/jadwal/{id}/detail', [PicController::class, 'lihatJadwal'])->name('jadwal.detail');

    // Approve / Reject
    Route::get('/jadwal/{id}/approve', [PicController::class, 'approve'])->name('jadwal.approve');
    Route::get('/jadwal/{id}/reject', [PicController::class, 'reject'])->name('jadwal.reject');

    // Simpan laporan
    Route::post('/jadwal/{id}/laporan', [PicController::class, 'simpanLaporan'])->name('laporan.store');

    // Lihat laporan (readonly)
    Route::get('/laporan/{id}/lihat', [PicController::class, 'lihatLaporan'])->name('laporan.show');

    // Edit laporan (opsional)
    Route::get('/laporan/{id}/edit', [PicController::class, 'editLaporan'])->name('laporan.edit');
    Route::put('/laporan/{id}', [PicController::class, 'updateLaporan'])->name('laporan.update');
});


// ==========================
// ✅ Pelaksana Routes
// ==========================
Route::middleware(['auth', 'role:pelaksana'])->prefix('pelaksana')->name('pelaksana.')->group(function () {
    Route::get('/', fn () => view('pelaksana.dashboard'))->name('dashboard');
});


// ==========================
// ✅ Profile Routes (Laravel Breeze)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
