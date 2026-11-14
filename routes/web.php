<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\TransaksiController;

// Jalur untuk membuka halaman kasir
Route::get('/kasir', [TransaksiController::class, 'index']);

// Jalur untuk mengirim data saat tombol bayar diklik
Route::post('/kasir/bayar', [TransaksiController::class, 'store']);

