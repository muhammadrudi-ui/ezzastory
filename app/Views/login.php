<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login Ezzastory</title>
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
            overflow-y: auto;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            margin: auto;
        }

        .card {
            width: 100%;
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

        @media (max-width: 576px) {
            body {
                padding: 15px;
                display: block;
                height: auto;
                min-height: 100vh;
            }
            
            .card {
                padding: 25px 20px;
            }
            
            h2.text-center {
                margin: 20px 0;
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2 class="text-center mb-4 text-white">EZZASTORY</h2>

        <div class="card">
            <h4 class="text-center mb-4">Masuk ke Akun Anda</h4>
            <form action="/login" method="post">
                <!-- CSRF Token -->
                <?= csrf_field() ?>

                <!-- Tampilkan pesan error jika ada -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <label for="username" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan nama pengguna Anda" required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi Anda" required>
                        <button type="button" class="btn btn-light input-group-text" id="togglePasswordLogin">
                            <i class="fas fa-eye-slash text-muted"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-dark w-100 py-2 mt-2">Masuk</button>
            </form>
            <p class="text-center mt-4">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar disini</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePasswordLogin = document.querySelector("#togglePasswordLogin");
        const passwordLogin = document.querySelector("#password");

        togglePasswordLogin.addEventListener("click", function () {
            const type = passwordLogin.type === "password" ? "text" : "password";
            passwordLogin.type = type;

            this.innerHTML = type === "password" ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
        });
        
        // Prevent zooming on mobile devices
        document.addEventListener('touchmove', function(event) {
            if (event.scale !== 1) { event.preventDefault(); }
        }, { passive: false });
    </script>
</body>
</html>