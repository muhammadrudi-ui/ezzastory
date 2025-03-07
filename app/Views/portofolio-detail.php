<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<head>
    <style>
        /* Hero Section */
        .hero-section {
            position: relative;
            height: 400px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-bottom: 60px;
        }

        .hero-section img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .hero-section h1 {
            font-size: 32px;
            font-weight: 700;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        /* Detail Section */
        .detail-section {
            padding: 40px 0;
            background-color: #f8f9fa;
        }

        .detail-section h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .detail-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .detail-card p {
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .detail-card {
                text-align: center;
                margin-bottom: 20px;
            }

            .row {
                margin-bottom: 20px;
            }
        }

        /* Portofolio */
        .portofolio {
            padding: 60px 0;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .gallery-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
            aspect-ratio: 5/4;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .gallery-container {
                grid-template-columns: 1fr;
            }
        }

        /* CTA */
        .cta-section {
            text-align: center;
            padding: 100px 0;
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
    <!-- Hero Section -->
    <section class="hero-section">
        <img src="/IMG/1.jpg" alt="Hero Background">
        <h1>Portofolio Detail</h1>
    </section>

    <!-- Detail Section -->
    <section class="detail-section">
        <div class="container">
            <h2 class="text-center">Jhon & Ratna</h2>
            <div class="row justify-content-center mt-4 gy-4">
                <!-- Kolom Kiri -->
                <div class="col-md-5">
                    <div class="detail-card">
                        <p><strong>Harga:</strong> Rp 10.000.000</p>
                        <p><strong>Layanan:</strong> Photography & Videography</p>
                        <p><strong>Paket:</strong> Premium Wedding Package</p>
                    </div>
                </div>
                <!-- Kolom Kanan -->
                <div class="col-md-5">
                    <div class="detail-card">
                        <p><strong>Durasi:</strong> 10 Jam Pemotretan</p>
                        <p><strong>Include:</strong> Album Eksklusif, 100 Edited Photos, 2-Minute Cinematic Video</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portofolio Section -->
    <section class="portofolio">
        <div class="container">
            <h2 class="text-center mb-4">Hasil</h2>
            <div class="gallery-container">
                <img src="/IMG/1.jpg" alt="Wedding 1">
                <img src="/IMG/2.jpg" alt="Wedding 2">
                <img src="/IMG/3.jpg" alt="Wedding 3">
                <img src="/IMG/3.jpg" alt="Wedding 4">
                <img src="/IMG/2.jpg" alt="Wedding 5">
                <img src="/IMG/1.jpg" alt="Wedding 6">
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