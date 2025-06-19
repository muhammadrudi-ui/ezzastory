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
        $filter_tanggal_awal = $this->request->getGet('filter_tanggal_awal');
        $filter_tanggal_akhir = $this->request->getGet('filter_tanggal_akhir');
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
                paket_layanan.nama AS nama_paket,
                paket_layanan.harga,
                paket_layanan.jenis_layanan,
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
                ->orLike('paket_layanan.jenis_layanan', $search)
                ->orLike('pemesanan.jenis_pembayaran', $search)
                ->groupEnd();
        }

        // Terapkan filter periode tanggal
        if ($filter_tanggal_awal && $filter_tanggal_akhir) {
            $query->where('DATE(pemesanan.waktu_pemesanan) >=', $filter_tanggal_awal)
                  ->where('DATE(pemesanan.waktu_pemesanan) <=', $filter_tanggal_akhir);
        } elseif ($filter_tanggal_awal) {
            $query->where('DATE(pemesanan.waktu_pemesanan) >=', $filter_tanggal_awal);
        } elseif ($filter_tanggal_akhir) {
            $query->where('DATE(pemesanan.waktu_pemesanan) <=', $filter_tanggal_akhir);
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
                'nama_paket' => $pesan['nama_paket'],
                'jenis_layanan' => $pesan['jenis_layanan'],
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
            'filter_tanggal_awal' => $filter_tanggal_awal,
            'filter_tanggal_akhir' => $filter_tanggal_akhir,
            'filter_status_pembayaran' => $filter_status_pembayaran,
            'periode_display' => $this->getPeriodeDisplay($filter_tanggal_awal, $filter_tanggal_akhir),
            'page_title' => 'Laporan Keuangan',
        ];

        return view('admin/laporan-keuangan/index', $data);
    }

    public function cetak()
    {
        $search = $this->request->getGet('search');
        $filter_tanggal_awal = $this->request->getGet('filter_tanggal_awal');
        $filter_tanggal_akhir = $this->request->getGet('filter_tanggal_akhir');
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
                paket_layanan.nama AS nama_paket,
                paket_layanan.harga,
                paket_layanan.jenis_layanan,
                pemesanan.jenis_pembayaran,
                pemesanan.status_pembayaran
            ')
            ->join('user_profile', 'user_profile.user_id = pemesanan.user_id', 'left')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->orderBy('paket_layanan.jenis_layanan', 'ASC')
            ->orderBy('pemesanan.waktu_pemesanan', 'DESC');

        // Terapkan filter pencarian
        if ($search) {
            $query->groupStart()
                ->like('user_profile.nama_lengkap', $search)
                ->orLike('paket_layanan.nama', $search)
                ->orLike('paket_layanan.jenis_layanan', $search)
                ->orLike('pemesanan.jenis_pembayaran', $search)
                ->groupEnd();
        }

        // Terapkan filter periode tanggal
        if ($filter_tanggal_awal && $filter_tanggal_akhir) {
            $query->where('DATE(pemesanan.waktu_pemesanan) >=', $filter_tanggal_awal)
                  ->where('DATE(pemesanan.waktu_pemesanan) <=', $filter_tanggal_akhir);
        } elseif ($filter_tanggal_awal) {
            $query->where('DATE(pemesanan.waktu_pemesanan) >=', $filter_tanggal_awal);
        } elseif ($filter_tanggal_akhir) {
            $query->where('DATE(pemesanan.waktu_pemesanan) <=', $filter_tanggal_akhir);
        }

        // Terapkan filter status pembayaran
        if ($filter_status_pembayaran) {
            $query->where('pemesanan.status_pembayaran', $filter_status_pembayaran);
        }

        // Ambil data pemesanan
        $pemesanan = $query->findAll();

        // Hitung jumlah pembayaran dan sisa pembayaran, kelompokkan per jenis layanan
        $jenisLayanan = ['Wedding', 'Engagement', 'Pre-Wedding', 'Wisuda', 'Event Lainnya'];
        $dataPemesananPerJenis = [];
        $totalPemasukanPerJenis = [];
        $totalPemasukanKeseluruhan = 0;

        // Inisialisasi array untuk setiap jenis layanan
        foreach ($jenisLayanan as $jenis) {
            $dataPemesananPerJenis[$jenis] = [];
            $totalPemasukanPerJenis[$jenis] = 0;
        }

        foreach ($pemesanan as $pesan) {
            $totalPaid = $this->pemesananModel->getTotalPaid($pesan['id']);
            $sisaPembayaran = $pesan['harga'] - $totalPaid;
            $jenis = $pesan['jenis_layanan'];

            // Jika jenis layanan tidak ada dalam array, masukkan ke "Event Lainnya"
            if (!in_array($jenis, $jenisLayanan)) {
                $jenis = 'Event Lainnya';
            }

            $totalPemasukanPerJenis[$jenis] += $totalPaid;
            $totalPemasukanKeseluruhan += $totalPaid;

            $dataPemesananPerJenis[$jenis][] = [
                'waktu_pemesanan' => $pesan['waktu_pemesanan'],
                'nama_lengkap' => $pesan['nama_lengkap'],
                'nama_paket' => $pesan['nama_paket'],
                'jenis_layanan' => $pesan['jenis_layanan'],
                'harga' => $pesan['harga'],
                'jenis_pembayaran' => $pesan['jenis_pembayaran'],
                'jumlah_pembayaran' => $totalPaid,
                'sisa_pembayaran' => $sisaPembayaran,
            ];
        }

        // Load DomPDF
        $dompdf = new \Dompdf\Dompdf();
        $data = [
            'data_pemesanan_per_jenis' => $dataPemesananPerJenis,
            'total_pemasukan_per_jenis' => $totalPemasukanPerJenis,
            'total_pemasukan_keseluruhan' => $totalPemasukanKeseluruhan,
            'jenis_layanan' => $jenisLayanan,
            'periode_display' => $this->getPeriodeDisplay($filter_tanggal_awal, $filter_tanggal_akhir),
            'tanggal_cetak' => date('d F Y'),
        ];

        // Render view ke HTML
        $html = view('admin/laporan-keuangan/cetak', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan_keuangan_' . date('Y-m-d') . '.pdf', ['Attachment' => true]);
    }

    private function getPeriodeDisplay($tanggal_awal, $tanggal_akhir)
    {
        if ($tanggal_awal && $tanggal_akhir) {
            return 'Periode: ' . date('d F Y', strtotime($tanggal_awal)) . ' - ' . date('d F Y', strtotime($tanggal_akhir));
        } elseif ($tanggal_awal) {
            return 'Periode: Mulai ' . date('d F Y', strtotime($tanggal_awal));
        } elseif ($tanggal_akhir) {
            return 'Periode: Sampai ' . date('d F Y', strtotime($tanggal_akhir));
        }
        return 'Periode: Semua Data';
    }
}
