<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            // Tambah kolom alamat_pengiriman jika belum ada
            if (!Schema::hasColumn('pemesanans', 'alamat_pengiriman')) {
                $table->text('alamat_pengiriman')->nullable()->after('status_pesan');
            }

            // Tambah kolom ongkir jika belum ada
            if (!Schema::hasColumn('pemesanans', 'ongkir')) {
                $table->decimal('ongkir', 12, 2)->default(0)->after('alamat_pengiriman');
            }

            // Tambah kolom status_kirim jika belum ada
            if (!Schema::hasColumn('pemesanans', 'status_kirim')) {
                $table->string('status_kirim')->default('Menunggu Pengiriman')->after('ongkir');
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            if (Schema::hasColumn('pemesanans', 'alamat_pengiriman')) {
                $table->dropColumn('alamat_pengiriman');
            }
            if (Schema::hasColumn('pemesanans', 'ongkir')) {
                $table->dropColumn('ongkir');
            }
            if (Schema::hasColumn('pemesanans', 'status_kirim')) {
                $table->dropColumn('status_kirim');
            }
            if (Schema::hasColumn('pemesanans', 'tgl_kirim')) {
                $table->dropColumn('tgl_kirim');
            }
            if (Schema::hasColumn('pemesanans', 'tgl_sampai')) {
                $table->dropColumn('tgl_sampai');
            }
            if (Schema::hasColumn('pemesanans', 'bukti_foto')) {
                $table->dropColumn('bukti_foto');
            }
        });
    }
};