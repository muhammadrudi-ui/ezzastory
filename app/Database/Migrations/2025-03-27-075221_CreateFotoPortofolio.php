<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFotoPortofolio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'id_portofolio' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'nama_file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->addForeignKey('id_portofolio', 'portofolio', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('foto_portofolio');
    }

    public function down()
    {
        $this->forge->dropTable('foto_portofolio');
    }
}
