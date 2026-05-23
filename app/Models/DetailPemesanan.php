<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pemesanans';

    protected $fillable = [
        'id_pesan',
        'id_paket',
        'jumlah',
        'subtotal',
    ];

    // PERBAIKAN PENTING: Beritahu Laravel foreign key-nya 'id_pesan'
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pesan');
    }

    // Relasi ke Paket
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}