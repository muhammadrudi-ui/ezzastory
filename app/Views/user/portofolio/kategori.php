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
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <?php foreach ($profile_perusahaan as $profile): ?>
            <img src="<?= base_url($profile['background_judul']) ?>" alt="Hero Background" loading="lazy">
            <h1>Portofolio Kategori</h1>
        <?php endforeach; ?>
    </section>

    <!-- Portofolio Category Page -->
    <section class="portofolio">
        <div class="container">
            <h2 class="text-center mb-4"><?= ucwords(str_replace('-', ' ', $jenis_layanan)) ?></h2>
            <div class="row g-4">
                <?php if (!empty($portofolio)): ?>
                    <?php foreach ($portofolio as $item): ?>
                        <div class="col-md-4">
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