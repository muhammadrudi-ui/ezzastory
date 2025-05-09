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

        // Ambil SEMUA data pemesanan user (bukan hanya yang terbaru)
        $pemesanan = $this->pemesananModel->where('user_id', $userId)
                        ->orderBy('created_at', 'DESC')
                        ->findAll();

        // Ambil data pembayaran untuk semua pemesanan
        $pembayaran = [];
        if ($pemesanan) {
            foreach ($pemesanan as $pesan) {
                $pembayaran[$pesan['id']] = $this->pembayaranModel->where('pemesanan_id', $pesan['id'])->findAll();
            }
        }

        $data = [
            'profile_perusahaan' => $this->profileModel->findAll(),
            'paket_layanan' => $this->paketLayananModel->findAll(),
            'user_data' => $userData,
            'isProfileComplete' => $isProfileComplete,
            'pembayaran' => $pembayaran,
            'all_pemesanan' => $pemesanan // Ubah nama variabel untuk lebih jelas
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
            'created_at'            => date('Y-m-d H:i:s')
        ];

        $this->pemesananModel->insert($data);
        // Ambil ID pemesanan yang baru dibuat
        $pemesananId = $this->pemesananModel->insertID();

        // Ambil data paket
        $paket = $this->paketLayananModel->find($data['paket_id']);

        // Hitung jumlah pembayaran
        if ($data['jenis_pembayaran'] === 'DP') {
            $jumlah = $paket['harga'] * 0.5;
            $jenisPembayaran = 'DP';
        } else {
            $jumlah = $paket['harga'];
            $jenisPembayaran = 'Pelunasan';
        }

        // Simpan data pembayaran
        $this->pembayaranModel->save([
            'pemesanan_id' => $pemesananId,
            'jumlah' => $jumlah,
            'jenis' => $jenisPembayaran,
            'status' => 'pending'
        ]);


        return redirect()->to('user/reservasi#pembayaran')->with('success', 'Reservasi berhasil dikirim!');

    }

    public function index_admin()
    {
        $perPage = 5;
        $search = $this->request->getGet('search');

        $this->pemesananModel
            ->select('pemesanan.*, users.username AS nama_user, user_profile.nama_lengkap, paket_layanan.nama AS nama_paket')
            ->join('users', 'users.id = pemesanan.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id = users.id', 'left')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->where('pemesanan.status !=', 'Selesai')
            ->orderBy('pemesanan.created_at', 'DESC');

        // Tambahkan pencarian jika ada keyword
        if ($search) {
            $this->pemesananModel
                ->groupStart()
                ->like('user_profile.nama_lengkap', $search)
                ->orLike('users.username', $search)
                ->orLike('paket_layanan.nama', $search)
                ->orLike('pemesanan.jenis_pembayaran', $search)
                ->orLike('pemesanan.lokasi_pemotretan', $search)
                ->orLike('pemesanan.nama_mempelai', $search)
                ->orLike('pemesanan.status', $search)
                ->groupEnd();
        }

        // Ambil data dengan paginasi
        $data['pemesanans'] = $this->pemesananModel->paginate($perPage);
        $data['pager']       = $this->pemesananModel->pager;
        $data['search']      = $search;

        return view('admin/data-pemesanan/index', $data);
    }


    public function riwayat()
    {
        $data['pemesanans'] = $this->pemesananModel
            ->withUser()
            ->withPaket()
            ->riwayat()
            ->orderBy('status_selesai_at', 'DESC')
            ->findAll();

        return view('admin/data-pemesanan/riwayat', $data);
    }

    public function edit_admin($id)
    {
        $data['pemesanan'] = $this->pemesananModel->find($id);

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

        return redirect()->to('/admin/pemesanan')->with('success', 'Status pemesanan diperbarui.');
    }
}
