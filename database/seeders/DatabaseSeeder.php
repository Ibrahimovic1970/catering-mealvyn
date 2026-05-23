<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil semua seeder di sini
        $this->call([
            PaketSeeder::class,
            // Tambahkan seeder lain di sini jika ada
            // UserSeeder::class,
            // JenisPembayaranSeeder::class,
        ]);

        $this->command->info('✅ Semua seeder berhasil dijalankan!');
    }
}