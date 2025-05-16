<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PembayaranModel;
use App\Models\PemesananModel;

class PembayaranController extends BaseController
{
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->pemesananModel = new PemesananModel();
    }

    public function bayar($id)
    {
        $pembayaran = $this->pembayaranModel->find($id);
        if (!$pembayaran) {
            return redirect()->to('user/reservasi?tab=pembayaran')->with('error', 'Data pembayaran tidak ditemukan');
        }

        // Update status pembayaran
        $this->pembayaranModel->update($id, [
            'status' => 'success',
            'tanggal_bayar' => date('Y-m-d H:i:s')
        ]);

        $pemesanan = $this->pemesananModel->find($pembayaran['pemesanan_id']);

        $updateData = [];
        if ($pembayaran['jenis'] === 'DP') {
            $updateData = [
                'status_pembayaran' => 'DP'
            ];
        } elseif ($pembayaran['jenis'] === 'Pelunasan') {
            $updateData = [
                'status_pembayaran' => 'Lunas'
            ];
        }

        $this->pemesananModel->update($pembayaran['pemesanan_id'], $updateData);

        return redirect()->to('user/reservasi?tab=pembayaran')->with('success', 'Pembayaran berhasil dicatat dan status pemesanan diperbarui');
    }
}
