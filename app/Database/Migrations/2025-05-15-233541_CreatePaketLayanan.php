<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaketLayanan extends Migration
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
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'benefit' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'jenis_layanan' => [
                'type' => 'ENUM',
                'constraint' => ['Wedding', 'Engagement', 'Pre-Wedding', 'Wisuda', 'Event Lainnya'],
                'null' => false,
                'default' => 'Event Lainnya',
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('paket_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('paket_layanan');
    }
}
