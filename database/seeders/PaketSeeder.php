<?php

namespace Database\Seeders;

use App\Models\Paket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan foreign key check agar truncate tidak bentrok dengan detail_pemesanans
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // 2. Kosongkan tabel pakets (menghapus semua data lama & duplikat)
        Paket::truncate();

        // 3. Nyalakan kembali foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // 4. Data paket lengkap (22 Paket)
        $pakets = [
            // ==================== PERNIKAHAN (4) ====================
            [
                'nama_paket' => 'Paket Sakinah Mawaddah',
                'kategori' => 'Pernikahan',
                'jenis' => 'Prasmanan',
                'jumlah_pax' => 100,
                'harga_paket' => 85000,
                'deskripsi' => 'Paket lengkap untuk resepsi pernikahan impian Anda dengan menu: Nasi Mandhi, Rendang Daging, Ayam Bakar Taliwang, Gulai Kambing, Sayur Sop, Buah Segar, dan Dessert.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Mahar Agung',
                'kategori' => 'Pernikahan',
                'jenis' => 'Prasmanan',
                'jumlah_pax' => 200,
                'harga_paket' => 150000,
                'deskripsi' => 'Paket eksklusif dengan menu buffet lengkap dan live cooking station: Nasi Biryani, Wagyu Rendang, Ikan Bakar Jimbaran, Udang Saus Padang, Salad Premium, Dessert Bar, dan Welcome Drink.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Akad Nikah',
                'kategori' => 'Pernikahan',
                'jenis' => 'Box',
                'jumlah_pax' => 50,
                'harga_paket' => 55000,
                'deskripsi' => 'Paket sederhana namun elegan khusus untuk acara akad nikah: Nasi Kuning Tumpeng, Ayam Goreng Kremes, Telur Balado, Lalapan, Sambal, Kolak Pisang, dan Teh Manis.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Resepsi Gold',
                'kategori' => 'Pernikahan',
                'jenis' => 'Prasmanan',
                'jumlah_pax' => 300,
                'harga_paket' => 120000,
                'deskripsi' => 'Paket premium untuk resepsi mewah: Nasi Kebuli, Domba Panggang, Ayam Bakar Bumbu Rujak, Cumi Saus Tiram, Gado-gado, Es Buah, dan Fruit Platter.',
                'is_active' => true,
            ],

            // ==================== SELAMATAN (4) ====================
            [
                'nama_paket' => 'Paket Syukuran',
                'kategori' => 'Selamatan',
                'jenis' => 'Box',
                'jumlah_pax' => 30,
                'harga_paket' => 35000,
                'deskripsi' => 'Paket lengkap untuk acara selamatan, tasyakuran, dan doa bersama: Nasi Putih, Ayam Bakar/Goreng, Perkedel, Acar, Kerupuk, Pisang, Puding, dan Teh Manis.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Hajatan',
                'kategori' => 'Selamatan',
                'jenis' => 'Prasmanan',
                'jumlah_pax' => 100,
                'harga_paket' => 65000,
                'deskripsi' => 'Paket lengkap untuk acara hajatan, khitanan, atau syukuran besar: Nasi Kebuli/Mandhi, Rendang/Gulai, Ayam Bakar Spesial, Sayur Asem/Sop, Gado-gado, Es Buah, dan Buah-buahan.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Nasi Box Doa',
                'kategori' => 'Selamatan',
                'jenis' => 'Box',
                'jumlah_pax' => 50,
                'harga_paket' => 25000,
                'deskripsi' => 'Nasi box praktis untuk selamatan sederhana dan doa bersama: Nasi Putih, Ayam Goreng, Telur Balado, Acar, Pisang, dan Air Mineral.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Tasyakuran Premium',
                'kategori' => 'Selamatan',
                'jenis' => 'Prasmanan',
                'jumlah_pax' => 75,
                'harga_paket' => 75000,
                'deskripsi' => 'Paket tasyakuran dengan menu premium: Nasi Kuning Komplit, Ayam Goreng Lengkuas, Rendang Daging, Sambal Goreng Ati, Urap Sayur, Kerupuk, dan Es Campur.',
                'is_active' => true,
            ],

            // ==================== ULANG TAHUN (4) ====================
            [
                'nama_paket' => 'Paket Birthday Kids',
                'kategori' => 'Ulang Tahun',
                'jenis' => 'Box',
                'jumlah_pax' => 20,
                'harga_paket' => 75000,
                'deskripsi' => 'Paket seru untuk pesta ulang tahun anak-anak dengan menu fav: Mini Burger/Hotdog, Pizza Slice, French Fries, Chicken Nugget, Juice Box, Birthday Cake (custom), dan Candy Bar.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Sweet Seventeen',
                'kategori' => 'Ulang Tahun',
                'jenis' => 'Box',
                'jumlah_pax' => 30,
                'harga_paket' => 95000,
                'deskripsi' => 'Paket elegan untuk ulang tahun remaja dengan menu kekinian dan aesthetic: Pasta/Spaghetti, Chicken Steak, Caesar Salad, Loaded Fries, Bubble Tea/Smoothie, Mini Cupcakes (6 pcs), dan Custom Cake.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Ulang Tahun Dewasa',
                'kategori' => 'Ulang Tahun',
                'jenis' => 'Prasmanan',
                'jumlah_pax' => 50,
                'harga_paket' => 65000,
                'deskripsi' => 'Paket santai dan nikmat untuk perayaan ulang tahun orang dewasa: Nasi Goreng Spesial, Sate Ayam/Kambing, Tongseng/Sup Kambing, Gado-gado, Es Campur/Es Teler, dan Slice Cake.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Birthday Party Deluxe',
                'kategori' => 'Ulang Tahun',
                'jenis' => 'Prasmanan',
                'jumlah_pax' => 100,
                'harga_paket' => 110000,
                'deskripsi' => 'Paket pesta ulang tahun mewah: Buffet Lengkap, Ayam Bakar Madu, Beef Steak, Spaghetti Bolognese, Roast Chicken, Salad Bar, Dessert Table, dan Custom Birthday Cake.',
                'is_active' => true,
            ],

            // ==================== STUDI TOUR (5) ====================
            [
                'nama_paket' => 'Paket Snack Box Siswa',
                'kategori' => 'Studi Tour',
                'jenis' => 'Box',
                'jumlah_pax' => 30,
                'harga_paket' => 18000,
                'deskripsi' => 'Snack box praktis dan bergizi untuk anak-anak selama perjalanan study tour: Roti Bakar/Sandwich, Juice Box, Cookies/Biskuit, Buah Potong, dan Air Mineral.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Lunch Box Siswa',
                'kategori' => 'Studi Tour',
                'jenis' => 'Box',
                'jumlah_pax' => 50,
                'harga_paket' => 28000,
                'deskripsi' => 'Nasi box lengkap dan bergizi untuk makan siang selama study tour: Nasi Putih, Ayam Goreng/Bakar, Telur Dadar/Ceplok, Acar Timun, Pisang/Buah, Juice, dan Air Mineral.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Bento Box Premium',
                'kategori' => 'Studi Tour',
                'jenis' => 'Box',
                'jumlah_pax' => 40,
                'harga_paket' => 38000,
                'deskripsi' => 'Bento box premium dengan menu sehat dan menarik untuk siswa: Nasi Onigiri, Chicken Katsu, Vegetable Roll, Tamagoyaki, Fruit Cup, Yakult/Juice, dan Air Mineral.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Full Day Tour',
                'kategori' => 'Studi Tour',
                'jenis' => 'Box',
                'jumlah_pax' => 60,
                'harga_paket' => 45000,
                'deskripsi' => 'Paket lengkap untuk study tour seharian: Snack Pagi (Roti + Juice), Lunch Box (Nasi + Ayam + Sayur + Buah), Snack Sore (Biskuit + Susu), dan 2 Botol Air Mineral.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Camping Box',
                'kategori' => 'Studi Tour',
                'jenis' => 'Box',
                'jumlah_pax' => 35,
                'harga_paket' => 32000,
                'deskripsi' => 'Paket praktis untuk kegiatan camping/outdoor: Nasi Goreng/Mie Goreng, Ayam Bakar, Telur Rebus, Kerupuk, Buah, Teh Hangat/Dingin, dan Air Mineral.',
                'is_active' => true,
            ],

            // ==================== RAPAT (5) ====================
            [
                'nama_paket' => 'Paket Coffee Break',
                'kategori' => 'Rapat',
                'jenis' => 'Box',
                'jumlah_pax' => 20,
                'harga_paket' => 45000,
                'deskripsi' => 'Paket coffee break lengkap untuk menemani sesi meeting dan diskusi: Kopi/Teh/Susu, Croissant/Danish, Mini Cake (2 pcs), Cookies/Biskuit, Fruit Platter, dan Air Mineral.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Seminar Box',
                'kategori' => 'Rapat',
                'jenis' => 'Box',
                'jumlah_pax' => 50,
                'harga_paket' => 55000,
                'deskripsi' => 'Nasi box profesional untuk seminar, workshop, dan training karyawan: Nasi Putih/Nasi Goreng, Ayam/Beef Steak, Salad/Vegetable, Buah Segar, Juice/Teh, dan Air Mineral.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Full Day Meeting',
                'kategori' => 'Rapat',
                'jenis' => 'Box',
                'jumlah_pax' => 30,
                'harga_paket' => 120000,
                'deskripsi' => 'Paket lengkap pagi-siang-sore untuk meeting seharian penuh: Morning (Kopi + Pastry), Lunch (Nasi Box Premium), Afternoon (Coffee Break 2), Fruit & Snack, dan 3 Botol Air Mineral.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Executive Lunch',
                'kategori' => 'Rapat',
                'jenis' => 'Box',
                'jumlah_pax' => 25,
                'harga_paket' => 75000,
                'deskripsi' => 'Nasi box executive untuk meeting penting: Nasi Putih, Beef Tenderloin/Chicken Steak, Mashed Potato, Grilled Vegetable, Fresh Fruit, Juice Premium, dan Air Mineral.',
                'is_active' => true,
            ],
            [
                'nama_paket' => 'Paket Training Box',
                'kategori' => 'Rapat',
                'jenis' => 'Box',
                'jumlah_pax' => 40,
                'harga_paket' => 48000,
                'deskripsi' => 'Paket hemat untuk training karyawan: Nasi Putih, Ayam Goreng/Bakar, Capcay/Tumis Sayur, Kerupuk, Pisang, Teh Kotak, dan Air Mineral.',
                'is_active' => true,
            ],
        ];

        // 5. Masukkan semua data ke database
        foreach ($pakets as $paket) {
            Paket::create($paket);
        }

        $this->command->info('✅ Seeder berhasil! Total ' . count($pakets) . ' paket ditambahkan tanpa duplikat.');
    }
}