<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PembayaranModel;

class PembayaranController extends BaseController
{
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
    }

    public function bayar($id)
    {
        // Ambil data pembayaran
        $pembayaran = $this->pembayaranModel->find($id);
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan');
        }

        // Update status pembayaran
        $this->pembayaranModel->update($id, [
            'status' => 'success',
            'tanggal_bayar' => date('Y-m-d H:i:s')
        ]);

        // Update status pemesanan ke "pemesanan"
        $pemesananModel = new \App\Models\PemesananModel();
        $pemesananModel->update($pembayaran['pemesanan_id'], [
            'status' => 'pemesanan'
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil dicatat dan status pemesanan diperbarui');
    }


}
