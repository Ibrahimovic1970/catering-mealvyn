<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop table jika ada
        Schema::dropIfExists('detail_pemesanans');

        // Buat ulang tabel dengan struktur yang benar
        Schema::create('detail_pemesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pesan');
            $table->unsignedBigInteger('id_paket');
            $table->integer('jumlah')->default(1);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_pesan')->references('id')->on('pemesanans')->onDelete('cascade');
            $table->foreign('id_paket')->references('id')->on('pakets')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pemesanans');
    }
};