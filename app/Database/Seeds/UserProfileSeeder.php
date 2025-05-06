<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID user admin
        $user = $this->db->table('users')->where('email', 'adminezzastory@gmail.com')->get()->getRow();

        if (!$user) {
            echo "Admin user tidak ditemukan. Jalankan UserSeeder terlebih dahulu.\n";
            return;
        }

        $data = [
            'user_id' => $user->id,
            'nama_lengkap' => 'Administrator Ezzastory',
            'no_telepon' => '081234567890',
            'instagram' => 'ezzastory',
        ];

        $this->db->table('user_profile')->insert($data);
    }
}
