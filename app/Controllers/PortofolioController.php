<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PortofolioController extends BaseController
{
    public function index()
    {
        return view('portofolio');
    }

    public function kategori()
    {
        return view('portofolio-kategori');
    }

    public function detail()
    {
        return view('portofolio-detail');
    }

    public function view_admin()
    {
        return view('admin/portofolio-view');
    }

    public function add_admin()
    {
        return view('admin/portofolio-add');
    }

    public function edit_admin()
    {
        return view('admin/portofolio-edit');
    }

}
