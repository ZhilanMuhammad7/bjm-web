<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table='produks';
    protected $fillable=[
        "judul",
        "produk_id",
        "brand",
        "merk",
        "tahun",
        "kilometer",
        "bahan_bakar",
        "warna",
        "transmisi",
        "kapasitas_mesin",
        "tipe",
        "harga",
        "deskripsi",
        "gambar1",
        "gambar2",
        "gambar3",
        "gambar4",
        "gambar5",
    ];
    protected $primaryKey = 'id';
}
