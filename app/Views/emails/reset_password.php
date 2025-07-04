<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Ezzastory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
            font-size: 0.9rem;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            background: linear-gradient(135deg, #000, #333, #555);
            border-radius: 12px 12px 0 0;
            margin: -25px -25px 30px -25px;
        }
        .logo-text {
            font-size: 1.6rem;
            font-weight: bold;
            color: #ffffff;
            margin: 0;
        }
        .title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #212529;
            text-align: center;
        }
        .content {
            font-size: 0.85rem;
            margin-bottom: 30px;
            color: #495057;
        }
        .btn-dark {
            display: inline-block;
            padding: 10px 25px;
            background-color: #212529;
            color: #ffffff; /* Teks tombol diubah menjadi putih */
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            text-align: center;
            transition: background-color 0.2s;
        }
        .btn-dark:hover {
            background-color: #343a40;
            color: #ffffff; /* Teks tetap putih saat hover */
        }
        .button-container {
            text-align: center;
            margin: 25px 0;
        }
        .footer {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 25px;
            border-top: 1px solid #e9ecef;
            padding-top: 15px;
            text-align: center;
        }
        .copyright {
            margin-top: 10px;
            font-size: 0.75rem;
            color: #adb5bd;
        }
        .security-note {
            background-color: #f8f9fa;
            padding: 12px;
            border-left: 4px solid #007bff;
            margin: 20px 0;
            border-radius: 4px;
        }
        .security-note p {
            margin: 0;
            font-size: 0.8rem;
            color: #495057;
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 10px;
            }
            .logo-text {
                font-size: 1.5rem;
            }
            .title {
                font-size: 1.1rem;
            }
            .content {
                font-size: 0.8rem;
            }
            .btn-dark {
                padding: 8px 20px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <div class="logo-text">EZZASTORY</div>
        </div>
        <div class="title">Reset Password</div>
        <div class="content">
            <p>Halo,</p>
            <p>Kami menerima permintaan untuk mereset password akun Anda. Jika Anda yang meminta reset password, silakan klik tombol di bawah ini:</p>
            <div class="button-container">
                <a href="<?= $base_url . 'reset-password/' . $token ?>" class="btn-dark">Reset Password Saya</a>
            </div>
            <div class="security-note">
                <p><strong>Catatan:</strong> Link reset password ini hanya berlaku selama 1 jam. Jika Anda tidak meminta reset password, abaikan email ini.</p>
            </div>
        </div>
        <div class="footer">
            <p>Jika Anda tidak meminta reset password, Anda dapat mengabaikan email ini dengan aman. Hanya orang yang memiliki akses ke email Anda yang dapat mereset password akun.</p>
            <div class="copyright">© 2025 Ezzastory. All rights reserved.</div>
        </div>
    </div>
</body>
</html>