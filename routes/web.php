<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\AsetController;
use App\Http\Controllers\Admin\ParameterController;
use App\Http\Controllers\Manager\JadwalManagerController;
use App\Http\Controllers\Pelaksana\JadwalPelaksanaController;
use App\Http\Controllers\Pelaksana\LaporanController as PelaksanaLaporanController;
use App\Http\Controllers\Pic\JadwalPicController;

// ==========================
// Halaman Utama
// ==========================
Route::get('/', fn () => view('auth.login'));

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
// Admin Routes
// ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Jadwal
    Route::prefix('jadwal')->name('jadwal.')->controller(AdminJadwalController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::post('/{id}/ajukan', 'ajukan')->name('ajukan');
        Route::post('/{id}/ubah-status', 'ubahStatus')->name('ubahStatus');
        Route::get('/get-assets/{lokasi_id}', 'getAssets')->name('getAssets');
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
        Route::get('/tambah', 'create')->name('create');
        Route::post('/tambah', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Detail Parameter
    Route::prefix('parameter/detail')->name('detail.')->controller(ParameterController::class)->group(function () {
        Route::get('/{id}/tambah', 'createDetail')->name('create');
        Route::post('/{id}/tambah', 'storeDetail')->name('store');
        Route::get('/{id}/edit', 'editDetail')->name('edit');
        Route::put('/{id}', 'updateDetail')->name('update');
        Route::delete('/{id}', 'destroyDetail')->name('destroy');
    });
});


// ==========================
// Manager Routes
// ==========================
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::view('/', 'manager.dashboard')->name('dashboard');

    Route::prefix('jadwal')->name('jadwal.')->controller(JadwalManagerController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}/detail', 'detail')->name('detail');
        Route::post('/{id}/approve', 'approve')->name('approve');
    });

    Route::prefix('laporan')->name('laporan.')->controller(JadwalManagerController::class)->group(function () {
        Route::get('/', 'laporan')->name('index');
        Route::get('/{jadwal}/laporan/{laporan}', 'detailLaporanLengkap')->name('detail_laporan');
        Route::get('/{jadwal}/detail/{detail}', 'detailLaporan')->name('detail');
        Route::post('/{detail}/approve', 'approveDetail')->name('approve');
    });
});


// ==========================
// PIC Routes
// ==========================
Route::middleware(['auth', 'role:pic'])->prefix('pic')->name('pic.')->group(function () {
    Route::view('/', 'pic.dashboard')->name('dashboard');

    Route::get('/laporan', [JadwalPicController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{id}', [JadwalPicController::class, 'show'])->name('laporan.show');
    Route::post('/laporan/{id}/approve', [JadwalPicController::class, 'approve'])->name('laporan.approve');
    Route::post('/laporan/approve-detail/{detail}', [JadwalPicController::class, 'approveDetail'])->name('laporan.approveDetail');
    Route::get('/laporan/detail/{jadwal}/{detail}', [JadwalPicController::class, 'showDetailLaporan'])->name('laporan.detail_laporan');
});


// ==========================
// Pelaksana Routes
// ==========================
Route::middleware(['auth', 'role:pelaksana'])->prefix('pelaksana')->name('pelaksana.')->group(function () {
    Route::view('/', 'pelaksana.dashboard')->name('dashboard');

    Route::get('/jadwal', [JadwalPelaksanaController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/{id}/detail', [JadwalPelaksanaController::class, 'detail'])->name('jadwal.detail');

    Route::post('/detail-type-inspeksi/store', [JadwalPelaksanaController::class, 'storeDetailTypeInspeksi'])->name('detail-type-inspeksi.store');

    // Laporan
    Route::get('/jadwal/{jadwal_id}/form-laporan/{detail_id}', [PelaksanaLaporanController::class, 'create'])->name('form_laporan');
    Route::post('/jadwal/{jadwal_id}/form-laporan/{detail_id}', [PelaksanaLaporanController::class, 'store'])->name('form_laporan.store');

    Route::get('/jadwal/{jadwal_id}/form-laporan/{detail_id}/edit', [PelaksanaLaporanController::class, 'edit'])->name('edit_laporan');
    Route::put('/jadwal/{jadwal_id}/form-laporan/{detail_id}', [PelaksanaLaporanController::class, 'update'])->name('edit_laporan.update');

    // ✅ Perbaikan submit all (TANPA double prefix)
    Route::post('/jadwal/{jadwal}/submit-all', [PelaksanaLaporanController::class, 'submitAll'])->name('laporan.submit_all');

    // Laporan lainnya
    Route::get('/laporan/{jadwal}/{detail}/print', [PelaksanaLaporanController::class, 'print'])->name('laporan.print');
    Route::get('/get-detail-type/{id}', [PelaksanaLaporanController::class, 'getDetailType'])->name('get_detail_type');
    Route::patch('/laporan/{id}/submit', [PelaksanaLaporanController::class, 'submit'])->name('laporan.submit');
});


// ==========================
// Profile
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// Auth (Fortify/Breeze/etc.)
// ==========================
require __DIR__ . '/auth.php';
