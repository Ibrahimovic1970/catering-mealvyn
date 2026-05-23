<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->string('status_kirim')->default('Menunggu Pengiriman')->after('status_pesan');
            $table->datetime('tgl_kirim')->nullable()->after('status_kirim');
            $table->datetime('tgl_sampai')->nullable()->after('tgl_kirim');
            $table->string('bukti_foto')->nullable()->after('tgl_sampai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            //
        });
    }
};
