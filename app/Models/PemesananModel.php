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
        'status_pembayaran', // Tambahkan field ini
        'status_selesai_at',
    ];

    protected $useTimestamps = true;

    // Join dengan tabel paket layanan
    public function withPaket()
    {
        return $this->select('pemesanan.*, pemesanan.status_pembayaran, paket_layanan.nama AS nama_paket') // Tambahkan status_pembayaran
                    ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id');
    }

    public function getWithPaket($id)
    {
        return $this->select('pemesanan.*, paket_layanan.nama AS nama_paket, paket_layanan.jenis_layanan')
                   ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
                   ->where('pemesanan.id', $id)
                   ->first();
    }

    // Join dengan tabel users
    public function withUser()
    {
        return $this->select('pemesanan.*, pemesanan.status_pembayaran, users.username AS nama_user') // Tambahkan status_pembayaran
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

    // Untuk Payment
    public function getWithPayments($id)
    {
        $pemesanan = $this->select('pemesanan.*, pemesanan.status_pembayaran') // Tambahkan status_pembayaran
                          ->find($id);
        if (!$pemesanan) {
            return null;
        }

        $pembayaranModel = new PembayaranModel();
        $pemesanan['pembayaran'] = $pembayaranModel->getByPemesanan($id);

        return $pemesanan;
    }

    public function getTotalPaid($pemesananId)
    {
        $pembayaranModel = new PembayaranModel();
        $pembayaran = $pembayaranModel->where('pemesanan_id', $pemesananId)
                                     ->where('status', 'success') // Perbaiki kapitalisasi
                                     ->findAll();

        $total = 0;
        foreach ($pembayaran as $bayar) {
            $total += $bayar['jumlah'];
        }

        return $total;
    }
}
