<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemesanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
                'unsigned'   => true,
            ],
            'paket_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
                'unsigned'   => true,
            ],
            'waktu_pemesanan' => [
                'type' => 'DATETIME',
            ],
            'waktu_pemotretan' => [
                'type' => 'DATETIME',
            ],
            'jenis_pembayaran' => [
                'type'       => 'ENUM',
                'constraint' => ['Lunas', 'DP'],
            ],
            'status_pembayaran' => [
                'type'       => 'ENUM',
                'constraint' => ['Belum Bayar', 'DP', 'Lunas'],
                'default'    => 'Belum Bayar',
                'after'      => 'status',
            ],
            'lokasi_pemotretan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'link_maps_pemotretan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'link_maps_pengiriman' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_mempelai' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'link_hasil_foto' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_portfolio_approved' => [
                'type'       => 'ENUM',
                'constraint' => ['Bersedia', 'Tidak Bersedia'],
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Pemesanan', 'Pemotretan', 'Editing', 'Pencetakan', 'Pengiriman', 'Selesai'],
                'default'    => 'Pemesanan',
            ],
            'status_selesai_at' => [
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('paket_id', 'paket_layanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pemesanan');
    }
}
