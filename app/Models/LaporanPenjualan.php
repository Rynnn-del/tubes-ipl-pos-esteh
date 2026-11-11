<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    protected $table = 'laporan_penjualan';
    protected $primaryKey = 'id_laporan';
    protected $guarded = [];
}
