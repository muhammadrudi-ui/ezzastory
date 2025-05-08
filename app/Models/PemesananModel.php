<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'paket_id',
        'waktu_pemesanan',
        'waktu_pemotretan',
        'jenis_pembayaran',
        'lokasi_pemotretan',
        'link_maps_pemotretan',
        'link_maps_pengiriman',
        'nama_mempelai',
        'status',
        'status_selesai_at',
    ];

    protected $useTimestamps = true;

    // Join dengan tabel paket layanan
    public function withPaket()
    {
        return $this->select('pemesanan.*, paket_layanan.nama AS nama_paket')
                    ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id');
    }

    // Join dengan tabel users
    public function withUser()
    {
        return $this->select('pemesanan.*, users.username AS nama_user')
                    ->join('users', 'users.id = pemesanan.user_id');
    }

    // Ambil data yang belum selesai
    public function aktif()
    {
        return $this->where('status !=', 'Selesai');
    }

    // Ambil data yang sudah selesai (riwayat)
    public function riwayat()
    {
        return $this->where('status', 'Selesai');
    }
}
