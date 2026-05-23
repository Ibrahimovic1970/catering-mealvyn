<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResetPasswordSeeder extends Seeder
{
    public function run(): void
    {
        // Reset atau Buat CEO
        User::updateOrCreate(
            ['email' => 'ceo@mealvyn.id'],
            [
                'name' => 'CEO Mealvyn',
                'password' => Hash::make('password123'),
                'level' => 'ceo',
                'telepon' => '081234567890',
                'alamat' => 'Jakarta',
            ]
        );

        // Reset atau Buat Admin
        User::updateOrCreate(
            ['email' => 'admin@mealvyn.id'],
            [
                'name' => 'Admin Mealvyn',
                'password' => Hash::make('password123'),
                'level' => 'admin',
                'telepon' => '081234567891',
                'alamat' => 'Bandung',
            ]
        );

        $this->command->info('✅ CEO & Admin berhasil direset!');
        $this->command->info('Email: ceo@mealvyn.id | Password: password123');
        $this->command->info('Email: admin@mealvyn.id | Password: password123');
    }
}