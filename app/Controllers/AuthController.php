<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\ProfilePerusahaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel;
    protected $userProfileModel;
    protected $session;
    protected $request;
    protected $profileModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userProfileModel = new UserProfileModel();
        $this->session = session();
        $this->request = \Config\Services::request();
        $this->profileModel = new ProfilePerusahaanModel();
    }

    public function login()
    {
        if ($this->session->get('logged_in')) {
            return $this->redirectByRole();
        }

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
            $this->session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'logged_in' => true
            ]);

            return $this->redirectByRole();
        } else {
            return redirect()->back()->with('error', 'Username atau password salah.');
        }
    }

    private function redirectByRole()
    {
        $role = $this->session->get('role');

        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/user/beranda');
        }
    }

    public function register()
    {
        if ($this->session->get('logged_in')) {
            return $this->redirectByRole();
        }

        return view('register');
    }

    public function registerPost()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirm = $this->request->getPost('confirm_password');

        if (strlen($password) < 6) {
            return redirect()->back()->withInput()->with('error', 'Password harus memiliki minimal 6 karakter.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->with('error', 'Format email tidak valid.');
        }

        if (!preg_match('/^[^\s]{1,30}$/', $username)) {
            return redirect()->back()->withInput()->with('error', 'Username maksimal 30 karakter dan tidak boleh mengandung spasi.');
        }

        if ($this->userModel->where('username', $username)->first()) {
            return redirect()->back()->withInput()->with('error', 'Username yang Anda pilih tidak tersedia. Silakan pilih username lain.');
        }

        if ($this->userModel->where('email', $email)->first()) {
            return redirect()->back()->withInput()->with('error', 'Email yang Anda masukkan sudah terdaftar. Silakan gunakan email lain.');
        }

        if ($password !== $confirm) {
            return redirect()->back()->withInput()->with('error', 'Konfirmasi password tidak sesuai.');
        }

        // Jika semua validasi lolos, simpan data
        $this->userModel->save([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user',
        ]);

        return redirect()->to('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }

    public function profile()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        $userId = session('user_id');
        $data['user'] = $this->userModel->getUserWithProfile($userId);

        return view('user/profile', $data);
    }

    public function updateProfile()
    {
        $userId = session('user_id');

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $newPassword = $this->request->getPost('password');
        $noTelepon = $this->request->getPost('no_telepon');
        if (!preg_match('/^\d{10,13}$/', $noTelepon)) {
            return redirect()->back()->with('error', 'No Telepon harus terdiri dari 10 hingga 13 digit angka.');
        }


        $currentUser = $this->userModel->find($userId);

        // Cek Username sudah dipakai atau belum
        $existingUsername = $this->userModel
            ->where('username', $username)
            ->where('id !=', $userId)
            ->first();

        if (!preg_match('/^[^\s]{1,30}$/', $username)) {
            return redirect()->back()->with('error', 'Username maksimal 30 karakter dan tidak boleh mengandung spasi.');
        }

        if ($existingUsername) {
            return redirect()->back()->with('error', 'Username yang Anda pilih tidak tersedia. Silakan pilih username lain.');
        }

        // Cek Email sudah dipakai atau belum
        $existingEmail = $this->userModel
            ->where('email', $email)
            ->where('id !=', $userId)
            ->first();

        if ($existingEmail) {
            return redirect()->back()->with('error', 'Email yang Anda masukkan sudah terdaftar. Silakan gunakan email lain.');
        }

        $dataUser = [
            'username' => $username,
            'email' => $email,
        ];

        $passwordChanged = false;

        if (!empty($newPassword)) {
            if (strlen($newPassword) < 6) {
                return redirect()->back()->with('error', 'Password baru harus memiliki minimal 6 karakter.');
            }

            $dataUser['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            $passwordChanged = true;
        }

        $this->userModel->update($userId, $dataUser);

        $dataProfile = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_telepon' => $noTelepon,
            'instagram' => $this->request->getPost('instagram'),
        ];

        $profile = $this->userProfileModel->where('user_id', $userId)->first();

        if ($profile) {
            $this->userProfileModel->update($profile['user_id'], $dataProfile);
        } else {
            $dataProfile['user_id'] = $userId;
            $this->userProfileModel->insert($dataProfile);
        }

        if ($passwordChanged) {
            session()->destroy();
            return redirect()->to('/login')->with('success', 'Password diperbarui. Silakan login kembali.');
        }

        return redirect()->to('/user/profile')->with('success', 'Profil berhasil diperbarui.');
    }

    // Tambahkan method ini di AuthController
    public function adminProfile()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        $userId = session('user_id');
        $data['user'] = $this->userModel->getUserWithProfile($userId);

        return view('admin/profile', $data);
    }

    public function updateAdminProfile()
    {
        $userId = session('user_id');

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $newPassword = $this->request->getPost('password');
        $noTelepon = $this->request->getPost('no_telepon');

        if (!preg_match('/^\d{10,13}$/', $noTelepon)) {
            return redirect()->back()->with('error', 'No Telepon harus terdiri dari 10 hingga 13 digit angka.');
        }

        $currentUser = $this->userModel->find($userId);

        // Validasi username
        $existingUsername = $this->userModel
            ->where('username', $username)
            ->where('id !=', $userId)
            ->first();

        if (!preg_match('/^[^\s]{1,30}$/', $username)) {
            return redirect()->back()->with('error', 'Username maksimal 30 karakter dan tidak boleh mengandung spasi.');
        }

        if ($existingUsername) {
            return redirect()->back()->with('error', 'Username yang Anda pilih tidak tersedia. Silakan pilih username lain.');
        }

        // Validasi email
        $existingEmail = $this->userModel
            ->where('email', $email)
            ->where('id !=', $userId)
            ->first();

        if ($existingEmail) {
            return redirect()->back()->with('error', 'Email yang Anda masukkan sudah terdaftar. Silakan gunakan email lain.');
        }

        $dataUser = [
            'username' => $username,
            'email' => $email,
        ];

        $passwordChanged = false;

        if (!empty($newPassword)) {
            if (strlen($newPassword) < 6) {
                return redirect()->back()->with('error', 'Password baru harus memiliki minimal 6 karakter.');
            }

            $dataUser['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            $passwordChanged = true;
        }

        $this->userModel->update($userId, $dataUser);

        $dataProfile = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_telepon' => $noTelepon,
            'instagram' => $this->request->getPost('instagram'),
        ];

        $profile = $this->userProfileModel->where('user_id', $userId)->first();

        if ($profile) {
            $this->userProfileModel->update($profile['user_id'], $dataProfile);
        } else {
            $dataProfile['user_id'] = $userId;
            $this->userProfileModel->insert($dataProfile);
        }

        if ($passwordChanged) {
            session()->destroy();
            return redirect()->to('/login')->with('success', 'Password diperbarui. Silakan login kembali.');
        }

        return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
