<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;

// Arahkan halaman utama langsung ke /kasir (kalau belum login otomatis dilempar ke /login)
Route::get('/', function () {
    return redirect('/kasir');
});

// Rute Autentikasi (Tamu yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

// Rute Logout (Hanya untuk yang sudah login)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rute Kasir & Transaksi (Bisa diakses Admin dan Kasir)
Route::middleware(['auth', 'role:Admin,Kasir'])->group(function () {
    Route::get('/kasir', [TransaksiController::class, 'index'])->name('kasir.index');
    Route::post('/kasir/bayar', [TransaksiController::class, 'store'])->name('kasir.bayar');

    // Nanti Vina bisa menaruh rute laporan transaksi & cetak struk di dalam grup ini
});

// Rute Khusus Admin (Nanti Nabila bisa menaruh rute CRUD Menu & Stok di dalam grup ini)
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Contoh: Route::resource('/menu', MenuController::class);
});