
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});

// Halaman kasir
Route::get('/kasir', [TransaksiController::class, 'index']);
Route::post('/kasir/bayar', [TransaksiController::class, 'store']);

// Halaman laporan transaksi
Route::get('/laporan/transaksi', [LaporanController::class, 'transaksi']);
