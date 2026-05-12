<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'telepon',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Helper methods untuk check role
    public function isAdmin()
    {
        return $this->level === 'admin';
    }

    public function isCEO()
    {
        return $this->level === 'ceo';
    }

    public function isPelanggan()
    {
        return $this->level === 'pelanggan';
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_pelanggan');
    }
}
