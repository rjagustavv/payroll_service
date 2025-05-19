<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\Karyawan\AbsensiController as KaryawanAbsensiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Admin\GajiController as AdminGajiController;

Route::get('/', function () {
    // return view('welcome'); // Default
    return redirect()->route('login'); // Arahkan ke login
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form'); // Beri nama berbeda untuk GET
Route::post('/register', [AuthController::class, 'register'])->name('register'); 


// Karyawan Routes
Route::middleware(['auth', 'karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/dashboard', [KaryawanDashboardController::class, 'index'])->name('dashboard');
    Route::post('/presensi/masuk', [KaryawanAbsensiController::class, 'presensiMasuk'])->name('presensi.masuk');
    Route::post('/presensi/pulang', [KaryawanAbsensiController::class, 'presensiPulang'])->name('presensi.pulang');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('karyawan', KaryawanController::class);
    
    Route::get('/absensi/rekap', [AdminAbsensiController::class, 'rekap'])->name('absensi.rekap');

    Route::get('/karyawan/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');

    // Tambahkan route untuk CRUD Absensi oleh admin jika diperlukan
    // Route::resource('absensi', AdminAbsensiController::class)->except(['show']);


    Route::get('/gaji', [AdminGajiController::class, 'index'])->name('gaji.index');
    Route::post('/gaji/proses', [AdminGajiController::class, 'prosesGaji'])->name('gaji.proses');
    Route::get('/gaji/slip/{gaji_id}', [AdminGajiController::class, 'cetakSlip'])->name('gaji.slip');
});
