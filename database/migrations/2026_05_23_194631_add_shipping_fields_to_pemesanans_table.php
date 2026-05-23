<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            // Tambah kolom status_kirim jika belum ada
            if (!Schema::hasColumn('pemesanans', 'status_kirim')) {
                $table->string('status_kirim')->default('Menunggu Pengiriman')->after('status_pesan');
            }

            // Tambah kolom tgl_kirim jika belum ada
            if (!Schema::hasColumn('pemesanans', 'tgl_kirim')) {
                $table->datetime('tgl_kirim')->nullable()->after('status_kirim');
            }

            // Tambah kolom tgl_sampai jika belum ada
            if (!Schema::hasColumn('pemesanans', 'tgl_sampai')) {
                $table->datetime('tgl_sampai')->nullable()->after('tgl_kirim');
            }

            // Tambah kolom bukti_foto jika belum ada
            if (!Schema::hasColumn('pemesanans', 'bukti_foto')) {
                $table->string('bukti_foto')->nullable()->after('tgl_sampai');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn(['status_kirim', 'tgl_kirim', 'tgl_sampai', 'bukti_foto']);
        });
    }
};