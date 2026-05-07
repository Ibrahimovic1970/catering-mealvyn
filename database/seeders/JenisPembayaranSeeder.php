<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPembayaran;
use App\Models\DetailJenisPembayaran;

class JenisPembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $pembayarans = [
            [
                'metode_pembayaran' => 'Transfer Bank BCA',
                'details' => [
                    ['no_rek' => '1234567890', 'tempat_bayar' => 'Bank Central Asia', 'logo' => 'bca.png'],
                ]
            ],
            [
                'metode_pembayaran' => 'Transfer Bank Mandiri',
                'details' => [
                    ['no_rek' => '9876543210', 'tempat_bayar' => 'Bank Mandiri', 'logo' => 'mandiri.png'],
                ]
            ],
            [
                'metode_pembayaran' => 'Transfer Bank BNI',
                'details' => [
                    ['no_rek' => '5555666677', 'tempat_bayar' => 'Bank BNI', 'logo' => 'bni.png'],
                ]
            ],
            [
                'metode_pembayaran' => 'E-Wallet (GoPay/OVO/Dana)',
                'details' => [
                    ['no_rek' => '081234567890', 'tempat_bayar' => 'GoPay', 'logo' => 'gopay.png'],
                    ['no_rek' => '081234567890', 'tempat_bayar' => 'OVO', 'logo' => 'ovo.png'],
                    ['no_rek' => '081234567890', 'tempat_bayar' => 'Dana', 'logo' => 'dana.png'],
                ]
            ],
        ];

        foreach ($pembayarans as $pembayaran) {
            $jp = JenisPembayaran::create([
                'metode_pembayaran' => $pembayaran['metode_pembayaran']
            ]);

            foreach ($pembayaran['details'] as $detail) {
                DetailJenisPembayaran::create([
                    'id_jenis_pembayaran' => $jp->id,
                    'no_rek' => $detail['no_rek'],
                    'tempat_bayar' => $detail['tempat_bayar'],
                    'logo' => $detail['logo']
                ]);
            }
        }
    }
}
