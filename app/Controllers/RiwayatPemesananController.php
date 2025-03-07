<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RiwayatPemesananController extends BaseController
{
    public function index()
    {
        return view('admin/riwayat-pemesanan');
    }
}
