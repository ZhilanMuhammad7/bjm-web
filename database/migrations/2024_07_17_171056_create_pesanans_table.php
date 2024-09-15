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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('image_produk');
            $table->string('nama_produk');
            $table->text('deskripsi_produk');
            $table->integer('harga_produk');
            $table->integer('subtotal_produk');
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->string('email');
            $table->string('status');
            $table->integer('jumlah_produk');
            $table->integer('total_keseluruhan');
            $table->integer('user_id');
            $table->string('payment_method');
            $table->integer('pajak');
            $table->integer('ongkir');
            $table->string('order_id');
            $table->string('invoice');
            $table->string('snap_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
