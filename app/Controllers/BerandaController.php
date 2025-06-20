<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfilePerusahaanModel;
use App\Models\PortofolioModel;
use App\Models\PemesananModel;
use App\Models\PembayaranModel;

class BerandaController extends BaseController
{
    protected $profileModel;
    protected $portofolioModel;
    protected $pemesananModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->profileModel = new ProfilePerusahaanModel();
        $this->portofolioModel = new PortofolioModel();
        $this->pemesananModel = new PemesananModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        // Ambil semua portofolio terbaru beserta 1 foto utama
        $data['portofolio'] = $this->portofolioModel
        ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
        ->join('foto_portofolio', 'foto_portofolio.id_portofolio = portofolio.id', 'left')
        ->where('foto_portofolio.id', function ($builder) {
            return $builder->selectMax('id')
                          ->from('foto_portofolio')
                          ->where('foto_portofolio.id_portofolio = portofolio.id');
        })
        ->orderBy('portofolio.created_at', 'DESC')
        ->limit(9)
        ->find();

        return view('user/beranda', $data);
    }

    public function index_visitor()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        // Ambil semua portofolio terbaru beserta 1 foto utama
        $data['portofolio'] = $this->portofolioModel
        ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
        ->join('foto_portofolio', 'foto_portofolio.id_portofolio = portofolio.id', 'left')
        ->where('foto_portofolio.id', function ($builder) {
            return $builder->selectMax('id')
                          ->from('foto_portofolio')
                          ->where('foto_portofolio.id_portofolio = portofolio.id');
        })
        ->orderBy('portofolio.created_at', 'DESC')
        ->limit(9)
        ->find();

        return view('visitor/beranda', $data);
    }

    public function index_admin()
    {
        $currentYear = date('Y');
        $selectedYear = $this->request->getGet('tahun') ?? $currentYear;
        $currentMonth = date('Y-m');

        // Pendapatan bulan ini
        $pendapatanBulanIni = $this->pembayaranModel
            ->selectSum('jumlah', 'total')
            ->where('status', 'success')
            ->where("DATE_FORMAT(created_at, '%Y-%m')", $currentMonth)
            ->first()['total'] ?? 0;

        // Total pemesanan bulan ini
        $totalPemesanan = $this->pemesananModel
            ->where("DATE_FORMAT(waktu_pemesanan, '%Y-%m')", $currentMonth)
            ->countAllResults();

        // Pesanan selesai bulan ini
        $pesananSelesai = $this->pemesananModel
            ->where("DATE_FORMAT(waktu_pemesanan, '%Y-%m')", $currentMonth)
            ->where('status', 'Selesai')
            ->countAllResults();

        // Pesanan dalam proses bulan ini
        $pesananDalamProses = $this->pemesananModel
            ->where("DATE_FORMAT(waktu_pemesanan, '%Y-%m')", $currentMonth)
            ->where('status !=', 'Selesai')
            ->countAllResults();

        // Data untuk grafik jumlah pemesanan per bulan dalam 1 tahun
        $pemesananPerBulan = $this->pemesananModel
            ->select("DATE_FORMAT(waktu_pemesanan, '%b') AS bulan, DATE_FORMAT(waktu_pemesanan, '%m') AS bulan_nomor, COUNT(*) AS jumlah")
            ->where("YEAR(waktu_pemesanan)", $selectedYear)
            ->groupBy("DATE_FORMAT(waktu_pemesanan, '%b'), DATE_FORMAT(waktu_pemesanan, '%m')")
            ->orderBy("bulan_nomor")
            ->findAll();

        // Data untuk grafik pendapatan per bulan dalam 1 tahun
        $pendapatanPerBulan = $this->pembayaranModel
            ->select("DATE_FORMAT(created_at, '%b') AS bulan, DATE_FORMAT(created_at, '%m') AS bulan_nomor, SUM(jumlah) AS total")
            ->where('status', 'success')
            ->where("YEAR(created_at)", $selectedYear)
            ->groupBy("DATE_FORMAT(created_at, '%b'), DATE_FORMAT(created_at, '%m')")
            ->orderBy("bulan_nomor")
            ->findAll();

        // Format data untuk Chart.js
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $pemesananData = array_fill(0, 12, 0);
        $pendapatanData = array_fill(0, 12, 0);

        foreach ($pemesananPerBulan as $data) {
            $index = array_search($data['bulan'], $bulanLabels);
            if ($index !== false) {
                $pemesananData[$index] = $data['jumlah'];
            }
        }

        foreach ($pendapatanPerBulan as $data) {
            $index = array_search($data['bulan'], $bulanLabels);
            if ($index !== false) {
                $pendapatanData[$index] = $data['total'];
            }
        }

        // Dapatkan tahun-tahun yang tersedia untuk dropdown
        $tahunTersedia = $this->pemesananModel
            ->select("YEAR(waktu_pemesanan) AS tahun")
            ->groupBy("YEAR(waktu_pemesanan)")
            ->orderBy("tahun", "DESC")
            ->findAll();

        $data = [
            'pendapatan_bulan_ini' => $pendapatanBulanIni,
            'total_pemesanan' => $totalPemesanan,
            'pesanan_selesai' => $pesananSelesai,
            'pesanan_dalam_proses' => $pesananDalamProses,
            'chart_labels' => json_encode($bulanLabels),
            'chart_pemesanan_data' => json_encode($pemesananData),
            'chart_pendapatan_data' => json_encode($pendapatanData),
            'tahun_selected' => $selectedYear,
            'tahun_tersedia' => $tahunTersedia,
            'page_title' => 'Dashboard Admin'
        ];

        return view('admin/dashboard', $data);
    }
}
