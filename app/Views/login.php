<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #000, #333, #555);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .card {
            width: 100%;
            max-width: 420px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            background: #fff;
        }

        .form-control {
            background: #f5f5f5;
            border: none;
            padding: 10px;
        }

        .form-control:focus {
            background: #eaeaea;
            box-shadow: none;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>

    <h2 class="text-center mb-4 text-white">EZZASTORY</h2>

    <div class="card">
        <h4 class="text-center mb-3">Login</h4>
        <form action="/login" method="post">
            <!-- CSRF Token -->
            <?= csrf_field() ?>

            <!-- Tampilkan pesan error jika ada -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                    required>
            </div>
            <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        <button type="button" class="btn btn-light input-group-text" id="togglePasswordLogin">
            <i class="fas fa-eye-slash text-muted"></i> <!-- Ikon mata tersembunyi -->
        </button>
    </div>
</div>
            <button type="submit" class="btn btn-dark w-100 mt-3">Login</button>
        </form>
        <p class="text-center mt-3">Don't have an account? <a href="/register">Register</a></p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    // Untuk form login
    const togglePasswordLogin = document.querySelector("#togglePasswordLogin");
    const passwordLogin = document.querySelector("#password");

    togglePasswordLogin.addEventListener("click", function () {
        // Toggle type antara password dan text
        const type = passwordLogin.type === "password" ? "text" : "password";
        passwordLogin.type = type;

        // Ganti ikon mata
        this.innerHTML = type === "password" ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
    });
</script>

</html>