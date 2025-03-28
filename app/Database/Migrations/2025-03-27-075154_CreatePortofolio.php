<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePortofolio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'nama_mempelai' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'foto_utama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'jenis_layanan' => [
                'type' => 'ENUM',
                'constraint' => ['Wedding', 'Engagement', 'Pre-Wedding', 'Wisuda', 'Event Lainnya'],
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
        $this->forge->createTable('portofolio');
    }

    public function down()
    {
        $this->forge->dropTable('portofolio');
    }
}
