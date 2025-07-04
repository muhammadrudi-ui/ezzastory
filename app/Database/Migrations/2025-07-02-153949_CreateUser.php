<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'unique' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '191',
                'unique' => true
            ],
            'pending_email' => [
                'type' => 'VARCHAR',
                'constraint' => '191',
                'null' => true
            ],
            'email_token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'email_token_expires' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'reset_token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'reset_expires' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'user'],
                'default' => 'user'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
