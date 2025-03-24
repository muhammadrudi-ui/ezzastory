<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProfilePerusahaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_perusahaan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'slider_1' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slider_2' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slider_3' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'keunggulan_1' => [
                'type' => 'TEXT',
            ],
            'keunggulan_2' => [
                'type' => 'TEXT',
            ],
            'keunggulan_3' => [
                'type' => 'TEXT',
            ],
            'background_judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'visi' => [
                'type' => 'TEXT',
            ],
            'misi' => [
                'type' => 'TEXT',
            ],
            'nama_owner' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'foto_owner' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'cta' => [
                'type' => 'TEXT',
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'instagram' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('profile_perusahaan');
    }

    public function down()
    {
        $this->forge->dropTable('profile_perusahaan');
    }
}
