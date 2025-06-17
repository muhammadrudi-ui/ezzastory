<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PembayaranModel;
use App\Models\PemesananModel;
use App\Models\UserModel;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class PembayaranController extends BaseController
{
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->pemesananModel = new PemesananModel();
        $this->userModel = new UserModel();

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

            $pemesanan = $this->pemesananModel->withPaket()
                ->where('pemesanan.id', $pembayaran['pemesanan_id'])
                ->first();

            if (!$pemesanan) {
                throw new \Exception('Data pemesanan tidak ditemukan');
            }

            $user = $this->userModel->getUserWithProfile(session()->get('user_id'));

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
                    'finish' => base_url('user/pembayaran/finish?order_id=' . $orderId)
                ]
            ];

            $snapResponse = \Midtrans\Snap::getSnapUrl($params);

            // Simpan order_id ke database
            $this->pembayaranModel->update($id, [
                'order_id' => $orderId,
                'metode_pembayaran' => 'Midtrans'
            ]);

            echo json_encode([
                'status' => 'success',
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
            // CEK STATUS LANGSUNG KE MIDTRANS
            $status = \Midtrans\Transaction::status($orderId);

            // Update database berdasarkan response dari Midtrans
            $pembayaran = $this->pembayaranModel->where('order_id', $orderId)->first();

            if (!$pembayaran) {
                return $this->response->setStatusCode(404)->setJSON(['error' => 'Pembayaran tidak ditemukan']);
            }

            // Update status berdasarkan response Midtrans
            $this->updatePaymentStatus($pembayaran, $status);

            return $this->response->setJSON([
                'status' => $status->transaction_status,
                'order_id' => $orderId,
                'payment_type' => $status->payment_type ?? null
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    private function updatePaymentStatus($pembayaran, $status)
    {
        $transactionStatus = $status->transaction_status;
        $fraudStatus = $status->fraud_status ?? 'accept';

        if ($transactionStatus == 'capture' && $fraudStatus == 'accept') {
            // Kartu kredit/debit berhasil
            $this->pembayaranModel->update($pembayaran['id'], [
                'status' => 'success',
                'tanggal_bayar' => date('Y-m-d H:i:s'),
                'metode_pembayaran' => $status->payment_type,
            ]);

            $this->updatePemesananStatus($pembayaran);

        } elseif ($transactionStatus == 'settlement') {
            // Transfer bank, e-wallet, dll berhasil
            $this->pembayaranModel->update($pembayaran['id'], [
                'status' => 'success',
                'tanggal_bayar' => date('Y-m-d H:i:s'),
                'metode_pembayaran' => $status->payment_type,
            ]);

            $this->updatePemesananStatus($pembayaran);

        } elseif ($transactionStatus == 'pending') {
            // Menunggu pembayaran
            $this->pembayaranModel->update($pembayaran['id'], [
                'status' => 'pending',
                'metode_pembayaran' => $status->payment_type,
            ]);

        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            // Pembayaran gagal
            $this->pembayaranModel->update($pembayaran['id'], [
                'status' => 'failed',
                'metode_pembayaran' => $status->payment_type,
            ]);
        }
    }

    private function updatePemesananStatus($pembayaran)
    {
        $updateData = [];
        if ($pembayaran['jenis'] === 'DP') {
            $updateData = ['status_pembayaran' => 'DP'];
        } elseif ($pembayaran['jenis'] === 'Pelunasan') {
            $updateData = ['status_pembayaran' => 'Lunas'];
        }

        if (!empty($updateData)) {
            $this->pemesananModel->update($pembayaran['pemesanan_id'], $updateData);
        }
    }

    public function finish()
    {
        $order_id = $this->request->getGet('order_id');

        if (!$order_id) {
            return redirect()->to('user/reservasi?tab=pembayaran')->with('error', 'ID pemesanan tidak valid');
        }

        try {
            // CEK STATUS LANGSUNG KE MIDTRANS
            $status = \Midtrans\Transaction::status($order_id);

            // Update database
            $pembayaran = $this->pembayaranModel->where('order_id', $order_id)->first();
            if ($pembayaran) {
                $this->updatePaymentStatus($pembayaran, $status);
            }

            // Redirect dengan pesan sesuai status
            $message = 'Status pembayaran: ' . $status->transaction_status;
            $alertType = 'info';

            if (in_array($status->transaction_status, ['capture', 'settlement'])) {
                $message = 'Pembayaran berhasil!';
                $alertType = 'success';
            } elseif ($status->transaction_status == 'pending') {
                $message = 'Pembayaran sedang diproses, silakan tunggu konfirmasi.';
                $alertType = 'warning';
            } elseif (in_array($status->transaction_status, ['deny', 'cancel', 'expire'])) {
                $message = 'Pembayaran gagal atau dibatalkan.';
                $alertType = 'danger';
            }

            return redirect()->to('user/reservasi?tab=pembayaran')->with($alertType, $message);

        } catch (\Exception $e) {
            log_message('error', 'Error checking payment status: ' . $e->getMessage());
            return redirect()->to('user/reservasi?tab=pembayaran')->with('error', 'Terjadi kesalahan saat memverifikasi pembayaran');
        }
    }
}
