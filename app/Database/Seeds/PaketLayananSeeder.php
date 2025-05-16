<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaketLayananSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Kosongkan tabel
        $this->db->table('paket_layanan')->truncate();

        // Data seeder
        $data = [
            [
                'nama' => 'Paket Basic',
                'foto' => 'uploads/paket_layanan/basic.jpg',
                'benefit' => 'Photoshoot 1 jam, 10 foto edited, 1 lokasi',
                'harga' => 500000,
                'jenis_layanan' => 'Pre-Wedding',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Paket Premium',
                'foto' => 'uploads/paket_layanan/premium.jpg',
                'benefit' => 'Photoshoot 2 jam, 20 foto edited, 2 lokasi, Cetak 5 foto',
                'harga' => 1000000,
                'jenis_layanan' => 'Wedding',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Paket Exclusive',
                'foto' => 'uploads/paket_layanan/exclusive.jpg',
                'benefit' => 'Photoshoot 3 jam, 30 foto edited, 3 lokasi, Cetak 10 foto, Video dokumentasi',
                'harga' => 1500000,
                'jenis_layanan' => 'Engagement',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Masukkan data
        $this->db->table('paket_layanan')->insertBatch($data);

        // Aktifkan kembali foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
}
