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
        $identifier = $this->request->getPost('identifier'); // Ambil dari input identifier
        $password = $this->request->getPost('password');

        // Cek apakah identifier adalah username atau email
        $user = $this->userModel
            ->where('username', $identifier)
            ->orWhere('email', $identifier)
            ->first();

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
            // Debugging: Tambahkan log untuk memeriksa
            log_message('error', 'Login gagal untuk identifier: ' . $identifier);
            return redirect()->back()->with('error', 'Username/email atau password salah.');
        }
    }

    public function forgotPassword()
    {
        if ($this->session->get('logged_in')) {
            return $this->redirectByRole();
        }

        return view('forgot_password');
    }

    public function forgotPasswordPost()
    {
        $email = $this->request->getPost('email');

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Format email tidak valid.');
        }

        // Cek apakah email ada di database
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan dalam sistem.');
        }

        // Validasi batas percobaan
        if (!$this->checkForgotPasswordAttempts($email)) {
            return redirect()->back()->with('error', 'Anda telah melebihi batas percobaan reset password. Silakan coba lagi dalam 1 jam.');
        }

        // Generate token reset password
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token berlaku 1 jam

        // Simpan token ke database
        $this->userModel->update($user['id'], [
            'reset_token' => $token,
            'reset_expires' => $expires
        ]);

        // Kirim email menggunakan konfigurasi dari Email.php
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setSubject('Reset Password - Ezzastory');

        // Load template email
        $emailBody = view('emails/reset_password', [
            'token' => $token,
            'base_url' => base_url()
        ]);

        $emailService->setMessage($emailBody);

        if ($emailService->send()) {
            // Tambah jumlah percobaan
            $this->incrementForgotPasswordAttempts($email);
            return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
        } else {
            log_message('error', 'Gagal mengirim email reset password ke: ' . $email);
            return redirect()->back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }

    private function checkForgotPasswordAttempts($email)
    {
        $sessionKey = 'forgot_password_attempts_' . md5($email);
        $attempts = $this->session->get($sessionKey) ?? ['count' => 0, 'time' => time()];

        // Reset percobaan jika sudah lebih dari 1 jam
        if (time() - $attempts['time'] > 3600) {
            $this->session->set($sessionKey, ['count' => 0, 'time' => time()]);
            $attempts = ['count' => 0, 'time' => time()];
        }

        // Cek apakah sudah melebihi batas
        if ($attempts['count'] >= 3) {
            return false;
        }

        return true;
    }

    private function incrementForgotPasswordAttempts($email)
    {
        $sessionKey = 'forgot_password_attempts_' . md5($email);
        $attempts = $this->session->get($sessionKey) ?? ['count' => 0, 'time' => time()];
        $attempts['count']++;
        $this->session->set($sessionKey, $attempts);
    }

    public function resetPassword($token = null)
    {
        if (!$token) {
            log_message('error', 'Token reset password tidak valid: token kosong.');
            return redirect()->to('/login')->with('error', 'Token reset password tidak valid.');
        }

        // Cek token di database
        $user = $this->userModel->where('reset_token', $token)->first();

        if (!$user) {
            log_message('error', 'Token reset password tidak ditemukan: ' . $token);
            return redirect()->to('/login')->with('error', 'Token reset password tidak valid.');
        }

        // Cek apakah token sudah expired
        if (strtotime($user['reset_expires']) < time()) {
            log_message('error', 'Token reset password sudah expired: ' . $token);
            return redirect()->to('/login')->with('error', 'Token reset password sudah expired. Silakan minta reset password baru.');
        }

        return view('reset_password', ['token' => $token]);
    }

    public function resetPasswordPost()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Validasi input
        if (!$token || !$password || !$confirmPassword) {
            return redirect()->back()->with('error', 'Semua field harus diisi.');
        }

        if ($password !== $confirmPassword) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak sesuai.');
        }

        if (strlen($password) < 6) {
            return redirect()->back()->with('error', 'Password harus memiliki minimal 6 karakter.');
        }

        // Cek token di database
        $user = $this->userModel->where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Token reset password tidak valid.');
        }

        // Cek apakah token sudah expired
        if (strtotime($user['reset_expires']) < time()) {
            return redirect()->to('/login')->with('error', 'Token reset password sudah expired. Silakan minta reset password baru.');
        }

        // Update password dan hapus token
        $updateData = [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_expires' => null
        ];

        $updated = $this->userModel->update($user['id'], $updateData);

        if ($updated) {
            log_message('info', 'Password berhasil direset untuk user ID: ' . $user['id']);
            return redirect()->to('/login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
        } else {
            log_message('error', 'Gagal menyimpan password untuk user ID: ' . $user['id']);
            return redirect()->back()->with('error', 'Gagal mereset password. Silakan coba lagi.');
        }
    }

    public function confirmEmail($token = null)
    {
        if (!$token) {
            log_message('error', 'Token konfirmasi email tidak valid: token kosong.');
            return redirect()->to('/login')->with('error', 'Token konfirmasi email tidak valid.');
        }

        // Cek token di database
        $user = $this->userModel->where('email_token', $token)->first();

        if (!$user) {
            log_message('error', 'Token konfirmasi email tidak ditemukan: ' . $token);
            return redirect()->to('/login')->with('error', 'Token konfirmasi email tidak valid.');
        }

        // Cek apakah token sudah expired
        if (strtotime($user['email_token_expires']) < time()) {
            log_message('error', 'Token konfirmasi email sudah expired: ' . $token);
            return redirect()->to('/login')->with('error', 'Token konfirmasi email sudah expired.');
        }

        // Update email dan hapus token
        $this->userModel->update($user['id'], [
            'email' => $user['pending_email'],
            'pending_email' => null,
            'email_token' => null,
            'email_token_expires' => null
        ]);

        log_message('info', 'Email berhasil dikonfirmasi untuk user ID: ' . $user['id']);
        return redirect()->to('/login')->with('success', 'Email berhasil dikonfirmasi. Silakan login.');
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

        // Validasi password
        if (strlen($password) < 6) {
            log_message('error', 'Registrasi gagal: Password kurang dari 6 karakter.');
            return redirect()->back()->withInput()->with('error', 'Password harus memiliki minimal 6 karakter.');
        }

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            log_message('error', 'Registrasi gagal: Format email tidak valid.');
            return redirect()->back()->withInput()->with('error', 'Format email tidak valid.');
        }

        // Validasi username: hanya huruf kecil, angka, underscore, maks 30 karakter, tanpa spasi
        if (!preg_match('/^[a-z0-9_]{1,30}$/', $username)) {
            log_message('error', 'Registrasi gagal: Username tidak valid.');
            return redirect()->back()->withInput()->with('error', 'Username hanya boleh mengandung huruf kecil, angka, dan underscore, tanpa spasi, maksimal 30 karakter.');
        }

        // Cek apakah username sudah terdaftar
        if ($this->userModel->where('username', $username)->first()) {
            log_message('error', 'Registrasi gagal: Username ' . $username . ' sudah terdaftar.');
            return redirect()->back()->withInput()->with('error', 'Username yang Anda pilih tidak tersedia. Silakan pilih username lain.');
        }

        // Cek apakah email sudah terdaftar
        if ($this->userModel->where('email', $email)->first()) {
            log_message('error', 'Registrasi gagal: Email ' . $email . ' sudah terdaftar.');
            return redirect()->back()->withInput()->with('error', 'Email yang Anda masukkan sudah terdaftar. Silakan gunakan email lain.');
        }

        // Validasi konfirmasi password
        if ($password !== $confirm) {
            log_message('error', 'Registrasi gagal: Konfirmasi password tidak sesuai.');
            return redirect()->back()->withInput()->with('error', 'Konfirmasi password tidak sesuai.');
        }

        // Jika semua validasi lolos, simpan data
        $this->userModel->save([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user',
        ]);

        log_message('info', 'Akun berhasil dibuat untuk username: ' . $username);
        return redirect()->to('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    public function logout()
    {
        $username = $this->session->get('username');
        $this->session->destroy();
        log_message('info', 'User ' . $username . ' berhasil logout.');
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

        // Validasi nomor telepon
        if (!preg_match('/^\d{10,13}$/', $noTelepon)) {
            log_message('error', 'Update profil gagal: No Telepon tidak valid untuk user ID: ' . $userId);
            return redirect()->back()->with('error', 'No Telepon harus terdiri dari 10 hingga 13 digit angka.');
        }

        $currentUser = $this->userModel->find($userId);

        // Validasi username: hanya huruf kecil, angka, underscore, maks 30 karakter, tanpa spasi
        $existingUsername = $this->userModel
            ->where('username', $username)
            ->where('id !=', $userId)
            ->first();

        if (!preg_match('/^[a-z0-9_]{1,30}$/', $username)) {
            log_message('error', 'Update profil gagal: Username tidak valid untuk user ID: ' . $userId);
            return redirect()->back()->with('error', 'Username hanya boleh mengandung huruf kecil, angka, dan underscore, tanpa spasi, maksimal 30 karakter.');
        }

        if ($existingUsername) {
            log_message('error', 'Update profil gagal: Username ' . $username . ' sudah terdaftar.');
            return redirect()->back()->with('error', 'Username yang Anda pilih tidak tersedia. Silakan pilih username lain.');
        }

        // Validasi email
        $existingEmail = $this->userModel
            ->where('email', $email)
            ->where('id !=', $userId)
            ->first();

        if ($existingEmail) {
            log_message('error', 'Update profil gagal: Email ' . $email . ' sudah terdaftar.');
            return redirect()->back()->with('error', 'Email yang Anda masukkan sudah terdaftar. Silakan gunakan email lain.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            log_message('error', 'Update profil gagal: Format email tidak valid untuk user ID: ' . $userId);
            return redirect()->back()->with('error', 'Format email tidak valid.');
        }

        $dataUser = [
            'username' => $username,
        ];

        $emailChanged = false;
        $usernameChanged = false;

        // Cek apakah username berubah
        if ($username !== $currentUser['username']) {
            $usernameChanged = true;
        }

        // Jika email berubah, simpan ke pending_email dan kirim email konfirmasi
        if ($email !== $currentUser['email']) {
            $emailChanged = true;
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $dataUser['pending_email'] = $email;
            $dataUser['email_token'] = $token;
            $dataUser['email_token_expires'] = $expires;

            // Kirim email konfirmasi
            $emailService = \Config\Services::email();
            $emailService->setTo($email);
            $emailService->setSubject('Konfirmasi Perubahan Email - Ezzastory');

            $emailBody = view('emails/confirm_email', [
                'token' => $token,
                'base_url' => base_url()
            ]);

            $emailService->setMessage($emailBody);

            if (!$emailService->send()) {
                log_message('error', 'Gagal mengirim email konfirmasi ke: ' . $email);
                return redirect()->back()->with('error', 'Gagal mengirim email konfirmasi. Silakan coba lagi.');
            }
        }

        $passwordChanged = false;

        if (!empty($newPassword)) {
            if (strlen($newPassword) < 6) {
                log_message('error', 'Update profil gagal: Password baru kurang dari 6 karakter untuk user ID: ' . $userId);
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

        // Logout jika username atau password berubah
        if ($passwordChanged || $usernameChanged) {
            log_message('info', 'Username atau password berhasil diperbarui untuk user ID: ' . $userId . '. Sesi dihentikan.');
            session()->destroy();
            return redirect()->to('/login')->with('success', 'Username atau password diperbarui. Silakan login kembali.');
        }

        if ($emailChanged) {
            log_message('info', 'Email konfirmasi dikirim untuk user ID: ' . $userId . ' ke: ' . $email);
            return redirect()->to('/user/profile')->with('success', 'Profil berhasil diperbarui. Silakan cek email Anda untuk mengkonfirmasi perubahan email.');
        }

        log_message('info', 'Profil berhasil diperbarui untuk user ID: ' . $userId);
        return redirect()->to('/user/profile')->with('success', 'Profil berhasil diperbarui.');
    }

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

        // Validasi nomor telepon
        if (!preg_match('/^\d{10,13}$/', $noTelepon)) {
            log_message('error', 'Update profil admin gagal: No Telepon tidak valid untuk user ID: ' . $userId);
            return redirect()->back()->with('error', 'No Telepon harus terdiri dari 10 hingga 13 digit angka.');
        }

        $currentUser = $this->userModel->find($userId);

        // Validasi username: hanya huruf kecil, angka, underscore, maks 30 karakter, tanpa spasi
        $existingUsername = $this->userModel
            ->where('username', $username)
            ->where('id !=', $userId)
            ->first();

        if (!preg_match('/^[a-z0-9_]{1,30}$/', $username)) {
            log_message('error', 'Update profil admin gagal: Username tidak valid untuk user ID: ' . $userId);
            return redirect()->back()->with('error', 'Username hanya boleh mengandung huruf kecil, angka, dan underscore, tanpa spasi, maksimal 30 karakter.');
        }

        if ($existingUsername) {
            log_message('error', 'Update profil admin gagal: Username ' . $username . ' sudah terdaftar.');
            return redirect()->back()->with('error', 'Username yang Anda pilih tidak tersedia. Silakan pilih username lain.');
        }

        // Validasi email
        $existingEmail = $this->userModel
            ->where('email', $email)
            ->where('id !=', $userId)
            ->first();

        if ($existingEmail) {
            log_message('error', 'Update profil admin gagal: Email ' . $email . ' sudah terdaftar.');
            return redirect()->back()->with('error', 'Email yang Anda masukkan sudah terdaftar. Silakan gunakan email lain.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            log_message('error', 'Update profil admin gagal: Format email tidak valid untuk user ID: ' . $userId);
            return redirect()->back()->with('error', 'Format email tidak valid.');
        }

        $dataUser = [
            'username' => $username,
        ];

        $emailChanged = false;
        $usernameChanged = false;

        // Cek apakah username berubah
        if ($username !== $currentUser['username']) {
            $usernameChanged = true;
        }

        // Jika email berubah, simpan ke pending_email dan kirim email konfirmasi
        if ($email !== $currentUser['email']) {
            $emailChanged = true;
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $dataUser['pending_email'] = $email;
            $dataUser['email_token'] = $token;
            $dataUser['email_token_expires'] = $expires;

            // Kirim email konfirmasi
            $emailService = \Config\Services::email();
            $emailService->setTo($email);
            $emailService->setSubject('Konfirmasi Perubahan Email - Ezzastory');

            $emailBody = view('emails/confirm_email', [
                'token' => $token,
                'base_url' => base_url()
            ]);

            $emailService->setMessage($emailBody);

            if (!$emailService->send()) {
                log_message('error', 'Gagal mengirim email konfirmasi ke: ' . $email);
                return redirect()->back()->with('error', 'Gagal mengirim email konfirmasi. Silakan coba lagi.');
            }
        }

        $passwordChanged = false;

        if (!empty($newPassword)) {
            if (strlen($newPassword) < 6) {
                log_message('error', 'Update profil admin gagal: Password baru kurang dari 6 karakter untuk user ID: ' . $userId);
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

        // Logout jika username atau password berubah
        if ($passwordChanged || $usernameChanged) {
            log_message('info', 'Username atau password admin berhasil diperbarui untuk user ID: ' . $userId . '. Sesi dihentikan.');
            session()->destroy();
            return redirect()->to('/login')->with('success', 'Username atau password diperbarui. Silakan login kembali.');
        }

        if ($emailChanged) {
            log_message('info', 'Email konfirmasi dikirim untuk user ID: ' . $userId . ' ke: ' . $email);
            return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diperbarui. Silakan cek email Anda untuk mengkonfirmasi perubahan email.');
        }

        log_message('info', 'Profil admin berhasil diperbarui untuk user ID: ' . $userId);
        return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
