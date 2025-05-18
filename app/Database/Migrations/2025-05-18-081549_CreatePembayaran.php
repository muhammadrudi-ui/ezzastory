<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembayaran extends Migration
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
            'pemesanan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'jenis' => [
                'type' => 'ENUM',
                'constraint' => ['DP', 'Pelunasan'],
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'success', 'failed'],
                'default' => 'pending',
            ],
            'metode_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'bukti_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'order_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'tanggal_bayar' => [
                'type' => 'DATETIME',
                'null' => true,
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
        $this->forge->addForeignKey('pemesanan_id', 'pemesanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran'); // Misalnya, menghapus tabel 'pembayaran'
    }
}
