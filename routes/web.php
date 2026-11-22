<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StrukController;

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

// Rute Kasir, Transaksi, Laporan & Struk (Bisa diakses Admin dan Kasir)
Route::middleware(['auth', 'role:Admin,Kasir'])->group(function () {
    Route::get('/kasir', [TransaksiController::class, 'index'])->name('kasir.index');
    Route::post('/kasir/bayar', [TransaksiController::class, 'store'])->name('kasir.bayar');

    // Halaman laporan transaksi & cetak struk (Vina)
    Route::get('/laporan/transaksi', [LaporanController::class, 'transaksi']);
    Route::get('/struk/{id}', [StrukController::class, 'cetak']);
});

// Rute Khusus Admin (Nanti Nabila bisa menaruh rute CRUD Menu & Stok di dalam grup ini)
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Contoh: Route::resource('/menu', MenuController::class);
});