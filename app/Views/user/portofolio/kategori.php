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

        /* Portofolio*/
        .portofolio {
            padding: 60px 0;
        }

        /* Card Styling */
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-img-top {
            width: 100%;
            height: 230px;
            object-fit: cover;
            object-position: center;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .card-text {
            font-size: 14px;
            color: #6c757d;
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
            <h1 class="title-portofolio scroll-animate scale-up">Portofolio Kategori</h1>
        <?php endforeach; ?>
    </section>

    <!-- Portofolio Category Page -->
    <section class="portofolio">
        <div class="container">
        <div class="mb-5 scroll-animate slide-right">
            <a href="javascript:history.back()" class="icon-back-button" aria-label="Kembali">
                <i class="bi bi-arrow-left"></i>
                <span class="ms-1 d-none d-sm-inline">Kembali</span>
            </a>
        </div>
            <h2 class="text-center mb-4 scroll-animate scale-up"><?= ucwords(str_replace('-', ' ', $jenis_layanan)) ?></h2>
            <div class="row g-4">
                <?php if (!empty($portofolio)): ?>
                    <?php foreach ($portofolio as $item): ?>
                        <div class="col-md-4 scroll-animate fade-in">
                            <a href="<?= base_url('user/portofolio/detail/' . $item['id']) ?>" class="text-decoration-none">
                                <div class="card">
                                    <img src="<?= base_url($item['foto_utama']) ?>" class="card-img-top"
                                        alt="<?= $item['nama_mempelai'] ?>">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= esc($item['nama_mempelai']) ?></h5>
                                        <p class="card-text"><?= esc($item['jenis_layanan']) ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">Data portofolio belum tersedia untuk kategori ini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>


</body>

<?= $this->endSection() ?>