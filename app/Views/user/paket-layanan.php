<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

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

    /* Paket Layanan */
    .paket-layanan {
        padding: 15px 0;
    }

    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
        width: 100%;
        height: 230px;
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .modal-img {
        width: 100%;
        max-height: 280px;
        object-fit: cover;
        border-radius: 8px;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-text {
        font-size: 14px;
        color: #6c757d;
        min-height: 40px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-price {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    @media (max-width: 768px) {
        .hero-section {
            height: 300px;
        }

        .hero-section h1 {
            font-size: 24px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <?php foreach ($profile_perusahaan as $profile): ?>
        <img src="<?= base_url($profile['background_judul']) ?>" alt="Hero Background" loading="lazy">
        <h1 class="title-paket-layanan scroll-animate scale-up">Paket Layanan</h1>
    <?php endforeach; ?>
</section>

<!-- Paket Layanan Section -->
<section class="paket-layanan">
    <div class="container mb-5">
        <div class="row g-4">
            <?php foreach ($paket_layanan as $paket): ?>
                <div class="col-md-4 col-sm-6 scroll-animate fade-in">
                    <div class="card">
                        <img src="<?= base_url($paket['foto']) ?>" class="card-img-top" alt="<?= $paket['nama'] ?>"
                            loading="lazy">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= esc($paket['nama']) ?></h5>
                           <p class="card-tittle"><?= esc($paket['jenis_layanan']) ?></p>
                            <p class="card-text"><?= esc($paket['benefit']) ?></p>
                            <p class="card-price">Rp <?= number_format($paket['harga'], 0, ',', '.') ?></p>
                            <div class="btn-group">
                                <button class="btn btn-outline-dark" data-bs-toggle="modal"
                                    data-bs-target="#modalPaket<?= $paket['id'] ?>">Lihat Selengkapnya</button>
                                    <a href="<?= base_url('user/reservasi?paket_id=' . $paket['id']) ?>" class="btn btn-dark">Reservasi</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalPaket<?= $paket['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?= esc($paket['nama']) ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="<?= base_url($paket['foto']) ?>" class="modal-img img-fluid rounded mb-3"
                                    alt="<?= $paket['nama'] ?>" loading="lazy">
                                <p><?= esc($paket['benefit']) ?></p>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <a href="<?= base_url('user/reservasi?paket_id=' . $paket['id']) ?>" class="btn btn-dark">Reservasi</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>