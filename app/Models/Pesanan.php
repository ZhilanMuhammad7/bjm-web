<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';


    protected $fillable = [
        'image_produk',
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'subtotal_produk',
        'nama_lengkap',
        'no_hp',
        'email',
        'jumlah_produk',
        'user_id', // Kolom yang akan digunakan untuk kunci asing ke tabel users
        'status',
        'total_keseluruhan',
        'payment_method',
        'shipping_method',
        'snap_token',
        'order_id',
        'invoice',
        'pajak',
        'ongkir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
