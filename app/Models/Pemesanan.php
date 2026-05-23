<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';

    protected $fillable = [
        'no_resi',
        'id_pelanggan',
        'tgl_pesan',
        'total_bayar',
        'status_pesan',
        'alamat_pengiriman',
        'ongkir',
        'status_kirim',
        'tgl_kirim',
        'tgl_sampai',
        'bukti_foto',
    ];

    protected $casts = [
        'tgl_pesan' => 'datetime',
        'tgl_kirim' => 'datetime',
        'tgl_sampai' => 'datetime',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function detailPemesanans()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_pesan');
    }

    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'id_jenis_pembayaran');
    }
}