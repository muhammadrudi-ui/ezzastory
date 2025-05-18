<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PembayaranModel;
use App\Models\PemesananModel;
use App\Models\UserModel;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PembayaranController extends BaseController
{
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->pemesananModel = new PemesananModel();
        $this->userModel = new UserModel();

        // Log environment variables
        log_message('debug', 'Midtrans Server Key: ' . (env('MIDTRANS_SERVER_KEY') ? 'Set' : 'Not Set'));
        log_message('debug', 'CI Environment: ' . env('CI_ENVIRONMENT'));

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = (env('CI_ENVIRONMENT') === 'production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function bayar($id)
    {
        header('Content-Type: application/json');

        try {
            $pembayaran = $this->pembayaranModel->find($id);
            if (!$pembayaran) {
                throw new \Exception('Data pembayaran tidak ditemukan');
            }

            // Gunakan withPaket() untuk mendapatkan nama_paket
            $pemesanan = $this->pemesananModel->withPaket()
                            ->where('pemesanan.id', $pembayaran['pemesanan_id'])
                            ->first();

            if (!$pemesanan) {
                throw new \Exception('Data pemesanan tidak ditemukan');
            }

            $user = $this->userModel->getUserWithProfile(session()->get('user_id'));

            // Generate unique order ID
            $orderId = 'ORD-' . time() . '-' . $pembayaran['id'];

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $pembayaran['jumlah']
                ],
                'customer_details' => [
                    'first_name' => $user['nama_lengkap'] ?? 'Customer',
                    'email' => $user['email'] ?? 'customer@example.com',
                    'phone' => $user['no_telepon'] ?? ''
                ],
                'item_details' => [
                    [
                        'id' => $pembayaran['id'],
                        'price' => $pembayaran['jumlah'],
                        'quantity' => 1,
                        'name' => ($pemesanan['nama_paket'] ?? 'Paket Layanan') . ' - ' . $pembayaran['jenis']
                    ]
                ],
                'callbacks' => [
                    'finish' => base_url('user/pembayaran/finish')
                ]
            ];

            // Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);
            $snapResponse = Snap::getSnapUrl($params);

            // Simpan order_id ke database
            $this->pembayaranModel->update($id, [
                'order_id' => $orderId,
                'metode_pembayaran' => 'Midtrans'
            ]);

            echo json_encode([
                'status' => 'success',
                'snapToken' => $snapToken,
                'redirect_url' => $snapResponse,
                'order_id' => $orderId
            ]);
            exit;

        } catch (\Exception $e) {
            log_message('error', 'Midtrans Error: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
            ]);
            exit;
        }
    }

    public function checkStatus($orderId)
    {
        try {
            // Cari pembayaran berdasarkan order_id
            $pembayaran = $this->pembayaranModel->where('order_id', $orderId)->first();

            if (!$pembayaran) {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Pembayaran tidak ditemukan']);
            }

            return $this->response->setJSON([
                'status' => $pembayaran['status'],
                'order_id' => $orderId
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function notification()
    {
        try {
            $notif = new Notification();

            $status = $notif->transaction_status;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;

            // Cari pembayaran berdasarkan order_id
            $pembayaran = $this->pembayaranModel->where('order_id', $order_id)->first();
            if (!$pembayaran) {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Pembayaran tidak ditemukan']);
            }

            $pemesanan = $this->pemesananModel->find($pembayaran['pemesanan_id']);
            if (!$pemesanan) {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Pemesanan tidak ditemukan']);
            }

            // Verifikasi status pembayaran
            if ($status == 'capture' && $fraud == 'accept') {
                // Kartu kredit/debit berhasil
                $this->pembayaranModel->update($pembayaran['id'], [
                    'status' => 'success',
                    'tanggal_bayar' => date('Y-m-d H:i:s'),
                    'metode_pembayaran' => $notif->payment_type,
                ]);

                $updateData = [];
                if ($pembayaran['jenis'] === 'DP') {
                    $updateData = ['status_pembayaran' => 'DP'];
                } elseif ($pembayaran['jenis'] === 'Pelunasan') {
                    $updateData = ['status_pembayaran' => 'Lunas'];
                }

                $this->pemesananModel->update($pembayaran['pemesanan_id'], $updateData);
            } elseif ($status == 'settlement') {
                // Transfer bank, e-wallet, dll berhasil
                $this->pembayaranModel->update($pembayaran['id'], [
                    'status' => 'success',
                    'tanggal_bayar' => date('Y-m-d H:i:s'),
                    'metode_pembayaran' => $notif->payment_type,
                ]);

                $updateData = [];
                if ($pembayaran['jenis'] === 'DP') {
                    $updateData = ['status_pembayaran' => 'DP'];
                } elseif ($pembayaran['jenis'] === 'Pelunasan') {
                    $updateData = ['status_pembayaran' => 'Lunas'];
                }

                $this->pemesananModel->update($pembayaran['pemesanan_id'], $updateData);
            } elseif ($status == 'pending') {
                // Menunggu pembayaran (misalnya transfer bank manual)
                $this->pembayaranModel->update($pembayaran['id'], [
                    'status' => 'pending',
                    'metode_pembayaran' => $notif->payment_type,
                ]);
            } elseif (in_array($status, ['deny', 'cancel', 'expire'])) {
                // Pembayaran gagal atau kadaluarsa
                $this->pembayaranModel->update($pembayaran['id'], [
                    'status' => 'failed',
                    'metode_pembayaran' => $notif->payment_type,
                ]);
            }

            return $this->response->setJSON(['status' => 'success']);
        } catch (\Exception $e) {
            log_message('error', 'Midtrans Notification Error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function finish()
    {
        $order_id = $this->request->getGet('order_id');
        $status = $this->request->getGet('status');

        if (!$order_id) {
            return redirect()->to('user/reservasi?tab=pembayaran')->with('error', 'ID pemesanan tidak valid');
        }

        // Cek status pembayaran di database
        $pembayaran = $this->pembayaranModel->where('order_id', $order_id)->first();

        if (!$pembayaran) {
            return redirect()->to('user/reservasi?tab=pembayaran')->with('error', 'Data pembayaran tidak ditemukan');
        }

        $message = 'Pembayaran sedang diproses';
        $alertType = 'info';

        if ($status === 'success') {
            $message = 'Pembayaran berhasil diproses';
            $alertType = 'success';
        } elseif ($status === 'error') {
            $message = 'Pembayaran gagal diproses';
            $alertType = 'danger';
        }

        return redirect()->to('user/reservasi?tab=pembayaran')->with($alertType, $message);
    }

}
