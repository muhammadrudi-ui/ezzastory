<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanKeuanganController extends BaseController
{
    public function index()
    {
        return view('admin/laporan-keuangan');
    }
}
