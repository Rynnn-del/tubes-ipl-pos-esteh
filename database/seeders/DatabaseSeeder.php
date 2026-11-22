<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\StokBahanBaku;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin & Kasir
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nama' => 'Arya Admin',
            'role' => 'Admin',
            'no_hp' => '081234567890'
        ]);

        User::create([
            'username' => 'kasir',
            'password' => Hash::make('kasir123'),
            'nama' => 'Budi Kasir',
            'role' => 'Kasir',
            'no_hp' => '089876543210'
        ]);

        // 2. Data Menu Es Teh
        Menu::create([
            'nama_menu' => 'Es Teh Original',
            'kategori' => 'Minuman Dingin',
            'harga' => 5000,
            'status_menu' => 'Tersedia'
        ]);

        Menu::create([
            'nama_menu' => 'Es Teh Kampul',
            'kategori' => 'Minuman Dingin',
            'harga' => 7000,
            'status_menu' => 'Tersedia'
        ]);

        Menu::create([
            'nama_menu' => 'Es Teh Susu',
            'kategori' => 'Minuman Dingin',
            'harga' => 8000,
            'status_menu' => 'Tersedia'
        ]);

        // 3. Data Stok Bahan Baku Awal
        StokBahanBaku::create([
            'nama_bahan' => 'Cup Plastik',
            'jumlah_stok' => 200,
            'satuan' => 'Pcs',
            'batas_minimum' => 50,
            'tanggal_update' => now()
        ]);

        StokBahanBaku::create([
            'nama_bahan' => 'Teh Melati Bubuk',
            'jumlah_stok' => 5000,
            'satuan' => 'Gram',
            'batas_minimum' => 500,
            'tanggal_update' => now()
        ]);

        // 4. Data Pelanggan (ID 1 default untuk pembeli umum/walk-in)
        Pelanggan::create([
            'nama_pelanggan' => 'Pelanggan Umum',
            'no_hp' => '-',
            'alamat' => '-'
        ]);

        Pelanggan::create([
            'nama_pelanggan' => 'Siti Aminah',
            'no_hp' => '081299887766',
            'alamat' => 'Jl. Cibeber No. 12'
        ]);

        // 5. Contoh Transaksi 1 (Cash - 2 item berbeda untuk tes Struk)
        $pesanan1 = Pesanan::create([
            'id_pelanggan' => 1,
            'id_user' => 2,
            'tanggal_pesanan' => now()->subHours(2),
            'status_pesanan' => 'Selesai',
            'total_pesanan' => 18000
        ]);

        DetailPesanan::create([
            'id_pesanan' => $pesanan1->id_pesanan,
            'id_menu' => 1, // Es Teh Original
            'jumlah' => 2,
            'harga_satuan' => 5000,
            'subtotal' => 10000
        ]);

        DetailPesanan::create([
            'id_pesanan' => $pesanan1->id_pesanan,
            'id_menu' => 3, // Es Teh Susu
            'jumlah' => 1,
            'harga_satuan' => 8000,
            'subtotal' => 8000
        ]);

        $transaksi1 = Transaksi::create([
            'id_pesanan' => $pesanan1->id_pesanan,
            'id_user' => 2,
            'tanggal_transaksi' => now()->subHours(2),
            'total_bayar' => 18000,
            'status_transaksi' => 'Lunas'
        ]);

        Pembayaran::create([
            'id_transaksi' => $transaksi1->id_transaksi,
            'metode_pembayaran' => 'Cash',
            'nominal_bayar' => 20000,
            'status_pembayaran' => 'Sukses'
        ]);

        // 6. Contoh Transaksi 2 (QRIS - Pelanggan terdaftar)
        $pesanan2 = Pesanan::create([
            'id_pelanggan' => 2,
            'id_user' => 2,
            'tanggal_pesanan' => now()->subHour(),
            'status_pesanan' => 'Selesai',
            'total_pesanan' => 14000
        ]);

        DetailPesanan::create([
            'id_pesanan' => $pesanan2->id_pesanan,
            'id_menu' => 2, // Es Teh Kampul
            'jumlah' => 2,
            'harga_satuan' => 7000,
            'subtotal' => 14000
        ]);

        $transaksi2 = Transaksi::create([
            'id_pesanan' => $pesanan2->id_pesanan,
            'id_user' => 2,
            'tanggal_transaksi' => now()->subHour(),
            'total_bayar' => 14000,
            'status_transaksi' => 'Lunas'
        ]);

        Pembayaran::create([
            'id_transaksi' => $transaksi2->id_transaksi,
            'metode_pembayaran' => 'QRIS',
            'nominal_bayar' => 14000,
            'status_pembayaran' => 'Sukses'
        ]);
    }
}