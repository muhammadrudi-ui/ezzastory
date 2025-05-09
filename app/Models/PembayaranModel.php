<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pemesanan_id',
        'jumlah',
        'jenis',
        'status',
        'metode_pembayaran',
        'bukti_bayar',
        'tanggal_bayar'
    ];

    protected $useTimestamps = true;
}
