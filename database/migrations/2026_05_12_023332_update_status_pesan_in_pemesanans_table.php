<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            // Ubah kolom status_pesan dengan ENUM yang lebih lengkap
            DB::statement("ALTER TABLE pemesanans MODIFY COLUMN status_pesan ENUM('Menunggu Konfirmasi', 'Sedang Diproses', 'Menunggu Kurir', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu Konfirmasi'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            // Kembalikan ke ENUM lama
            DB::statement("ALTER TABLE pemesanans MODIFY COLUMN status_pesan ENUM('Menunggu Konfirmasi', 'Sedang Diproses', 'Menunggu Kurir') DEFAULT 'Menunggu Konfirmasi'");
        });
    }
};
