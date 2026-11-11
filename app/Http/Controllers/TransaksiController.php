<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // 1. Menampilkan halaman kasir (Mengambil data menu dari database)
    public function index()
    {
        // Mengambil semua menu yang statusnya 'Tersedia'
        $menus = Menu::where('status_menu', 'Tersedia')->get();
        
        // Mengirim data menu ke halaman web (view) yang nanti dibuat Raziq/Alfa
        return view('kasir.index', compact('menus')); 
    }

    // 2. Memproses ketika tombol "Bayar" diklik
    public function store(Request $request)
    {
        // DB::beginTransaction digunakan agar jika ada error di tengah jalan, 
        // data tidak jadi tersimpan (mencegah data setengah masuk).
        DB::beginTransaction();
        try {
            // A. Buat Data Pesanan Baru
            $pesanan = Pesanan::create([
                'id_pelanggan' => 1, // Sementara default pelanggan 1
                'id_user' => 2,      // Sementara default kasir (id: 2)
                'tanggal_pesanan' => now(),
                'status_pesanan' => 'Selesai',
                'total_pesanan' => $request->total_harga
            ]);

            // B. Simpan Detail Pesanan (Looping menu apa saja yang dibeli)
            foreach ($request->items as $item) {
                DetailPesanan::create([
                    'id_pesanan' => $pesanan->id_pesanan,
                    'id_menu' => $item['id_menu'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga'],
                    'subtotal' => $item['jumlah'] * $item['harga']
                ]);
            }

            // C. Catat ke Tabel Transaksi
            $transaksi = Transaksi::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_user' => 2,
                'tanggal_transaksi' => now(),
                'total_bayar' => $request->nominal_bayar,
                'status_transaksi' => 'Lunas'
            ]);

            // D. Catat Metode Pembayaran
            Pembayaran::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'metode_pembayaran' => $request->metode_pembayaran, // Cash / QRIS
                'nominal_bayar' => $request->nominal_bayar,
                'status_pembayaran' => 'Sukses'
            ]);

            DB::commit(); // Simpan permanen ke database
            return response()->json(['status' => 'sukses', 'pesan' => 'Transaksi Berhasil!']);

        } catch (\Exception $e) {
            DB::rollback(); // Batalkan semua penulisan database jika error
            return response()->json(['status' => 'gagal', 'pesan' => $e->getMessage()]);
        }
    }
}