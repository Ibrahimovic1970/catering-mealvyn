<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pakets';

    protected $fillable = [
        'nama_paket',
        'jenis',
        'kategori',
        'jumlah_pax',
        'harga_paket',
        'deskripsi',
        'foto1',
        'foto2',
        'foto3',
        'is_active'
    ];

    protected $dates = ['deleted_at'];

    public function detailPemesanans()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_paket');
    }
}
