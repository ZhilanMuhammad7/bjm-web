<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kredit extends Model
{
    use HasFactory;
    protected $table = 'kredits';
    protected $fillable =
    [
        'user_id',
        'kredit_id',
        'name',
        'email',
        'no_hp',
        'ktp_sim',
        'kk',
        'slip_gaji',
        'alamat',
        'nama_produk',
        'thn_bayar',
        'bayar_pertama',
        'cicilan',
        'payment_method',
        'bukti_tf',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
