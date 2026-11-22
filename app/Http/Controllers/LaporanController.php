<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function transaksi(Request $request)
    {
        $query = Transaksi::with([
            'pesanan.pelanggan',
            'pesanan.detail_pesanan.menu',
            'pembayaran',
            'user'
        ]);

        // Pencarian berdasarkan ID transaksi atau nama pelanggan
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('id_transaksi', 'like', "%{$keyword}%")
                    ->orWhereHas('pesanan.pelanggan', function ($pelanggan) use ($keyword) {
                        $pelanggan->where(
                            'nama_pelanggan',
                            'like',
                            "%{$keyword}%"
                        );
                    });
            });
        }

        // Filter tanggal awal
        if ($request->filled('tanggal_awal')) {
            $query->whereDate(
                'tanggal_transaksi',
                '>=',
                $request->tanggal_awal
            );
        }

        // Filter tanggal akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate(
                'tanggal_transaksi',
                '<=',
                $request->tanggal_akhir
            );
        }

        $transaksis = $query
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        return view('laporan.transaksi', compact('transaksis'));
    }
}
