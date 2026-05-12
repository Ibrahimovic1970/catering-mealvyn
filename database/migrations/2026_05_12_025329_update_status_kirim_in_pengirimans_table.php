<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pengirimans MODIFY COLUMN status_kirim ENUM('Sedang Dikirim', 'Tiba Ditujuan') DEFAULT 'Sedang Dikirim'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pengirimans MODIFY COLUMN status_kirim ENUM('Sedang Dikirim') DEFAULT 'Sedang Dikirim'");
    }
};
