<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ezzastory</title>
    <link rel="icon"href="<?= base_url('uploads/logo_tab/logo.png') ?>" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #000, #333, #555);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #333;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 500px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
            background: #fff;
            margin: 20px 0;
        }

        .form-control {
            background: #f5f5f5;
            border: none;
            padding: 12px 15px;
            height: 45px;
            border-radius: 8px;
        }

        .form-control:focus {
            background: #eaeaea;
            box-shadow: none;
        }

        .btn {
            padding: 10px;
            border-radius: 8px;
            font-weight: 500;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            color: #0056b3;
        }

        .input-group-text {
            border-radius: 0 8px 8px 0 !important;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #000;
            border-color: #000;
        }

        .form-check-label {
            font-size: 0.95rem;
        }

        .form-check-label a {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h2 class="text-center mb-4 text-white">EZZASTORY</h2>

    <div class="card">
        <h4 class="text-center mb-4">Buat Akun Baru</h4>
        <form action="/register" method="post">
            <?= csrf_field() ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="mb-4">
                <label for="regUsername" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="regUsername" name="username" 
                    placeholder="Pilih nama pengguna (maks 30 karakter, tanpa spasi)" 
                    value="<?= old('username') ?>" 
                    pattern="^\S{1,30}$" 
                    title="Username maksimal 30 karakter dan tidak boleh mengandung spasi"
                    required>
                <small class="text-muted">Contoh: johndoe_123</small>
            </div>
            
            <div class="mb-4">
                <label for="regEmail" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="regEmail" name="email" 
                    placeholder="Masukkan alamat email Anda" 
                    value="<?= old('email') ?>" required>
            </div>
            
            <div class="mb-4">
                <label for="regPassword" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="regPassword" name="password" 
                        placeholder="Buat kata sandi yang kuat" required>
                    <button type="button" class="btn btn-light input-group-text" id="togglePasswordRegister">
                        <i class="fas fa-eye-slash text-muted"></i>
                    </button>
                </div>
                <small class="text-muted">Minimal 8 karakter dengan kombinasi huruf dan angka</small>
            </div>

            <div class="mb-4">
                <label for="confirmPassword" class="form-label">Konfirmasi Kata Sandi</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" 
                        placeholder="Ketik ulang kata sandi Anda" required>
                    <button type="button" class="btn btn-light input-group-text" id="toggleConfirmPassword">
                        <i class="fas fa-eye-slash text-muted"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="termsCheck" name="terms" required>
                <label class="form-check-label" for="termsCheck">
                    Saya menyetujui <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Syarat & Ketentuan</a> Ezzastory
                </label>
            </div>

            <button type="submit" class="btn btn-dark w-100 py-2 mt-2">Daftar Sekarang</button>
        </form>

        <p class="text-center mt-4">Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk disini</a></p>
    </div>

    <!-- Modal Terms & Conditions -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Syarat & Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Persetujuan Publikasi Konten</h6>
                    <ol>
                        <li>Dengan mendaftar di Ezzastory, Anda menyetujui bahwa foto-foto hasil pemotretan dapat digunakan sebagai portofolio di website dan media sosial Ezzastory.</li>
                        <li>Informasi dasar pemesanan (nama mempelai, jenis layanan, tanggal acara) mungkin akan ditampilkan dan hasil foto sebagai portofolio Ezzastory.</li>
                        <li>Ezzastory tidak akan menampilkan informasi pribadi seperti nomor telepon, alamat, atau detail pembayaran.</li>
                        <li>Jika Anda ingin foto tertentu tidak dipublikasikan, Anda dapat mengajukan permohonan via email setelah pemotretan.</li>
                        <li>Ezzastory berhak menggunakan konten untuk keperluan promosi tanpa kompensasi finansial tambahan.</li>
                    </ol>
                    
                    <h6>Kebijakan Privasi</h6>
                    <ol>
                        <li>Data pribadi Anda akan dilindungi dan tidak akan dibagikan ke pihak ketiga tanpa persetujuan.</li>
                        <li>Dengan default, Ezzastory akan mempublikasikan foto secara utuh (tanpa penyamaran) sebagai portofolio. Jika ingin wajah/identitas di-blur, harap ajukan permintaan via email setelah pemotretan.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Saya Mengerti</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Password Visibility
        const togglePasswordRegister = document.querySelector("#togglePasswordRegister");
        const passwordRegister = document.querySelector("#regPassword");

        togglePasswordRegister.addEventListener("click", function () {
            const type = passwordRegister.type === "password" ? "text" : "password";
            passwordRegister.type = type;
            this.innerHTML = type === "password" ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
        });

        const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
        const confirmPassword = document.querySelector("#confirmPassword");

        toggleConfirmPassword.addEventListener("click", function () {
            const type = confirmPassword.type === "password" ? "text" : "password";
            confirmPassword.type = type;
            this.innerHTML = type === "password" ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
        });

        // Validasi Checkbox Terms & Conditions
        document.querySelector('form').addEventListener('submit', function(e) {
            const termsCheck = document.getElementById('termsCheck');
            if (!termsCheck.checked) {
                e.preventDefault();
                alert('Anda harus menyetujui Syarat & Ketentuan untuk melanjutkan registrasi.');
                termsCheck.focus();
            }
        });
    </script>
</body>
</html>