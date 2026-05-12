<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'level')) {
                $table->enum('level', ['admin', 'ceo', 'pelanggan'])->default('pelanggan')->after('password');
            }
            if (!Schema::hasColumn('users', 'telepon')) {
                $table->string('telepon', 15)->nullable()->after('level');
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('telepon');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['level', 'telepon', 'alamat']);
        });
    }
};
