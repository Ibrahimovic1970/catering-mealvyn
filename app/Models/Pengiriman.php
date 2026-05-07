<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans';

    protected $fillable = [
        'tgl_kirim',
        'tgl_tiba',
        'status_kirim',
        'bukti_foto',
        'id_pesan',
        'id_user'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pesan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
