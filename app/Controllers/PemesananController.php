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
        ->select('pemesanan.*, paket_layanan.nama AS nama_paket, paket_layanan.harga, paket_layanan.foto')
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
                paket_layanan.harga AS harga
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

        $data = [
            'profile_perusahaan' => $this->profileModel->findAll(),
            'paket_layanan' => $this->paketLayananModel->findAll(),
            'user_data' => $userData,
            'isProfileComplete' => $isProfileComplete,
            'pembayaran' => $pembayaran,
            'all_pemesanan' => $pemesanan,
            'riwayat_pemesanan' => $riwayatPemesanan,
            'tracking_steps' => $trackingSteps,
            'page_title' => 'Reservasi & Tracking'
        ];

        return view('user/reservasi', $data);
    }

    public function simpan()
    {
        $data = [
            'user_id'               => session()->get('user_id'),
            'paket_id'              => $this->request->getPost('paket_layanan'),
            'nama_lengkap'          => $this->request->getPost('nama_lengkap'),
            'email'                 => $this->request->getPost('email'),
            'telepon'               => $this->request->getPost('telepon'),
            'waktu_pemesanan'       => $this->request->getPost('waktu_pemesanan'),
            'paket_layanan'         => $this->request->getPost('paket_layanan'),
            'waktu_pemotretan'      => $this->request->getPost('waktu_pemotretan'),
            'jenis_pembayaran'      => $this->request->getPost('jenis_pembayaran'),
            'lokasi_pemotretan'     => $this->request->getPost('lokasi_pemotretan'),
            'link_maps_pemotretan'  => $this->request->getPost('link_maps_pemotretan'),
            'link_maps_pengiriman'  => $this->request->getPost('link_maps_pengiriman'),
            'nama_mempelai'         => $this->request->getPost('nama_mempelai'),
            'instagram'             => $this->request->getPost('instagram'),
            'status_pembayaran'     => 'Belum Bayar', // Set default status pembayaran
            'created_at'            => date('Y-m-d H:i:s')
        ];

        $this->pemesananModel->insert($data);
        $pemesananId = $this->pemesananModel->insertID();
        $paket = $this->paketLayananModel->find($data['paket_id']);

        // Logika pembayaran
        if ($data['jenis_pembayaran'] === 'DP') {
            $this->pembayaranModel->insert([
                'pemesanan_id' => $pemesananId,
                'jumlah' => $paket['harga'] * 0.5,
                'jenis' => 'DP',
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $this->pembayaranModel->insert([
                'pemesanan_id' => $pemesananId,
                'jumlah' => $paket['harga'] * 0.5,
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

        return redirect()->to('user/reservasi')->with('success', 'Reservasi berhasil dikirim!');
    }

    public function batal($id)
    {
        // Ambil data pemesanan
        $pemesanan = $this->pemesananModel->find($id);

        if (!$pemesanan) {
            return redirect()->to('user/reservasi')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Periksa apakah user yang login adalah pemilik pemesanan
        if ($pemesanan['user_id'] != session()->get('user_id')) {
            return redirect()->to('user/reservasi')->with('error', 'Anda tidak memiliki akses untuk membatalkan pemesanan ini.');
        }

        // Ambil semua pembayaran terkait pemesanan
        $pembayaran = $this->pembayaranModel->where('pemesanan_id', $id)->findAll();

        // Periksa apakah ada pembayaran dengan status 'success'
        foreach ($pembayaran as $bayar) {
            if ($bayar['status'] === 'success') {
                return redirect()->to('user/reservasi')->with('error', 'Pemesanan tidak dapat dibatalkan karena sudah ada pembayaran yang berhasil.');
            }
        }

        // Jika semua pembayaran masih 'pending' atau tidak ada pembayaran, hapus data
        $this->pembayaranModel->where('pemesanan_id', $id)->delete();
        $this->pemesananModel->delete($id);

        return redirect()->to('user/reservasi')->with('success', 'Pemesanan berhasil dibatalkan.');
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
            users.username AS nama_user, 
            users.email, 
            user_profile.nama_lengkap, 
            user_profile.no_telepon, 
            user_profile.instagram, 
            paket_layanan.nama AS nama_paket,
            paket_layanan.harga AS harga
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
                ->orLike('pemesanan.jenis_pembayaran', $search)
                ->orLike('pemesanan.lokasi_pemotretan', $search)
                ->orLike('pemesanan.nama_mempelai', $search)
                ->orLike('pemesanan.status', $search)
                ->orLike('pemesanan.status_pembayaran', $search) // Tambahkan pencarian berdasarkan status_pembayaran
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
                users.username AS nama_user, 
                users.email, 
                user_profile.nama_lengkap, 
                user_profile.no_telepon, 
                user_profile.instagram, 
                paket_layanan.nama AS nama_paket,
                paket_layanan.harga AS harga
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

        $updateData = ['status' => $status];

        if ($status === 'Selesai') {
            $updateData['status_selesai_at'] = date('Y-m-d H:i:s');
        }

        $this->pemesananModel->update($id, $updateData);

        return redirect()->to('admin/data-pemesanan/index')->with('success', 'Status pemesanan diperbarui.');
    }
}
