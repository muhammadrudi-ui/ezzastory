<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar dan Slider</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Navbar transparan tanpa latar belakang */
        .navbar {
            position: fixed;
            top: 10px;
            width: 100%;
            z-index: 1000;
            background: none;
            backdrop-filter: none;
            padding: 20px 0;
        }

        .navbar-nav {
            gap: 42px;
            /* Jarak antar teks */
        }

        .navbar .nav-link {
            color: white;
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            transition: color 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: #87D5C8;
            /* Warna teks saat hover */
        }

        /* Slider penuh layar */
        .carousel-item img {
            height: 94vh;
            object-fit: cover;
        }

        /* Informasi layanan */
        .services {
            padding: 80px 0;
            background-color: #f8f9fa;
            /* Warna latar belakang */
        }

        .service-item {
            text-align: center;
        }

        .service-item i {
            font-size: 3rem;
            /* Ukuran ikon */
            color: #000;
            /* Warna ikon */
        }

        .service-item h5 {
            font-size: 16px;
            /* Ukuran teks judul layanan */
            font-family: 'Montserrat', sans-serif;
            /* Font Montserrat */
            margin-top: 15px;
        }

        .service-item p {
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            color: #6c757d;
            /* Warna teks deskripsi */
        }

        .about-us {
            padding: 88px 0;
        }

        /* Styling untuk bagian About Us */
        .about-us-title {
            font-family: 'Montserrat', sans-serif;
            /* Font untuk judul */
            font-size: 18px;
            /* Ukuran font judul */
            color: #333;
            /* Warna teks judul */
            font-weight: 600;
            /* Bobot font judul */
            margin-bottom: 15px;
            text-align: center;
        }

        .about-us-description {
            font-family: 'Montserrat', sans-serif;
            /* Font untuk deskripsi */
            font-size: 14px;
            /* Ukuran font deskripsi */
            color: #6c757d;
            /* Warna teks deskripsi */
            line-height: 1.6;
            /* Jarak antar baris untuk kenyamanan membaca */
            text-align: justify;
            /* Membuat teks rata kiri-kanan */
            margin-bottom: 15px;
            /* Jarak bawah untuk setiap paragraf */
        }

        /* Tombol Lihat Selengkapnya */
        .about-us a {
            font-family: 'Montserrat', sans-serif;
            /* Font untuk tombol */
            font-size: 14px;
            /* Ukuran font tombol */
            font-weight: 500;
            /* Bobot font tombol */
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Transisi untuk hover */
        }

        .about-us a:hover {
            background-color: #87D5C8;
            /* Warna latar belakang saat hover */
            color: white;
            /* Warna teks saat hover */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reservasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Slider -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/IMG/1.jpg" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="/IMG/3.jpg" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="/IMG/2.jpg" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Informasi Layanan -->
    <section class="services">
        <div class="container">
            <div class="row">
                <!-- Layanan Fotografi -->
                <div class="col-md-4">
                    <div class="service-item">
                        <i class="bi bi-camera"></i>
                        <h5>Fotografi</h5>
                        <p>Abadikan setiap momen berharga dengan layanan fotografi profesional.</p>
                    </div>
                </div>
                <!-- Layanan Videografi -->
                <div class="col-md-4">
                    <div class="service-item">
                        <i class="bi bi-camera-video"></i>
                        <h5>Videografi</h5>
                        <p>Ciptakan video berkualitas tinggi untuk berbagai kebutuhan Anda.</p>
                    </div>
                </div>
                <!-- Layanan Editing -->
                <div class="col-md-4">
                    <div class="service-item">
                        <i class="bi bi-pencil"></i>
                        <h5>Editing</h5>
                        <p>Kami menawarkan editing foto dan video untuk hasil yang sempurna.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Perusahaan (About Us) -->
    <section class="about-us">
        <div class="container">
            <div class="row align-items-center">
                <!-- Foto Perusahaan -->
                <div class="col-md-6">
                    <img src="/IMG/1.jpg" class="img-fluid" alt="Foto Perusahaan">
                </div>
                <!-- Deskripsi Perusahaan -->
                <div class="col-md-6">
                    <h2 class="about-us-title">About Us</h2>
                    <p class="about-us-description">
                        Kami adalah perusahaan yang bergerak di bidang layanan kreatif, menawarkan solusi
                        inovatif dalam fotografi, videografi, dan editing. Dengan pengalaman bertahun-tahun,
                        kami berkomitmen untuk memberikan hasil yang memuaskan dan berkualitas tinggi untuk
                        setiap proyek yang kami tangani.
                    </p>
                    <p class="about-us-description">
                        Dari pemotretan untuk acara pribadi hingga pembuatan video perusahaan dan proyek
                        editing, kami siap membantu Anda mencapai visi kreatif Anda dengan pendekatan profesional
                        yang unik.
                    </p>
                    <a href="#" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>



    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>