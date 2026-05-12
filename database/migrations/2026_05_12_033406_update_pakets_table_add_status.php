<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom status untuk soft delete
        if (!Schema::hasColumn('pakets', 'is_active')) {
            Schema::table('pakets', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('deskripsi');
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::table('pakets', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'deleted_at']);
        });
    }
};
