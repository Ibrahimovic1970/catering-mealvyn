<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;

class PaketSeeder extends Seeder
{
    public function run(): void
    {
        $pakets = [
            ['nama_paket' => 'Paket Sakinah Mawaddah', 'jenis' => 'Prasmanan', 'kategori' => 'Pernikahan', 'jumlah_pax' => 100, 'harga_paket' => 85000, 'deskripsi' => 'Paket lengkap untuk resepsi pernikahan impian Anda dengan menu: Nasi Mandhi, Rendang Daging Sapi, Ayam Bakar Taliwang, Gulai Kambing, Salad Segar, Gado-gado, Es Buah/Puding, dan Buah Potong.'],
            ['nama_paket' => 'Paket Mahar Agung', 'jenis' => 'Prasmanan', 'kategori' => 'Pernikahan', 'jumlah_pax' => 200, 'harga_paket' => 150000, 'deskripsi' => 'Paket eksklusif dengan menu buffet lengkap dan live cooking station: Nasi Mandhi/Biryani, Wagyu Rendang, Ikan Bakar Jimbaran, Udang Saus Padang, Prune Salad, Sop Buntut, Dessert Bar (3 pilihan), Welcome Drink, Fresh Fruit Platter.'],
            ['nama_paket' => 'Paket Akad Nikah', 'jenis' => 'Box', 'kategori' => 'Pernikahan', 'jumlah_pax' => 50, 'harga_paket' => 55000, 'deskripsi' => 'Paket sederhana namun elegan khusus untuk acara akad nikah: Nasi Kuning Tumpeng, Ayam Goreng Kremes, Telur Balado, Lalapan & Sambal, Kolak Pisang/Puding, Teh/Air Mineral.'],
            ['nama_paket' => 'Paket Syukuran', 'jenis' => 'Box', 'kategori' => 'Selamatan', 'jumlah_pax' => 30, 'harga_paket' => 35000, 'deskripsi' => 'Paket lengkap untuk acara selamatan, tasyakuran, dan doa bersama: Nasi Putih/Nasi Kuning, Ayam Bakar/Goreng, Perkedel/Bakwan, Acar & Kerupuk, Pisang/Buah, Puding/Kue Basah, Teh Manis/Air Mineral.'],
            ['nama_paket' => 'Paket Hajatan', 'jenis' => 'Prasmanan', 'kategori' => 'Selamatan', 'jumlah_pax' => 100, 'harga_paket' => 65000, 'deskripsi' => 'Paket lengkap untuk acara hajatan, khitanan, atau syukuran besar: Nasi Kebuli/Mandhi, Rendang/Gulai, Ayam Bakar Spesial, Sayur Asem/Sop, Gado-gado/Karedok, Es Buah/Kolak, Buah-buahan, Teh/Jus/Air Mineral.'],
            ['nama_paket' => 'Paket Nasi Box Doa', 'jenis' => 'Box', 'kategori' => 'Selamatan', 'jumlah_pax' => 50, 'harga_paket' => 25000, 'deskripsi' => 'Nasi box praktis untuk selamatan sederhana dan doa bersama: Nasi Putih, Ayam Goreng, Telur Balado, Acar, Pisang, Air Mineral.'],
            ['nama_paket' => 'Paket Birthday Kids', 'jenis' => 'Box', 'kategori' => 'Ulang Tahun', 'jumlah_pax' => 20, 'harga_paket' => 75000, 'deskripsi' => 'Paket seru untuk pesta ulang tahun anak-anak dengan menu favorit mereka: Mini Burger/Hotdog, Pizza Slice, French Fries, Chicken Nugget, Juice Box, Birthday Cake (custom), Candy Bar.'],
            ['nama_paket' => 'Paket Sweet Seventeen', 'jenis' => 'Box', 'kategori' => 'Ulang Tahun', 'jumlah_pax' => 30, 'harga_paket' => 95000, 'deskripsi' => 'Paket elegan untuk ulang tahun remaja dengan menu kekinian dan aesthetic: Pasta/Spaghetti, Chicken Steak, Caesar Salad, Loaded Fries, Bubble Tea/Smoothie, Mini Cupcakes (6 pcs), Custom Cake.'],
            ['nama_paket' => 'Paket Ulang Tahun Dewasa', 'jenis' => 'Prasmanan', 'kategori' => 'Ulang Tahun', 'jumlah_pax' => 50, 'harga_paket' => 65000, 'deskripsi' => 'Paket santai dan nikmat untuk perayaan ulang tahun orang dewasa: Nasi Goreng Spesial, Sate Ayam/Kambing, Tongseng/Sup Kambing, Gado-gado, Es Campur/Es Teler, Slice Cake.'],
            ['nama_paket' => 'Paket Snack Box Siswa', 'jenis' => 'Box', 'kategori' => 'Studi Tour', 'jumlah_pax' => 30, 'harga_paket' => 18000, 'deskripsi' => 'Snack box praktis dan bergizi untuk anak-anak selama perjalanan study tour: Roti Bakar/Sandwich, Juice Box, Cookies/Biskuit, Buah Potong, Air Mineral.'],
            ['nama_paket' => 'Paket Lunch Box Siswa', 'jenis' => 'Box', 'kategori' => 'Studi Tour', 'jumlah_pax' => 50, 'harga_paket' => 28000, 'deskripsi' => 'Nasi box lengkap dan bergizi untuk makan siang selama study tour: Nasi Putih, Ayam Goreng/Bakar, Telur Dadar/Ceplok, Acar Timun, Pisang/Buah, Juice, Air Mineral.'],
            ['nama_paket' => 'Paket Bento Box Premium', 'jenis' => 'Box', 'kategori' => 'Studi Tour', 'jumlah_pax' => 30, 'harga_paket' => 38000, 'deskripsi' => 'Bento box premium dengan menu sehat dan menarik untuk siswa: Nasi Onigiri, Chicken Katsu, Vegetable Roll, Tamagoyaki, Fruit Cup, Yakult/Juice.'],
            ['nama_paket' => 'Paket Coffee Break', 'jenis' => 'Box', 'kategori' => 'Rapat', 'jumlah_pax' => 20, 'harga_paket' => 45000, 'deskripsi' => 'Paket coffee break lengkap untuk menemani sesi meeting dan diskusi: Kopi/Teh/Susu, Croissant/Danish, Mini Cake (2 pcs), Cookies/Biskuit, Fruit Platter, Air Mineral.'],
            ['nama_paket' => 'Paket Seminar Box', 'jenis' => 'Box', 'kategori' => 'Rapat', 'jumlah_pax' => 50, 'harga_paket' => 55000, 'deskripsi' => 'Nasi box profesional untuk seminar, workshop, dan training karyawan: Nasi Putih/Nasi Goreng, Ayam/Beef Steak, Salad/Vegetable, Buah Segar, Juice/Teh, Air Mineral.'],
            ['nama_paket' => 'Paket Full Day Meeting', 'jenis' => 'Box', 'kategori' => 'Rapat', 'jumlah_pax' => 30, 'harga_paket' => 120000, 'deskripsi' => 'Paket lengkap pagi-siang-sore untuk meeting seharian penuh: Morning (Kopi + Pastry), Lunch (Nasi Box Premium), Afternoon (Coffee Break 2), Fruit & Snack, Air Mineral (3 botol).'],
        ];

        foreach ($pakets as $paket) {
            Paket::create($paket);
        }
    }
}
