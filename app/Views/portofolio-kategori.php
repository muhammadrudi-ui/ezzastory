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
        <img src="/IMG/1.jpg" alt="Hero Background">
        <h1>Portofolio Kategori</h1>
    </section>

    <!-- Portofolio Section -->
    <section class="portofolio">
        <div class="container">
            <h2 class="text-center mb-4">Wedding</h2>
            <div class="row g-4">
                <!-- Card Portfolio -->
                <div class="col-md-4">
                    <a href="/portofolio-detail" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/1.jpg" class="card-img-top" alt="Wedding 1">
                            <div class="card-body text-center">
                                <h5 class="card-title">Wedding 1</h5>
                                <p class="card-text">Beautiful wedding moments captured elegantly.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/2.jpg" class="card-img-top" alt="Wedding 2">
                            <div class="card-body text-center">
                                <h5 class="card-title">Wedding 2</h5>
                                <p class="card-text">Cherishing the love and joy of the special day.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/3.jpg" class="card-img-top" alt="Wedding 3">
                            <div class="card-body text-center">
                                <h5 class="card-title">Wedding 3</h5>
                                <p class="card-text">Timeless wedding photography for your memories.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/3.jpg" class="card-img-top" alt="Wedding 3">
                            <div class="card-body text-center">
                                <h5 class="card-title">Wedding 3</h5>
                                <p class="card-text">Timeless wedding photography for your memories.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/3.jpg" class="card-img-top" alt="Wedding 3">
                            <div class="card-body text-center">
                                <h5 class="card-title">Wedding 3</h5>
                                <p class="card-text">Timeless wedding photography for your memories.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <img src="/IMG/3.jpg" class="card-img-top" alt="Wedding 3">
                            <div class="card-body text-center">
                                <h5 class="card-title">Wedding 3</h5>
                                <p class="card-text">Timeless wedding photography for your memories.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

</body>

<?= $this->endSection() ?>