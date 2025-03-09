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

    /* Card Styling */
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

    .card-body {
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
    <img src="/IMG/1.jpg" alt="Hero Background">
    <h1>Paket Layanan</h1>
</section>

<!-- Paket Layanan Section -->
<section class="paket-layanan">
    <div class="container mb-5">
        <div class="row g-4">

            <!-- Card 1 -->
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="/IMG/1.jpg" class="card-img-top" alt="Paket Wedding 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Paket Wedding 1</h5>
                        <p class="card-text">Beautiful wedding moments captured elegantly.</p>
                        <p class="card-price">Rp 5.000.000</p>
                        <div class="btn-group">
                            <button class="btn btn-outline-dark" data-bs-toggle="modal"
                                data-bs-target="#modalPaket1">Baca Selengkapnya</button>
                            <a href="#" class="btn btn-dark">Reservasi</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="/IMG/2.jpg" class="card-img-top" alt="Paket Wedding 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Paket Wedding 2</h5>
                        <p class="card-text">Exclusive wedding coverage with premium service and special offers.</p>
                        <p class="card-price">Rp 7.500.000</p>
                        <div class="btn-group">
                            <button class="btn btn-outline-dark" data-bs-toggle="modal"
                                data-bs-target="#modalPaket2">Baca Selengkapnya</button>
                            <a href="#" class="btn btn-dark">Reservasi</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <img src="/IMG/3.jpg" class="card-img-top" alt="Paket Wedding 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Paket Wedding 3</h5>
                        <p class="card-text">Full wedding documentary and cinematic video for unforgettable moments.</p>
                        <p class="card-price">Rp 10.000.000</p>
                        <div class="btn-group">
                            <button class="btn btn-outline-dark" data-bs-toggle="modal"
                                data-bs-target="#modalPaket3">Baca Selengkapnya</button>
                            <a href="#" class="btn btn-dark">Reservasi</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal Paket Wedding 1 -->
<div class="modal fade" id="modalPaket1" tabindex="-1" aria-labelledby="modalPaket1Label" aria-hidden="true">
    <div class="modal-dialog modal-md"> <!-- Ukuran modal lebih kecil -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPaket1Label">Paket Wedding 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="/IMG/1.jpg" class="img-fluid rounded mb-3" alt="Paket Wedding 1">
                <p>Beautiful wedding moments captured elegantly with professional photographers.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-dark">Reservasi</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Paket Wedding 2 -->
<div class="modal fade" id="modalPaket2" tabindex="-1" aria-labelledby="modalPaket2Label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPaket2Label">Paket Wedding 2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="/IMG/2.jpg" class="img-fluid rounded mb-3" alt="Paket Wedding 2">
                <p>Exclusive wedding coverage with premium service and special offers.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-dark">Reservasi</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Paket Wedding 3 -->
<div class="modal fade" id="modalPaket3" tabindex="-1" aria-labelledby="modalPaket3Label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPaket3Label">Paket Wedding 3</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="/IMG/3.jpg" class="img-fluid rounded mb-3" alt="Paket Wedding 3">
                <p>Full wedding documentary and cinematic video for unforgettable moments.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-dark">Reservasi</a>
            </div>
        </div>
    </div>
</div>


<!-- Modal untuk Paket Wedding 3 bisa ditambahkan dengan format serupa -->

<?= $this->endSection() ?>