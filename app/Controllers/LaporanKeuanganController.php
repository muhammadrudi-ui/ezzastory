<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PemesananModel;
use App\Models\PembayaranModel;
use App\Models\PaketLayananModel;
use App\Models\UserModel;

class LaporanKeuanganController extends BaseController
{
    protected $pemesananModel;
    protected $pembayaranModel;
    protected $paketLayananModel;
    protected $userModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->paketLayananModel = new PaketLayananModel();
        $this->userModel = new UserModel();

        // Cek apakah user adalah admin
        if (session()->get('role') !== 'admin') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak');
        }
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $filter_bulan = $this->request->getGet('filter_bulan');
        $filter_status_pembayaran = $this->request->getGet('filter_status_pembayaran');

        // Validasi filter_status_pembayaran
        if ($filter_status_pembayaran && !in_array($filter_status_pembayaran, ['Belum Bayar', 'DP', 'Lunas'])) {
            $filter_status_pembayaran = null;
        }

        // Query untuk mengambil data laporan keuangan
        $query = $this->pemesananModel
            ->select('
                pemesanan.id,
                pemesanan.waktu_pemesanan,
                user_profile.nama_lengkap,
                user_profile.no_telepon,
                paket_layanan.nama AS nama_paket,
                paket_layanan.harga,
                pemesanan.jenis_pembayaran,
                pemesanan.status_pembayaran
            ')
            ->join('user_profile', 'user_profile.user_id = pemesanan.user_id', 'left')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->orderBy('pemesanan.waktu_pemesanan', 'DESC');

        // Terapkan filter pencarian
        if ($search) {
            $query->groupStart()
                ->like('user_profile.nama_lengkap', $search)
                ->orLike('paket_layanan.nama', $search)
                ->orLike('pemesanan.jenis_pembayaran', $search)
                ->groupEnd();
        }

        // Terapkan filter bulan
        if ($filter_bulan) {
            $query->where("DATE_FORMAT(pemesanan.waktu_pemesanan, '%Y-%m') =", $filter_bulan);
        }

        // Terapkan filter status pembayaran
        if ($filter_status_pembayaran) {
            $query->where('pemesanan.status_pembayaran', $filter_status_pembayaran);
        }

        // Ambil data pemesanan
        $pemesanan = $query->findAll();

        // Hitung jumlah pembayaran dan sisa pembayaran
        $dataPemesanan = [];
        $totalPemasukan = 0;

        foreach ($pemesanan as $pesan) {
            $totalPaid = $this->pemesananModel->getTotalPaid($pesan['id']);
            $sisaPembayaran = $pesan['harga'] - $totalPaid;
            $totalPemasukan += $totalPaid;

            $dataPemesanan[] = [
                'waktu_pemesanan' => $pesan['waktu_pemesanan'],
                'nama_lengkap' => $pesan['nama_lengkap'],
                'no_telepon' => $pesan['no_telepon'],
                'nama_paket' => $pesan['nama_paket'],
                'harga' => $pesan['harga'],
                'jenis_pembayaran' => $pesan['jenis_pembayaran'],
                'jumlah_pembayaran' => $totalPaid,
                'sisa_pembayaran' => $sisaPembayaran,
            ];
        }

        // Data untuk view
        $data = [
            'pemesanan' => $dataPemesanan,
            'total_pemasukan' => $totalPemasukan,
            'search' => $search,
            'filter_bulan' => $filter_bulan,
            'filter_status_pembayaran' => $filter_status_pembayaran,
            'page_title' => 'Laporan Keuangan',
        ];

        return view('admin/laporan-keuangan/index', $data);
    }

    public function cetak()
    {
        $search = $this->request->getGet('search');
        $filter_bulan = $this->request->getGet('filter_bulan');
        $filter_status_pembayaran = $this->request->getGet('filter_status_pembayaran');

        // Validasi filter_status_pembayaran
        if ($filter_status_pembayaran && !in_array($filter_status_pembayaran, ['Belum Bayar', 'DP', 'Lunas'])) {
            $filter_status_pembayaran = null;
        }

        // Query untuk mengambil data laporan keuangan
        $query = $this->pemesananModel
            ->select('
                pemesanan.id,
                pemesanan.waktu_pemesanan,
                user_profile.nama_lengkap,
                user_profile.no_telepon,
                paket_layanan.nama AS nama_paket,
                paket_layanan.harga,
                pemesanan.jenis_pembayaran,
                pemesanan.status_pembayaran
            ')
            ->join('user_profile', 'user_profile.user_id = pemesanan.user_id', 'left')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->orderBy('pemesanan.waktu_pemesanan', 'DESC');

        // Terapkan filter pencarian
        if ($search) {
            $query->groupStart()
                ->like('user_profile.nama_lengkap', $search)
                ->orLike('paket_layanan.nama', $search)
                ->orLike('pemesanan.jenis_pembayaran', $search)
                ->groupEnd();
        }

        // Terapkan filter bulan
        if ($filter_bulan) {
            $query->where("DATE_FORMAT(pemesanan.waktu_pemesanan, '%Y-%m') =", $filter_bulan);
        }

        // Terapkan filter status pembayaran
        if ($filter_status_pembayaran) {
            $query->where('pemesanan.status_pembayaran', $filter_status_pembayaran);
        }

        // Ambil data pemesanan
        $pemesanan = $query->findAll();

        // Hitung jumlah pembayaran dan sisa pembayaran
        $totalPemasukan = 0;
        $dataPemesanan = [];
        foreach ($pemesanan as $pesan) {
            $totalPaid = $this->pemesananModel->getTotalPaid($pesan['id']);
            $sisaPembayaran = $pesan['harga'] - $totalPaid;
            $totalPemasukan += $totalPaid;

            $dataPemesanan[] = [
                'waktu_pemesanan' => $pesan['waktu_pemesanan'],
                'nama_lengkap' => $pesan['nama_lengkap'],
                'no_telepon' => $pesan['no_telepon'],
                'nama_paket' => $pesan['nama_paket'],
                'harga' => $pesan['harga'],
                'jenis_pembayaran' => $pesan['jenis_pembayaran'],
                'jumlah_pembayaran' => $totalPaid,
                'sisa_pembayaran' => $sisaPembayaran,
            ];
        }

        // Load DomPDF
        $dompdf = new \Dompdf\Dompdf();
        $data = [
            'pemesanan' => $dataPemesanan,
            'total_pemasukan' => $totalPemasukan,
            'filter_bulan' => $filter_bulan,
        ];

        // Render view ke HTML
        $html = view('admin/laporan-keuangan/cetak', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan_keuangan.pdf', ['Attachment' => true]);
    }
}
