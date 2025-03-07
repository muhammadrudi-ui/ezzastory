<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<head>
    <style>
        /* Slider */
        .carousel-item img {
            height: 94vh;
            object-fit: cover;
        }

        /* Layanan */
        .services {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .service-item {
            text-align: center;
        }

        .service-item i {
            font-size: 3rem;
            color: #000;
        }

        .service-item h5 {
            font-size: 16px;
            margin-top: 15px;
        }

        .service-item p {
            font-size: 16px;
            color: #6c757d;
        }

        /* About Us */
        .about-us {
            padding: 120px 0;
        }

        .about-us-title {
            font-size: 22px;
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
            text-align: center;
        }

        .about-us-description {
            font-size: 16px;
            color: #6c757d;
            line-height: 1.6;
            text-align: justify;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 12;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .about-us a {
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .about-us a:hover {
            background-color: dark;
            color: white;
        }

        /* Portofolio */
        .portofolio h2 {
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }

        .portofolio .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .portofolio .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .portofolio .card-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .portofolio .card-text {
            font-size: 14px;
            color: #6c757d;
        }

        /* CTA */
        .cta-section {
            text-align: center;
            padding: 120px 0;
        }

        .cta-section .lead {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .cta-section a {
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .cta-section a:hover {
            background-color: dark;
            color: white;
        }
    </style>
</head>

<body>
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
                        setiap proyek yang kami tangani. Dari pemotretan untuk acara pribadi hingga pembuatan video
                        perusahaan dan proyek editing, kami siap membantu Anda mencapai visi kreatif Anda dengan
                        pendekatan profesional
                        yang unik
                    </p>
                    <a href="#" class="btn btn-dark">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Portofolio -->
    <section class="portofolio">
        <div class="container">
            <h2 class="text-center mb-4">Portofolio</h2>
            <div class="row g-4">
                <!-- Card Portofolio 1 -->
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/3.jpg" class="card-img-top" alt="Portofolio 1">
                            <div class="card-body text-center">
                                <h5 class="card-title">John & Jane</h5>
                                <p class="card-text">Wedding</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Card Portofolio 2 -->
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/2.jpg" class="card-img-top" alt="Portofolio 2">
                            <div class="card-body text-center">
                                <h5 class="card-title">Michael & Sarah</h5>
                                <p class="card-text">Pre-Wedding</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Card Portofolio 3 -->
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/1.jpg" class="card-img-top" alt="Portofolio 3">
                            <div class="card-body text-center">
                                <h5 class="card-title">David & Emily</h5>
                                <p class="card-text">Wedding</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Card Portofolio 4 -->
                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/1.jpg" class="card-img-top" alt="Portofolio 3">
                            <div class="card-body text-center">
                                <h5 class="card-title">David & Emily</h5>
                                <p class="card-text">Wedding</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action - Reservasi -->
    <section class="cta-section">
        <div class="container">
            <p class="lead">Siap untuk membuat momen Anda lebih berkesan? Pesan layanan kami sekarang!</p>
            <a href="#" class="btn btn-dark">Reservasi Sekarang</a>
        </div>
    </section>

</body>

<?= $this->endSection() ?>