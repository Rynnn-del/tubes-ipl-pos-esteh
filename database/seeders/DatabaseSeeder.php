<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\StokBahanBaku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Akun Admin & Kasir
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

        // 2. Membuat Data Menu Es Teh
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

        // 3. Membuat Data Stok Bahan Baku Awal
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
    }
}