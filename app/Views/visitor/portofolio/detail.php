<?= $this->extend('layout/app-visitor') ?>

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
        <?php foreach ($profile_perusahaan as $profile): ?>
            <img src="<?= base_url($profile['background_judul']) ?>" alt="Hero Background" loading="lazy">
            <h1>Portofolio Detail</h1>
        <?php endforeach; ?>
    </section>

    <!-- Detail Section -->
    <section class="detail-section">
        <div class="container">
            <h2 class="text-center"><?= esc($portofolio['nama_mempelai']) ?></h2>
            <h6 class="text-center"><?= esc($portofolio['jenis_layanan']) ?></h6>
        </div>
    </section>

    <!-- Portofolio Section -->
    <section class="portofolio">
        <div class="container">
            <h2 class="text-center mb-4">Hasil</h2>
            <div class="gallery-container">
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
    <section class="cta-section">
        <div class="container">
            <p class="lead">Siap untuk membuat momen Anda lebih berkesan? Pesan layanan kami sekarang!</p>
            <a href="#" class="btn btn-dark">Reservasi Sekarang</a>
        </div>
    </section>

</body>

<?= $this->endSection() ?>