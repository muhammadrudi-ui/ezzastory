<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PemesananModel;
use App\Models\PaketLayananModel;
use App\Models\ProfilePerusahaanModel;
use App\Models\UserModel;
use App\Models\PembayaranModel;

class PemesananController extends BaseController
{
    protected $pemesananModel;
    protected $paketLayananModel;
    protected $profileModel;
    protected $userModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
        $this->profileModel = new ProfilePerusahaanModel();
        $this->paketLayananModel = new PaketLayananModel();
        $this->userModel = new UserModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $userData = $this->userModel->getUserWithProfile($userId);
        $isProfileComplete = !(empty($userData['nama_lengkap']) || empty($userData['email']) || empty($userData['no_telepon']) || empty($userData['instagram']));

        // Ambil SEMUA data pemesanan user
        $pemesanan = $this->pemesananModel
            ->select('pemesanan.*, paket_layanan.nama AS nama_paket, paket_layanan.harga, paket_layanan.foto, paket_layanan.jenis_layanan')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->where('pemesanan.user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        // Ambil data riwayat (pemesanan selesai)
        $riwayatPemesanan = $this->pemesananModel
            ->select('
                pemesanan.*, 
                user_profile.instagram, 
                paket_layanan.nama AS nama_paket,
                paket_layanan.harga AS harga,
                paket_layanan.jenis_layanan AS jenis_layanan
            ')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->join('user_profile', 'user_profile.user_id = pemesanan.user_id', 'left')
            ->where('pemesanan.user_id', $userId)
            ->where('status', 'Selesai')
            ->orderBy('status_selesai_at', 'DESC')
            ->findAll();

        // Ambil data pembayaran untuk semua pemesanan
        $pembayaran = [];
        $trackingSteps = [];

        if ($pemesanan) {
            foreach ($pemesanan as $pesan) {
                $pembayaran[$pesan['id']] = $this->pembayaranModel->where('pemesanan_id', $pesan['id'])->findAll();

                $trackingSteps[$pesan['id']] = [
                    'Pemesanan' => $pesan['status'] === 'Pemesanan',
                    'Pemotretan' => $pesan['status'] === 'Pemotretan',
                    'Editing' => $pesan['status'] === 'Editing',
                    'Pencetakan' => $pesan['status'] === 'Pencetakan',
                    'Pengiriman' => $pesan['status'] === 'Pengiriman',
                    'Selesai' => $pesan['status'] === 'Selesai',
                    'current_status' => $pesan['status']
                ];
            }
        }

        $tabParam = $this->request->getGet('tab');
        $paketId = $this->request->getGet('paket_id');
        $activeTab = 'jadwal';
        if ($tabParam === 'pembayaran') {
            $activeTab = 'pembayaran';
        } elseif ($tabParam === 'reservasi') {
            $activeTab = 'reservasi';
        } elseif ($tabParam === 'tracking') {
            $activeTab = 'tracking';
        } elseif ($tabParam === 'riwayat') {
            $activeTab = 'riwayat';
        } elseif ($paketId) {
            $activeTab = 'reservasi';
        }

        $data = [
            'profile_perusahaan' => $this->profileModel->findAll(),
            'paket_layanan' => $this->paketLayananModel->findAll(),
            'user_data' => $userData,
            'isProfileComplete' => $isProfileComplete,
            'pembayaran' => $pembayaran,
            'all_pemesanan' => $pemesanan,
            'riwayat_pemesanan' => $riwayatPemesanan,
            'tracking_steps' => $trackingSteps,
            'page_title' => 'Reservasi & Tracking',
            'active_tab' => $activeTab
        ];

        return view('user/reservasi', $data);
    }

    public function simpan()
    {
        $paketId = $this->request->getPost('paket_layanan');
        $waktuPemotretan = $this->request->getPost('waktu_pemotretan');
        $paket = $this->paketLayananModel->find($paketId);

        if (!$paket) {
            return redirect()->to('user/reservasi?tab=reservasi')
                ->with('error', 'Paket layanan tidak ditemukan.');
        }

        // Validasi tanggal pemotretan
        $today = new \DateTime('today', new \DateTimeZone('Asia/Jakarta'));
        $selectedDate = new \DateTime($waktuPemotretan, new \DateTimeZone('Asia/Jakarta'));

        if ($selectedDate < $today) {
            return redirect()->to('user/reservasi?tab=reservasi')
                ->with('error', 'Tidak bisa memilih tanggal pemotretan yang sudah lewat. Silakan pilih tanggal setelahnya.');
        }

        // Cek kuota Wedding
        if (isset($paket['jenis_layanan']) && strtolower($paket['jenis_layanan']) === 'wedding') {
            $tanggalPemotretan = date('Y-m-d', strtotime($waktuPemotretan));
            $jumlahPemesanan = $this->pemesananModel
                ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id')
                ->where('LOWER(paket_layanan.jenis_layanan)', 'wedding')
                ->where('DATE(pemesanan.waktu_pemotretan)', $tanggalPemotretan)
                ->where('pemesanan.status !=', 'Selesai')
                ->countAllResults();

            if ($jumlahPemesanan >= 3) {
                return redirect()->to('user/reservasi?tab=reservasi')
                    ->with('error', 'Maaf, kuota pemotretan Wedding untuk tanggal pemotretan tersebut sudah penuh (maksimal 3 pemesanan per hari).');
            }
        }

        // Data untuk disimpan
        $data = [
            'user_id'               => session()->get('user_id'),
            'paket_id'              => $paketId,
            'nama_lengkap'          => $this->request->getPost('nama_lengkap'),
            'email'                 => $this->request->getPost('email'),
            'telepon'               => $this->request->getPost('telepon'),
            'waktu_pemesanan'       => $this->request->getPost('waktu_pemesanan'),
            'paket_layanan'         => $paketId,
            'waktu_pemotretan'      => $waktuPemotretan,
            'jenis_pembayaran'      => $this->request->getPost('jenis_pembayaran'),
            'lokasi_pemotretan'     => $this->request->getPost('lokasi_pemotretan'),
            'link_maps_pemotretan'  => $this->request->getPost('link_maps_pemotretan'),
            'status_pembayaran'     => 'Belum Bayar',
            'created_at'            => date('Y-m-d H:i:s')
        ];

        // Tambahkan field opsional berdasarkan jenis layanan
        $jenisLayanan = strtolower($paket['jenis_layanan'] ?? '');
        if ($jenisLayanan === 'wedding') {
            $data['link_maps_pengiriman'] = $this->request->getPost('link_maps_pengiriman');
            $data['nama_mempelai'] = $this->request->getPost('nama_mempelai');
        } elseif (in_array($jenisLayanan, ['pre-wedding', 'engagement'])) {
            $data['nama_mempelai'] = $this->request->getPost('nama_mempelai');
        }
        $data['instagram'] = $this->request->getPost('instagram');

        $this->pemesananModel->insert($data);
        $pemesananId = $this->pemesananModel->insertID();

        // Logika pembayaran
        if ($data['jenis_pembayaran'] === 'DP') {
            $this->pembayaranModel->insert([
                'pemesanan_id' => $pemesananId,
                'jumlah' => $paket['harga'] * 0.3,
                'jenis' => 'DP',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $this->pembayaranModel->insert([
                'pemesanan_id' => $pemesananId,
                'jumlah' => $paket['harga'] * 0.7,
                'jenis' => 'Pelunasan',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $this->pembayaranModel->insert([
                'pemesanan_id' => $pemesananId,
                'jumlah' => $paket['harga'],
                'jenis' => 'Pelunasan',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to('user/reservasi?tab=pembayaran')->with('success', 'Reservasi berhasil dikirim!');
    }

    // Cek Ketersedian Form Reservasi
    public function checkAvailability()
    {
        $paketId = $this->request->getPost('paket_id');
        $waktuPemotretan = $this->request->getPost('waktu_pemotretan');

        $paket = $this->paketLayananModel->find($paketId);
        $isAvailable = true;
        $message = '';

        if (!$paket) {
            return $this->response->setJSON([
                'is_available' => false,
                'message' => 'Paket layanan tidak ditemukan.'
            ]);
        }

        // Validasi tanggal pemotretan tidak boleh masa lalu
        $today = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $selectedDate = new \DateTime($waktuPemotretan, new \DateTimeZone('Asia/Jakarta'));

        if ($selectedDate < $today) {
            return $this->response->setJSON([
                'is_available' => false,
                'message' => 'Tidak bisa memilih tanggal pemotretan yang sudah lewat.'
            ]);
        }

        // Cek jika jenis layanan adalah Wedding
        if (isset($paket['jenis_layanan']) && strtolower($paket['jenis_layanan']) === 'wedding') {
            $tanggalPemotretan = date('Y-m-d', strtotime($waktuPemotretan));

            // Hitung semua pemesanan dengan jenis layanan Wedding pada tanggal tersebut
            $jumlahPemesanan = $this->pemesananModel
                ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id')
                ->where('LOWER(paket_layanan.jenis_layanan)', 'wedding')
                ->where('DATE(pemesanan.waktu_pemotretan)', $tanggalPemotretan)
                ->where('pemesanan.status !=', 'Selesai')
                ->countAllResults();

            $isAvailable = $jumlahPemesanan < 3;
            $message = $isAvailable ? '' : 'Maaf, kuota pemotretan Wedding untuk tanggal ini sudah penuh (maksimal 3 pemesanan per hari).';
        }

        return $this->response->setJSON([
            'is_available' => $isAvailable,
            'message' => $message
        ]);
    }

    // Cek Deadline Payment DP
    public function checkAndCancelExpiredReservations()
    {
        $pemesananList = $this->pemesananModel
            ->where('status !=', 'Selesai')
            ->findAll();

        $currentDate = new \DateTime();
        $currentDate->setTimezone(new \DateTimeZone('Asia/Jakarta'));

        foreach ($pemesananList as $pemesanan) {
            $waktuPemotretan = new \DateTime($pemesanan['waktu_pemotretan']);
            $deadlinePembayaran = clone $waktuPemotretan;
            $deadlinePembayaran->modify('-3 days');

            // Cek jika sudah melewati H-3 sebelum pemotretan
            if ($currentDate > $deadlinePembayaran) {
                $pembayaran = $this->pembayaranModel
                    ->where('pemesanan_id', $pemesanan['id'])
                    ->where('status', 'success')
                    ->findAll();

                $isPaid = false;
                foreach ($pembayaran as $bayar) {
                    if ($pemesanan['jenis_pembayaran'] === 'DP' && $bayar['jenis'] === 'DP' && $bayar['status'] === 'success') {
                        $isPaid = true;
                        break;
                    } elseif ($pemesanan['jenis_pembayaran'] === 'Lunas' && $bayar['jenis'] === 'Pelunasan' && $bayar['status'] === 'success') {
                        $isPaid = true;
                        break;
                    }
                }

                // Jika belum dibayar, batalkan pemesanan
                if (!$isPaid) {
                    $this->pembayaranModel->where('pemesanan_id', $pemesanan['id'])->delete();
                    $this->pemesananModel->delete($pemesanan['id']);
                    log_message('info', "Pemesanan ID {$pemesanan['id']} dibatalkan karena tidak dibayar sebelum H-3 pemotretan.");
                }
            }
        }

        // Kembalikan respons JSON untuk HTTP
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pemeriksaan pemesanan selesai.'
        ]);
    }

    public function batal($id)
    {
        $pemesanan = $this->pemesananModel->find($id);

        if (!$pemesanan) {
            return redirect()->to('user/reservasi?tab=pembayaran')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Periksa apakah user yang login adalah pemilik pemesanan
        if ($pemesanan['user_id'] != session()->get('user_id')) {
            return redirect()->to('user/reservasi?tab=pembayaran')->with('error', 'Anda tidak memiliki akses untuk membatalkan pemesanan ini.');
        }

        // Ambil semua pembayaran pemesanan
        $pembayaran = $this->pembayaranModel->where('pemesanan_id', $id)->findAll();

        // Periksa apakah ada pembayaran dengan status 'success'
        foreach ($pembayaran as $bayar) {
            if ($bayar['status'] === 'success') {
                return redirect()->to('user/reservasi?tab=pembayaran')->with('error', 'Pemesanan tidak dapat dibatalkan karena sudah ada pembayaran yang berhasil.');
            }
        }

        // Jika semua pembayaran masih 'pending' atau tidak ada pembayaran, hapus data
        $this->pembayaranModel->where('pemesanan_id', $id)->delete();
        $this->pemesananModel->delete($id);

        return redirect()->to('user/reservasi?tab=pembayaran')->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    // Cek Selesaikan Otomatis Pesanan Pengguna
    public function checkAndCompleteExpiredReservations()
    {
        // Ambil semua pemesanan dengan status Pengiriman
        $pemesananList = $this->pemesananModel
            ->where('status', 'Pengiriman')
            ->findAll();

        $currentDate = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));

        foreach ($pemesananList as $pemesanan) {
            // Cek waktu saat status menjadi Pengiriman (menggunakan updated_at)
            $waktuPengiriman = new \DateTime($pemesanan['updated_at'], new \DateTimeZone('Asia/Jakarta'));
            $deadlineSelesai = clone $waktuPengiriman;
            $deadlineSelesai->modify('+2 days');

            // Jika sudah melewati 2 hari dari status Pengiriman
            if ($currentDate > $deadlineSelesai) {
                // Update status ke Selesai dan set is_portfolio_approved ke Bersedia
                $this->pemesananModel->update($pemesanan['id'], [
                    'status' => 'Selesai',
                    'status_selesai_at' => $currentDate->format('Y-m-d H:i:s'),
                    'is_portfolio_approved' => 'Bersedia'
                ]);

                log_message('info', "Pemesanan ID {$pemesanan['id']} otomatis diselesaikan karena melewati batas waktu 2 hari pada status Pengiriman.");
            }
        }

        // Kembalikan respons JSON untuk cron job atau debugging
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pemeriksaan otomatis penyelesaian pemesanan selesai.'
        ]);
    }

    public function selesai($id)
    {
        $pemesanan = $this->pemesananModel->find($id);

        if (!$pemesanan) {
            return redirect()->to('user/reservasi?tab=riwayat')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Periksa apakah user yang login adalah pemilik pemesanan
        if ($pemesanan['user_id'] != session()->get('user_id')) {
            return redirect()->to('user/reservasi?tab=riwayat')->with('error', 'Anda tidak memiliki akses untuk menyelesaikan pemesanan ini.');
        }

        // Periksa apakah status adalah Pengiriman
        if ($pemesanan['status'] !== 'Pengiriman') {
            return redirect()->to('user/reservasi?tab=riwayat')->with('error', 'Pemesanan hanya dapat diselesaikan pada status Pengiriman.');
        }

        // Ambil data persetujuan portofolio dari form
        $isPortfolioApproved = $this->request->getPost('is_portfolio_approved');

        // Update status pemesanan ke Selesai dan simpan persetujuan portofolio
        $this->pemesananModel->update($id, [
            'status' => 'Selesai',
            'status_selesai_at' => date('Y-m-d H:i:s'),
            'is_portfolio_approved' => $isPortfolioApproved
        ]);

        return redirect()->to('user/reservasi?tab=riwayat')->with('success', 'Pemesanan telah diselesaikan.');
    }

    // Ketersediaan Jadwal
    public function getReservations()
    {
        $month = $this->request->getGet('month');
        $year = $this->request->getGet('year');

        log_message('debug', "getReservations called with month: $month, year: $year");

        if (!$month || !$year) {
            log_message('error', 'Missing month or year parameters');
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Parameter bulan dan tahun diperlukan.'
            ]);
        }

        $reservations = $this->pemesananModel
            ->select('
                pemesanan.id,
                pemesanan.waktu_pemotretan,
                pemesanan.lokasi_pemotretan,
                pemesanan.link_maps_pemotretan,
                pemesanan.status,
                COALESCE(user_profile.nama_lengkap, "Tidak Diketahui") AS nama_lengkap,
                COALESCE(paket_layanan.nama, "Tidak Diketahui") AS nama_paket,
                COALESCE(paket_layanan.jenis_layanan, "Tidak Diketahui") AS jenis_layanan
            ')
            ->join('user_profile', 'user_profile.user_id = pemesanan.user_id', 'left')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->where('MONTH(pemesanan.waktu_pemotretan)', $month)
            ->where('YEAR(pemesanan.waktu_pemotretan)', $year)
            ->where('pemesanan.status !=', 'Selesai')
            ->findAll();

        log_message('debug', 'Reservations fetched: ' . json_encode($reservations));

        $groupedReservations = [];
        foreach ($reservations as $res) {
            if (!empty($res['waktu_pemotretan'])) {
                $day = (int) date('j', strtotime($res['waktu_pemotretan']));
                if (!isset($groupedReservations[$day])) {
                    $groupedReservations[$day] = [];
                }
                $groupedReservations[$day][] = [
                    'nama_lengkap' => $res['nama_lengkap'],
                    'paket' => $res['nama_paket'],
                    'waktu' => date('H:i', strtotime($res['waktu_pemotretan'])),
                    'lokasi' => $res['lokasi_pemotretan'] ?? 'Tidak Diketahui',
                    'link_maps_pemotretan' => $res['link_maps_pemotretan'] ?? '',
                    'jenis_layanan' => $res['jenis_layanan']
                ];
            }
        }

        log_message('debug', 'Grouped reservations: ' . json_encode($groupedReservations));

        return $this->response->setJSON([
            'status' => 'success',
            'reservations' => $groupedReservations,
            'total' => count($reservations)
        ]);
    }

    public function index_admin()
    {
        $search = $this->request->getGet('search');
        $filterBulan = $this->request->getGet('filter_bulan');
        $filterStatus = $this->request->getGet('filter_status');

        $this->pemesananModel
            ->select('
            pemesanan.*, 
            pemesanan.status_pembayaran, 
            pemesanan.is_portfolio_approved,
            users.username AS nama_user, 
            users.email, 
            user_profile.nama_lengkap, 
            user_profile.no_telepon, 
            user_profile.instagram, 
            paket_layanan.nama AS nama_paket,
            paket_layanan.harga AS harga,
            paket_layanan.jenis_layanan AS jenis_layanan
        ')
            ->join('users', 'users.id = pemesanan.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id = users.id', 'left')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->where('pemesanan.status !=', 'Selesai')
            ->orderBy('pemesanan.created_at', 'DESC');

        if ($search) {
            $this->pemesananModel
                ->groupStart()
                ->like('user_profile.nama_lengkap', $search)
                ->orLike('paket_layanan.nama', $search)
                ->orLike('paket_layanan.jenis_layanan', $search)
                ->orLike('pemesanan.jenis_pembayaran', $search)
                ->orLike('pemesanan.lokasi_pemotretan', $search)
                ->orLike('pemesanan.nama_mempelai', $search)
                ->orLike('pemesanan.status', $search)
                ->orLike('pemesanan.status_pembayaran', $search)
                ->orLike('pemesanan.is_portfolio_approved', $search)
                ->groupEnd();
        }

        if ($filterBulan) {
            $this->pemesananModel->where("DATE_FORMAT(pemesanan.waktu_pemesanan, '%Y-%m') =", $filterBulan);
        }

        if ($filterStatus) {
            $this->pemesananModel->where('pemesanan.status', $filterStatus);
        } else {
            $this->pemesananModel->where('pemesanan.status !=', 'Selesai');
        }

        $data['pemesanan'] = $this->pemesananModel->findAll();
        $data['search'] = $search;
        $data['filterBulan'] = $filterBulan;
        $data['filterStatus'] = $filterStatus;

        return view('admin/data-pemesanan/index', $data);
    }

    public function edit_admin($id)
    {
        $data['pemesanan'] = $this->pemesananModel
            ->select('
                pemesanan.*, 
                pemesanan.status_pembayaran,
                pemesanan.is_portfolio_approved,
                users.username AS nama_user, 
                users.email, 
                user_profile.nama_lengkap, 
                user_profile.no_telepon, 
                user_profile.instagram, 
                paket_layanan.nama AS nama_paket,
                paket_layanan.harga AS harga,
                paket_layanan.jenis_layanan AS jenis_layanan
            ')
            ->join('users', 'users.id = pemesanan.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id = users.id', 'left')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->where('pemesanan.id', $id)
            ->first();

        if (!$data['pemesanan']) {
            return redirect()->back()->with('error', 'Data pemesanan tidak ditemukan');
        }

        return view('admin/data-pemesanan/edit', $data);
    }

    public function update_admin($id)
    {
        $status = $this->request->getPost('status');
        $linkHasilFoto = $this->request->getPost('link_hasil_foto');

        $validStatuses = ['Pemesanan', 'Pemotretan', 'Editing', 'Pencetakan', 'Pengiriman', 'Selesai'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->to('admin/data-pemesanan/index')->with('error', 'Status tidak valid.');
        }
        $updateData = [
            'status' => $status,
            'link_hasil_foto' => $linkHasilFoto,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Jika status diubah menjadi Selesai, catat waktu selesai
        if ($status === 'Selesai') {
            $updateData['status_selesai_at'] = date('Y-m-d H:i:s');
        }

        $this->pemesananModel->update($id, $updateData);

        return redirect()->to('admin/data-pemesanan/index')->with('success', 'Data Pemesanan berhasil diperbarui.');
    }
}
