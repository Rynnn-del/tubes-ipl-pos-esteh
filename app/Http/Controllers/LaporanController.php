<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function transaksi()
    {
        $transaksis = Transaksi::with([
            'pesanan.pelanggan',
            'pesanan.detail_pesanan.menu',
            'pembayaran',
            'user'
        ])
        ->orderBy('tanggal_transaksi', 'desc')
        ->get();

        return view('laporan.transaksi', compact('transaksis'));
    }
}
