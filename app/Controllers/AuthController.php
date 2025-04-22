<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;
    protected $request;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
        $this->request = \Config\Services::request();
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek apakah username ada di database
        $user = $this->userModel->where('username', $username)->first();

        // Jika user ditemukan dan password cocok
        if ($user && password_verify($password, $user['password'])) {
            // Set session jika login berhasil
            $this->session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'logged_in' => true
            ]);

            // Redirect berdasarkan role (admin atau user)
            return redirect()->to($user['role'] === 'admin' ? '/dashboard' : 'user/beranda');
        } else {
            // Menyimpan pesan error menggunakan flashdata jika login gagal
            return redirect()->back()->with('error', 'Username atau password salah.');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function registerPost()
    {
        // Ambil data dari form
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirm = $this->request->getPost('confirm_password');

        // Validasi password minimal 6 karakter
        if (strlen($password) < 6) {
            return redirect()->back()->withInput()->with('error', 'Password harus memiliki minimal 6 karakter.');
        }

        // Validasi email dengan format yang benar
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->with('error', 'Format email tidak valid.');
        }

        // Validasi username sudah ada atau belum
        if ($this->userModel->where('username', $username)->first()) {
            return redirect()->back()->withInput()->with('error', 'Username sudah digunakan.');
        }

        // Validasi email sudah ada atau belum
        if ($this->userModel->where('email', $email)->first()) {
            return redirect()->back()->withInput()->with('error', 'Email sudah digunakan.');
        }

        // Validasi konfirmasi password
        if ($password !== $confirm) {
            return redirect()->back()->withInput()->with('error', 'Konfirmasi password tidak sesuai.');
        }

        // Jika semua validasi lolos, simpan data
        $this->userModel->save([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user', // default role 'user'
        ]);

        // Redirect ke halaman login
        return redirect()->to('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
