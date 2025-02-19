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

}
