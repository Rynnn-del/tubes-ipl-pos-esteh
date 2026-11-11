<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stok_bahan_baku', function (Blueprint $table) {
            $table->id('id_stok');
            $table->string('nama_bahan', 100);
            $table->decimal('jumlah_stok', 12, 2);
            $table->string('satuan', 20);
            $table->decimal('batas_minimum', 12, 2);
            $table->dateTime('tanggal_update');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_bahan_bakus');
    }
};
