<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $guarded = [];

    public function detail_pesanan() {
        return $this->hasMany(DetailPesanan::class, 'id_menu');
    }

}
