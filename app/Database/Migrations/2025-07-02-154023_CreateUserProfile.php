<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProfile extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'no_telepon' => [
                'type' => 'VARCHAR',
                'constraint' => '13',
                'null' => true,
            ],
            'instagram' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_profile');
    }

    public function down()
    {
        $this->forge->dropTable('user_profile');
    }
}
