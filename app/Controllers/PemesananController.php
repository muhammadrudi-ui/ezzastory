<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PemesananController extends BaseController
{
    public function index_admin()
    {
        return view('admin/data-pemesanan-view');
    }

    public function edit_admin()
    {
        return view('admin/data-pemesanan-edit');
    }
}
