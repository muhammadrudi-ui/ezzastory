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

        .portofolio-category {
            margin-bottom: 50px;
        }

        .portofolio-category h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        /* Card Styling */
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            width: 100%;
            height: 230px;
            object-fit: cover;
            object-position: center;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
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

        .see-more-btn {
            display: block;
            width: 200px;
            margin: 40px auto 0;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <?php foreach ($profile_perusahaan as $profile): ?>
            <img src="<?= base_url($profile['background_judul']) ?>" alt="Hero Background" loading="lazy">
            <h1>Portofolio</h1>
        <?php endforeach; ?>
    </section>

    <!-- Portofolio Section -->
    <section class="portofolio">
        <div class="container">
            <h2 class="text-center mb-4">Karya-karya Kami</h2>

            <!-- Wedding Category -->
            <div class="portofolio-category mb-5">
                <h3>Wedding</h3>
                <div class="row g-4">
                    <?php if (!empty($wedding)): ?>
                        <?php foreach ($wedding as $item): ?>
                            <div class="col-md-4">
                                <a href="<?= base_url('portofolio-detail/' . $item['id']) ?>" class="text-decoration-none">
                                    <div class="card">
                                        <img src="<?= base_url('uploads/portofolio/' . $item['foto_utama']) ?>"
                                            class="card-img-top" alt="<?= $item['nama_mempelai'] ?>">
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
                <a href="<?= base_url('portofolio-kategori-Wedding') ?>" class="btn btn-dark see-more-btn">See More</a>
            </div>

            <!-- Engagement Category -->
            <div class="portofolio-category mb-5">
                <h3>Engagement</h3>
                <div class="row g-4">
                    <?php if (!empty($engagement)): ?>
                        <?php foreach ($engagement as $item): ?>
                            <div class="col-md-4">
                                <a href="<?= base_url('portofolio-detail/' . $item['id']) ?>" class="text-decoration-none">
                                    <div class="card">
                                        <img src="<?= base_url('uploads/portofolio/' . $item['foto_utama']) ?>"
                                            class="card-img-top" alt="<?= $item['nama_mempelai'] ?>">
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
                <a href="<?= base_url('portofolio-kategori-engagement') ?>" class="btn btn-dark see-more-btn">See
                    More</a>
            </div>

            <!-- Pre-Wedding Category -->
            <div class="portofolio-category mb-5">
                <h3>Pre-Wedding</h3>
                <div class="row g-4">
                    <?php if (!empty($prewedding)): ?>
                        <?php foreach ($prewedding as $item): ?>
                            <div class="col-md-4">
                                <a href="<?= base_url('portofolio-detail/' . $item['id']) ?>" class="text-decoration-none">
                                    <div class="card">
                                        <img src="<?= base_url('uploads/portofolio/' . $item['foto_utama']) ?>"
                                            class="card-img-top" alt="<?= $item['nama_mempelai'] ?>">
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
                <a href="<?= base_url('portofolio-kategori-Pre-Wedding') ?>" class="btn btn-dark see-more-btn">See
                    More</a>
            </div>

            <!-- Wisuda Category -->
            <div class="portofolio-category mb-5">
                <h3>Wisuda</h3>
                <div class="row g-4">
                    <?php if (!empty($wisuda)): ?>
                        <?php foreach ($wisuda as $item): ?>
                            <div class="col-md-4">
                                <a href="<?= base_url('portofolio-detail/' . $item['id']) ?>" class="text-decoration-none">
                                    <div class="card">
                                        <img src="<?= base_url('uploads/portofolio/' . $item['foto_utama']) ?>"
                                            class="card-img-top" alt="<?= $item['nama_mempelai'] ?>">
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
                <a href="<?= base_url('portofolio-kategori-wisuda') ?>" class="btn btn-dark see-more-btn">See
                    More</a>
            </div>

            <!-- Event Lainnya Category -->
            <div class="portofolio-category mb-5">
                <h3>Event Lainnya</h3>
                <div class="row g-4">
                    <?php if (!empty($eventlainnya)): ?>
                        <?php foreach ($eventlainnya as $item): ?>
                            <div class="col-md-4">
                                <a href="<?= base_url('portofolio-detail/' . $item['id']) ?>" class="text-decoration-none">
                                    <div class="card">
                                        <img src="<?= base_url('uploads/portofolio/' . $item['foto_utama']) ?>"
                                            class="card-img-top" alt="<?= $item['nama_mempelai'] ?>">
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
                <a href="<?= base_url('portofolio-kategori-event-lainnya') ?>" class="btn btn-dark see-more-btn">See
                    More</a>
            </div>
        </div>
    </section>

</body>

<?= $this->endSection() ?>