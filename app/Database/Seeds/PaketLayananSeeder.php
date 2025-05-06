<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaketLayananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Paket Basic',
                'foto' => 'uploads/paket_layanan/basic.jpg',
                'benefit' => 'Photoshoot 1 jam, 10 foto edited, 1 lokasi',
                'harga' => 500000,
            ],
            [
                'nama' => 'Paket Premium',
                'foto' => 'uploads/paket_layanan/premium.jpg',
                'benefit' => 'Photoshoot 2 jam, 20 foto edited, 2 lokasi, Cetak 5 foto',
                'harga' => 1000000,
            ],
            [
                'nama' => 'Paket Exclusive',
                'foto' => 'uploads/paket_layanan/exclusive.jpg',
                'benefit' => 'Photoshoot 3 jam, 30 foto edited, 3 lokasi, Cetak 10 foto, Video dokumentasi',
                'harga' => 1500000,
            ],
        ];

        // Kosongkan tabel dan reset auto-increment
    $this->db->table('paket_layanan')->truncate();

        // Insert data ke table paket_layanan
        $this->db->table('paket_layanan')->insertBatch($data);
    }
}
