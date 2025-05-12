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
            margin-bottom: 20px;
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

        /* Button Kembali */
        .icon-back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 0.75rem;
            border-radius: 999px;
            background-color: #f8f9fa;
            color: #6c757d;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
            text-decoration: none;
        }

        .icon-back-button:hover {
            background-color: #e9ecef;
            color: #343a40;
            transform: translateX(-2px);
        }

        .icon-back-button:active {
            transform: translateX(0);
        }

        /* Responsive: hide text on very small screens */
        @media (max-width: 576px) {
            .icon-back-button {
                border-radius: 50%;
            }

            .icon-back-button span {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <?php foreach ($profile_perusahaan as $profile): ?>
            <img src="<?= base_url($profile['background_judul']) ?>" alt="Hero Background" loading="lazy">
            <h1 class="title-portofolio scroll-animate scale-up">Portofolio Detail</h1>
        <?php endforeach; ?>
    </section>

    <!-- Detail Section -->
    <section class="detail-section">
        <div class="container scroll-animate scale-up">
        <div class="mb-4 scroll-animate slide-right">
            <a href="javascript:history.back()" class="icon-back-button" aria-label="Kembali">
                <i class="bi bi-arrow-left"></i>
                <span class="ms-1 d-none d-sm-inline">Kembali</span>
            </a>
        </div>
            <h2 class="text-center"><?= esc($portofolio['nama_mempelai']) ?></h2>
            <h6 class="text-center"><?= esc($portofolio['jenis_layanan']) ?></h6>
        </div>
    </section>

    <!-- Portofolio Section -->
    <section class="portofolio">
        <div class="container">
            <h2 class="text-center mb-4 scroll-animate scale-up">Hasil</h2>
            <div class="gallery-container scroll-animate fade-in">
                <?php if (!empty($fotos)): ?>
                    <?php foreach ($fotos as $foto): ?>
                        <img src="<?= base_url($foto['nama_file']) ?>" alt="Foto Portofolio">
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted">Belum ada foto portofolio yang ditambahkan.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Call to Action - Reservasi -->
    <section class="cta-section scroll-animate fade-in">
        <div class="container">
            <p class="lead">Siap untuk membuat momen Anda lebih berkesan? Pesan layanan kami sekarang!</p>
            <a href="#" class="btn btn-dark">Reservasi Sekarang</a>
        </div>
    </section>

</body>

<?= $this->endSection() ?>