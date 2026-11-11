<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $guarded = [];

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function pembayaran() {
        return $this->hasOne(Pembayaran::class, 'id_transaksi');
    }
}
