<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfilePerusahaanModel;
use App\Models\PortofolioModel;
use CodeIgniter\HTTP\ResponseInterface;

class BerandaController extends BaseController
{
    public function __construct()
    {
        $this->profileModel = new ProfilePerusahaanModel();
        $this->portofolioModel = new PortofolioModel();
    }
    public function index()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        // Ambil semua portofolio terbaru beserta 1 foto utama (jika ada)
        $data['portofolio'] = $this->portofolioModel
            ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
            ->join(
                '(SELECT id_portofolio, nama_file 
              FROM foto_portofolio 
              WHERE id IN (SELECT MAX(id) 
                           FROM foto_portofolio 
                           GROUP BY id_portofolio)) AS foto_portofolio',
                'foto_portofolio.id_portofolio = portofolio.id',
                'left'
            )
            ->orderBy('created_at', 'DESC')
            ->limit(6) // ambil 6 terbaru, bebas kamu atur
            ->find();

        return view('beranda', $data);
    }

    public function index_admin()
    {
        return view('admin/dashboard');
    }
}
