<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfilePerusahaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nama_perusahaan' => ['type' => 'VARCHAR', 'constraint' => 255],
            'logo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'slider_1' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'slider_2' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'slider_3' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'keunggulan_1' => ['type' => 'TEXT', 'null' => true],
            'keunggulan_2' => ['type' => 'TEXT', 'null' => true],
            'keunggulan_3' => ['type' => 'TEXT', 'null' => true],
            'background_judul' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'visi' => ['type' => 'TEXT', 'null' => true],
            'misi' => ['type' => 'TEXT', 'null' => true],
            'nama_owner' => ['type' => 'VARCHAR', 'constraint' => 255],
            'foto_owner' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'cta' => ['type' => 'TEXT', 'null' => true],
            'no_telp' => ['type' => 'VARCHAR', 'constraint' => 20],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255],
            'instagram' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'alamat' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('profile_perusahaan');
    }

    public function down()
    {
        $this->forge->dropTable('profile_perusahaan');
    }
}
