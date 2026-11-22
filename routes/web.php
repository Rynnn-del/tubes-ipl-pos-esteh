
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StrukController;

Route::get('/', function () {
    return view('welcome');
});

// Halaman kasir
Route::get('/kasir', [TransaksiController::class, 'index']);
Route::post('/kasir/bayar', [TransaksiController::class, 'store']);

// Halaman laporan transaksi
Route::get('/laporan/transaksi', [LaporanController::class, 'transaksi']);

// Halaman cetak struk
Route::get('/struk/{id}', [StrukController::class, 'cetak']);