<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        return view('about');
    }

    public function index_admin()
    {
        return view('admin/profile-view');
    }

    public function add_admin()
    {
        return view('admin/profile-add');
    }

    public function edit_admin()
    {
        return view('admin/profile-edit');
    }
}
