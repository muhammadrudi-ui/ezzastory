<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class JadwalController extends BaseController
{
    public function index()
    {
        return view('user/reservasi');
    }

    public function index_admin()
    {
        return view('admin/ketersediaan-jadwal');
    }
}
