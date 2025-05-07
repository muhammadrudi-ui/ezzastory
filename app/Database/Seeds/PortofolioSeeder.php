<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PortofolioSeeder extends Seeder
{
    public function run()
    {
        $this->db->disableForeignKeyChecks();
        $this->db->table('foto_portofolio')->truncate();
        $this->db->table('portofolio')->truncate();
        $this->db->enableForeignKeyChecks();

        $portofolios = [
            [
                'nama_mempelai' => 'Ayu & Budi',
                'foto_utama' => 'uploads/portofolio/utama1.jpg',
                'jenis_layanan' => 'Wedding',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_mempelai' => 'Dina & Rian',
                'foto_utama' => 'uploads/portofolio/utama2.jpg',
                'jenis_layanan' => 'Pre-Wedding',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($portofolios as $portofolio) {
            $this->db->table('portofolio')->insert($portofolio);
            $portofolioId = $this->db->insertID();

            $fotoList = [
                ['id_portofolio' => $portofolioId, 'nama_file' => 'uploads/portofolio/foto1.jpg'],
                ['id_portofolio' => $portofolioId, 'nama_file' => 'uploads/portofolio/foto2.jpg'],
            ];

            foreach ($fotoList as &$foto) {
                $foto['created_at'] = date('Y-m-d H:i:s');
            }

            $this->db->table('foto_portofolio')->insertBatch($fotoList);
        }
    }
}
