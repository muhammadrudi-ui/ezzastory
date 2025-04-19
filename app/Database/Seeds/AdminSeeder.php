<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email' => 'admin@ezzastory.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin',
        ];

        // Insert ke tabel users
        $this->db->table('users')->insert($data);
    }
}
