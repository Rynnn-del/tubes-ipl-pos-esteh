<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class StrukController extends Controller
{
    public function cetak($id)
    {
        $transaksi = Transaksi::with([
            'pesanan.pelanggan',
            'pesanan.detail_pesanan.menu',
            'user',
            'pembayaran'
        ])->findOrFail($id);

        return view('struk.cetak', compact('transaksi'));
    }
}
