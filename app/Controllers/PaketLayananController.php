<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PaketLayananController extends BaseController
{
    public function index()
    {
        return view('paket-layanan');
    }

    public function view_admin()
    {
        return view('admin/paket-layanan-view');
    }

    public function add_admin()
    {
        return view('admin/paket-layanan-add');
    }

    public function edit_admin()
    {
        return view('admin/paket-layanan-edit');
    }
}
