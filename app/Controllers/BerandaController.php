<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BerandaController extends BaseController
{
    public function index()
    {
        return view('beranda');
    }
}
