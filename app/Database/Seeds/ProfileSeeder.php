<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfileSeeder extends Seeder
{
     public function run()
    {
        $data = [
            'nama_perusahaan'   => 'Ezzastory',
            'logo'              => 'uploads/profile_perusahaan/logo.png',
            'deskripsi'         => 'Ezzastory adalah studio fotografi dan videografi profesional yang berdedikasi untuk mengabadikan momen terbaik Anda.',
            'slider_1'          => 'uploads/profile_perusahaan/slider-1.jpg',
            'slider_2'          => 'uploads/profile_perusahaan/slider-2.jpg',
            'slider_3'          => 'uploads/profile_perusahaan/slider-3.jpg',
            'keunggulan_1'      => 'Fotografer profesional dan berpengalaman.',
            'keunggulan_2'      => 'Peralatan modern dan berkualitas tinggi.',
            'keunggulan_3'      => 'Pelayanan ramah dan fleksibel.',
            'background_judul'  => 'uploads/profile_perusahaan/bg-judul.jpg',
            'visi'              => 'Menjadi studio dokumentasi terpercaya di Indonesia.',
            'misi'              => 'Memberikan layanan fotografi terbaik dan meningkatkan kepuasan pelanggan.',
            'nama_owner'        => 'Muhammad Rezza Perdana.',
            'foto_owner'        => 'uploads/profile_perusahaan/foto-owner.jpg',
            'cta'               => 'Jadikan setiap momen tak terlupakan bersama Ezzastory!',
            'no_telp'           => '+62 822-4567-0135',
            'email'             => 'ezzastory@gmail.com',
            'instagram'         => 'ezzastory',
            'alamat'            => 'Badean, Blimbingsari, Banyuwangi',
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ];

        // Kosongkan tabel dan reset auto-increment
    $this->db->table('profile_perusahaan')->truncate();
        $this->db->table('profile_perusahaan')->insert($data);
    }
}
