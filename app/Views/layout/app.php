<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ezzastory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <style>
        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            height: 80px;
            z-index: 1000;
            background: black;
            transition: background 0.3s ease-in-out;
        }

        .navbar.scrolled {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .navbar-nav {
            gap: 32px;
        }

        .navbar .nav-link {
            color: white;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: #87D5C8;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30' width='30' height='30' fill='white'><path stroke='rgba(255, 255, 255, 1)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/></svg>");
        }

        /* Mengubah background menu dropdown di mobile */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(0, 0, 0, 0.9);
                padding: 20px;
                border-radius: 10px;
            }

            .navbar-nav {
                gap: 10px;
            }
        }

        /* Footer */
        .footer {
            background: #1b1b1b;
            color: white;
            padding: 40px 0;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            color: #87D5C8;
        }

        .contact-info i {
            font-size: 16px;
            margin-right: 10px;
        }

        .contact-info p {
            margin-bottom: 10px;
        }

        .footer h5 {
            font-weight: normal;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="IMG/1.jpg" alt="Brand Logo" class="img-fluid" style="height: 50px;">
            </a>

            <!-- Toggler Button (Mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Profile (Tetap di Kanan) -->
            <div class="dropdown ms-auto order-lg-last">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i> Profile
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                </ul>
            </div>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/beranda">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about-us">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="/portofolio">Portofolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/paket-layanan">Paket Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/reservasi">Reservasi</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Konten -->
    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- Kolom 1: Logo & Deskripsi -->
                <div class="col-md-4 mb-4">
                    <h5>Brand Name</h5>
                    <p class="small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae
                        vestibulum.</p>
                </div>

                <!-- Kolom 2: Navigasi -->
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Portofolio</a></li>
                        <li><a href="#">Reservasi</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak -->
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <div class="contact-info">
                        <p><i class="bi bi-instagram"></i> <a href="#">@brandname</a></p>
                        <p><i class="bi bi-envelope"></i> <a href="mailto:info@brand.com">info@brand.com</a></p>
                        <p><i class="bi bi-telephone"></i> <a href="tel:+62123456789">+62 123 456 789</a></p>
                        <p><i class="bi bi-geo-alt"></i> Jl. Contoh No. 123, Jakarta</p>
                    </div>
                </div>
            </div>

            <!-- Garis -->
            <hr class="my-4 border-light">

            <!-- Copyright -->
            <div class="text-center">
                <p class="mb-0 small">&copy; 2024 Brand Name. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript untuk Navbar Scroll Effect -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var navbar = document.querySelector(".navbar");

            window.addEventListener("scroll", function () {
                if (window.scrollY > 50) {
                    navbar.classList.add("scrolled");
                } else {
                    navbar.classList.remove("scrolled");
                }
            });
        });
    </script>

</body>

</html>