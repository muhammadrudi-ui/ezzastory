<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ezzastory</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <style>
        /* Navbar */
        body {
            font-size: 14px;
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            height: 80px;
            z-index: 1000;
            background: black;
            transition: background 0.3s ease-in-out;
            padding: 0.5rem 1rem;
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
            padding: 0.5rem 1rem;
        }

        .navbar .nav-link:hover {
            color:rgb(117, 117, 117);
        }

         /* Navbar Container */
         .navbar-container {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        /* Logo */
        .navbar-brand {
            padding: 0;
            margin-right: 0;
            display: flex;
            align-items: center;
            height: 40px; /* Fixed height for logo container */
        }

        .navbar-brand img {
            height: 100%;
            width: auto;
            max-width: 120px;
            object-fit: contain;
        }

        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
            margin: 0 0.5rem;
            order: 2; /* Posisi di tengah */
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30' width='30' height='30' fill='white'><path stroke='rgba(255, 255, 255, 1)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/></svg>");
        }

        /* Profile Button */
        .profile-btn {
            padding: 0.25rem 0.5rem;
            font-size: 14px;
            margin-left: 0.5rem;
            order: 3; /* Posisi paling kanan */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
        }

         /* Mobile Menu */
         @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(0, 0, 0, 0.95);
                padding: 1rem;
                margin-top: 0.5rem;
                border-radius: 0 0 8px 8px;
                position: absolute;
                left: 0;
                right: 0;
                top: 100%;
            }

            .navbar-nav {
                gap: 0;
            }

            .nav-item {
                padding: 0.5rem 0;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }

            .nav-item:last-child {
                border-bottom: none;
            }

            .navbar-brand img {
                max-height: 30px; /* Ukuran lebih kecil untuk mobile */
            }
        }

        /* Desktop Menu */
        @media (min-width: 992px) {
            .navbar-container {
                flex-wrap: nowrap;
            }
            
            .navbar-collapse {
                order: 2;
                flex-grow: 1;
                justify-content: center;
            }
            
            .navbar-toggler {
                display: none;
            }
            
            .dropdown-profile {
                order: 3;
                margin-left: auto;
            }
            
            .navbar-brand {
                height: 40px;
            }
            
            .navbar-brand img {
                max-height: 28px;
            }
        }

        /* WhatsApp Icon */
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50%;
            text-align: center;
            font-size: 24px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
            color: #FFF;
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
            color:rgb(117, 117, 117);
        }

        .footer-description {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .contact-info i {
            font-size: 14px;
            margin-right: 10px;
        }

        .contact-info p {
            margin-bottom: 10px;
        }

        .footer h5 {
            font-weight: normal;
        }

         /* Animasi Scroll */
         .scroll-animate {
            opacity: 0;
            transition: all 0.6s ease-out;
        }

        .scroll-animate.animate {
            opacity: 1;
        }

        /* Animasi Fade In */
        .fade-in {
            transform: translateY(20px);
        }

        .fade-in.animate {
            transform: translateY(0);
        }

        /* Animasi Slide Kiri */
        .slide-left {
            transform: translateX(-50px);
        }

        .slide-left.animate {
            transform: translateX(0);
        }

        /* Animasi Slide Kanan */
        .slide-right {
            transform: translateX(50px);
        }

        .slide-right.animate {
            transform: translateX(0);
        }

        /* Animasi Scale Up */
        .scale-up {
            transform: scale(0.95);
        }

        .scale-up.animate {
            transform: scale(1);
        }
    </style>
</head>

<body>
    <?php foreach ($profile_perusahaan as $profile): ?>
        <nav class="navbar navbar-expand-lg">
            <div class="container px-0 px-sm-2">
            <div class="navbar-container">
                <!-- Logo -->
                <a class="navbar-brand" href="<?= base_url('/') ?>">
                    <img src="<?= base_url($profile['logo']) ?>" alt="Brand Logo" class="img-fluid">
                </a>

                <!-- Toggler Button (Mobile) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Button Login -->
                <div class="dropdown dropdown-profile ms-auto ms-lg-0">
                    <a href="<?= base_url('/login') ?>" class="btn btn-outline-light">
                        <i class="bi bi-person-circle"></i> Login
                    </a>
                </div>

                <!-- Navbar -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto me-auto">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('visitor/tentang-kami') ?>">Tentang
                                Kami</a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="<?= base_url('visitor/portofolio/index') ?>">Portofolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="confirmRedirect('<?= base_url('login') ?>')">Paket
                                Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="confirmRedirect('<?= base_url('login') ?>')">Reservasi</a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </nav>

        <!-- Konten -->
        <?= $this->renderSection('content') ?>

        <!-- Footer -->
        <footer class="footer scroll-animate fade-in">
            <div class="container">
                <div class="row text-center text-md-start">
                    <!-- Kolom 1: Logo & Deskripsi -->
                    <div class="col-md-4 mb-4 scroll-animate scale-up">
                        <h5><?= ($profile['nama_perusahaan']) ?></h5>
                        <p class="footer-description"><?= esc(strip_tags($profile['deskripsi'])) ?>.</p>
                    </div>

                    <!-- Kolom 2: Navigasi -->
                    <div class="col-md-4 mb-4 scroll-animate scale-up">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url('') ?>">Beranda</a></li>
                            <li><a href="<?= base_url('visitor/tentang-kami') ?>">Tentang Kami</a></li>
                            <li><a href="<?= base_url('visitor/portofolio/index') ?>">Portofolio</a></li>
                            <li><a href="#" onclick="confirmRedirect('<?= base_url('login') ?>')">Paket
                                    Layanan</a></li>
                            <li> <a class="nav-link" href="#"
                                    onclick="confirmRedirect('<?= base_url('login') ?>')">Reservasi</a></li>
                        </ul>
                    </div>

                    <!-- Kolom 3: Kontak -->
                    <div class="col-md-4 scroll-animate scale-up">
                        <h5>Contact Us</h5>
                        <div class="contact-info">
                            <p><i class="bi bi-instagram"></i> <a
                                    href="https://www.instagram.com/<?= ($profile['instagram']) ?>" target="_blank">
                                    <?= ($profile['instagram']) ?>
                                </a></p>
                            <p><i class="bi bi-envelope"></i> <a href="mailto:<?= esc($profile['email']) ?>">
                                    <?= esc($profile['email']) ?>
                                </a>
                            </p>
                            <p><i class="bi bi-telephone"></i> <a
                                    href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $profile['no_telp']) ?>"
                                    target="_blank">
                                    <?= esc($profile['no_telp']) ?>
                                </a>
                            </p>
                            <p><i class="bi bi-geo-alt"></i><?= ($profile['alamat']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Garis -->
                <hr class="my-4 border-light">

                <!-- Copyright -->
                <div class="text-center">
                    <p class="mb-0 small">&copy; 2025 <?= ($profile['nama_perusahaan']) ?>. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
    <?php endforeach; ?>

<!-- WhatsApp -->
    <?php foreach ($profile_perusahaan as $profile): ?>
        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $profile['no_telp']) ?>" 
       class="whatsapp-float" 
       target="_blank"
       title="Hubungi Kami via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
<?php endforeach; ?>

    <!-- Scroll Navbar -->
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

    <!-- SweetAlert to Login -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmRedirect(redirectUrl) {
            Swal.fire({
                title: "Login Diperlukan",
                text: "Anda harus login terlebih dahulu untuk mengakses halaman ini.",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Login Sekarang",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = redirectUrl;
                }
            });
        }
    </script>

    <!-- Scoll Animation -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk memeriksa elemen yang terlihat di viewport
        function checkScroll() {
            const elements = document.querySelectorAll('.scroll-animate');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                // Jika elemen masuk ke viewport (dengan offset 100px)
                if (elementPosition < windowHeight - 100) {
                    element.classList.add('animate');
                }
            });
        }
        
        // Jalankan saat pertama kali load
        checkScroll();
        
        // Jalankan saat scrolling
        window.addEventListener('scroll', checkScroll);
    });
    </script>

</body>

</html>