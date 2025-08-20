<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MunaqasahController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliController;
use App\Models\Siswa;
use Illuminate\Support\Facades\Route;



Route::get('/', [AuthController::class, 'showLoginForm'])->name('showlogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Grup route untuk admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('wali', WaliController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('munaqasah', MunaqasahController::class);
    Route::resource('pembayaran', PembayaranController::class);

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// Grup route untuk guru
Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [SetorController::class, 'index'])->name('guru.dashboard');

    Route::get('hafalan', [SetorController::class, 'hafalan'])->name('setor.hafalan');
    Route::get('hafalan-siswa/{id}', [SetorController::class, 'hafalanSiswa'])->name('setor.hafalanSiswa');
    Route::post('tambah-setor/{siswa}/{doa}', [SetorController::class, 'tambahSetor'])->name('guru.tambahSetor');
    Route::get('bacaan', [SetorController::class, 'bacaan'])->name('setor.bacaan');
    Route::get('bacaan-siswa/{id}', [SetorController::class, 'bacaanSiswa'])->name('setor.bacaanSiswa');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});

// Grup route untuk wali
Route::middleware(['auth', 'role:wali'])->prefix('wali')->group(function () {
    Route::get('/dashboard', function () {
        return view('wali.dashboard');
    })->name('wali.dashboard');
});