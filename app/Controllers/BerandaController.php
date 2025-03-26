<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfilePerusahaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class BerandaController extends BaseController
{
    public function __construct()
    {
        $this->profileModel = new ProfilePerusahaanModel();
    }
    public function index()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        return view('beranda', $data);
    }

    public function index_admin()
    {
        return view('admin/dashboard');
    }
}
