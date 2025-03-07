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
        <img src="/IMG/1.jpg" alt="Hero Background">
        <h1>Portofolio</h1>
    </section>

    <!-- Portofolio Section -->
    <section class="portofolio">
        <div class="container">
            <h2 class="text-center mb-4">Our Works</h2>

            <!-- Wedding Category -->
            <div class="portofolio-category mb-5">
                <h3>Wedding</h3>
                <div class="row g-4">
                    <!-- Card Portfolio -->
                    <div class="col-md-4">
                        <a href="#" class="text-decoration-none">
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
                </div>
                <a href="/portofolio-kategori" class="btn btn-dark see-more-btn">See
                    More</a>
            </div>

            <!-- Pre-Wedding Category -->
            <div class="portofolio-category mb-5">
                <h3>Pre-Wedding</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card">
                                <img src="/IMG/1.jpg" class="card-img-top" alt="Pre-Wedding 1">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Pre-Wedding 1</h5>
                                    <p class="card-text">Romantic pre-wedding shoot in scenic locations.</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card">
                                <img src="/IMG/2.jpg" class="card-img-top" alt="Pre-Wedding 2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Pre-Wedding 2</h5>
                                    <p class="card-text">Capturing the love story before the big day.</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card">
                                <img src="/IMG/3.jpg" class="card-img-top" alt="Pre-Wedding 3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Pre-Wedding 3</h5>
                                    <p class="card-text">Candid and cinematic moments of love.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <a href="#" class="btn btn-dark see-more-btn">See
                    More</a>
            </div>

            <!-- Event Photography Category -->
            <div class="portofolio-category">
                <h3>Event Photography</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card">
                                <img src="/IMG/1.jpg" class="card-img-top" alt="Event 1">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Event 1</h5>
                                    <p class="card-text">Capturing unforgettable moments at events.</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card">
                                <img src="/IMG/2.jpg" class="card-img-top" alt="Event 2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Event 2</h5>
                                    <p class="card-text">Professional event photography with a creative touch.</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card">
                                <img src="/IMG/3.jpg" class="card-img-top" alt="Event 3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Event 3</h5>
                                    <p class="card-text">Documenting special occasions with clarity and style.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <a href="#" class="btn btn-dark see-more-btn">See
                    More</a>
            </div>
        </div>
    </section>

</body>

<?= $this->endSection() ?>