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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->integer('produk_id');
            $table->string('brand');
            $table->string('judul');
            $table->string('merk');
            $table->integer('tahun'); // Ubah int menjadi integer
            $table->string('kilometer');
            $table->string('bahan_bakar');
            $table->string('warna');
            $table->string('transmisi');
            $table->string('kapasitas_mesin');
            $table->string('tipe');
            $table->integer('harga'); // Ubah int menjadi integer
            $table->string('deskripsi');
            $table->string('gambar1');
            $table->string('gambar2');
            $table->string('gambar3');
            $table->string('gambar4');
            $table->string('gambar5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
