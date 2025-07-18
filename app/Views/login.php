<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login Ezzastory</title>
    <link rel="icon" href="<?= base_url('Uploads/logo_tab/logo.png') ?>" type="image/png">
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
            font-size: 0.9rem;
            overflow-y: auto;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
            margin: auto;
        }
        .card {
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
            background: #fff;
            margin: 20px 0;
        }
        .form-control {
            background: #f5f5f5;
            border: none;
            padding: 10px 12px;
            height: 40px;
            border-radius: 8px;
            font-size: 1rem;
        }
        .form-control:focus {
            background: #eaeaea;
            box-shadow: none;
            border-color: #007bff;
        }
        .btn {
            padding: 8px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
        }
        .text-link {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .text-link:hover {
            color: #0056b3;
        }
        .input-group-text {
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            background: #f5f5f5;
        }
        .alert {
            border-radius: 8px;
            font-size: 1rem;
        }
        h2.text-center {
            font-size: 2rem;
            color: #fff;
        }
        h4.text-center {
            font-size: 1.5rem;
        }
        @media (max-width: 576px) {
            body {
                padding: 15px;
                display: block;
                height: auto;
                min-height: 100vh;
            }
            .card {
                padding: 20px;
            }
            h2.text-center {
                margin: 20px 0;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center mb-4">EZZASTORY</h2>
        <div class="card">
            <h4 class="text-center mb-4">Masuk ke Akun Anda</h4>
            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= esc(session()->getFlashdata('error')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= esc(session()->getFlashdata('success')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="mb-4">
                    <label for="identifier" class="form-label">Username atau Email</label>
                    <input type="text" class="form-control" id="identifier" name="identifier" placeholder="Masukkan username atau email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
                        <button type="button" class="btn input-group-text" id="togglePasswordLogin">
                            <i class="fas fa-eye-slash text-muted"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-4 text-end">
                    <a class="text-link" href="<?= base_url('forgot-password') ?>">Lupa Kata Sandi?</a>
                </div>
                <button type="submit" class="btn btn-dark w-100 py-2 mt-2">Masuk</button>
            </form>
            <p class="text-center mt-4">Belum punya akun? <a class="text-link" href="<?= base_url('register') ?>">Daftar disini</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePasswordLogin = document.querySelector("#togglePasswordLogin");
        const passwordLogin = document.querySelector("#password");

        togglePasswordLogin.addEventListener("click", function () {
            const type = passwordLogin.type === "password" ? "text" : "password";
            passwordLogin.type = type;
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        document.addEventListener('touchmove', function(event) {
            if (event.scale !== 1) { event.preventDefault(); }
        }, { passive: false });
    </script>
</body>
</html>