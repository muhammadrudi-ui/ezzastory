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
            /* Tambahkan margin-bottom untuk jarak dengan section berikutnya */
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

        /* Portfolio Section */
        .portfolio-section {
            padding: 60px 0;
        }

        .portfolio-section h2 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 40px;
        }

        .portfolio-category {
            margin-bottom: 60px;
        }

        .portfolio-category h3 {
            font-size: 22px;
            font-weight: 500;
            color: #444;
            margin-bottom: 30px;
            text-align: start;
        }

        .portfolio-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .portfolio-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .portfolio-card img {
            height: 200px;
            object-fit: cover;
        }

        .portfolio-card .card-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .portfolio-card .card-text {
            font-size: 14px;
            color: #6c757d;
        }

        .see-more-btn {
            display: block;
            width: 200px;
            margin: 40px auto 0;
            font-size: 16px;
        }

        .hidden {
            display: none;
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
    <section class="portfolio-section">
        <div class="container">
            <h2>Our Works</h2>

            <!-- Wedding Category -->
            <div class="portfolio-category">
                <h3>Wedding</h3>
                <div class="row g-4" id="wedding-container">
                    <!-- 9 Card Awal -->
                    <script>generateCards("wedding-container", "Wedding", 9);</script>
                </div>
                <button class="btn btn-outline-primary see-more-btn"
                    onclick="showMore('wedding-container', 'wedding-btn')" id="wedding-btn">See More</button>
            </div>

            <!-- Pre-Wedding Category -->
            <div class="portfolio-category">
                <h3>Pre-Wedding</h3>
                <div class="row g-4" id="prewedding-container">
                    <script>generateCards("prewedding-container", "Pre-Wedding", 9);</script>
                </div>
                <button class="btn btn-outline-primary see-more-btn"
                    onclick="showMore('prewedding-container', 'prewedding-btn')" id="prewedding-btn">See More</button>
            </div>

            <!-- Event Photography Category -->
            <div class="portfolio-category">
                <h3>Event Photography</h3>
                <div class="row g-4" id="event-container">
                    <script>generateCards("event-container", "Event Photography", 9);</script>
                </div>
                <button class="btn btn-outline-primary see-more-btn" onclick="showMore('event-container', 'event-btn')"
                    id="event-btn">See More</button>
            </div>
        </div>
    </section>

    <script>
        function generateCards(containerId, category, count) {
            let container = document.getElementById(containerId);
            for (let i = 1; i <= count; i++) {
                let cardHTML = `
                    <div class="col-md-4 portfolio-item ${i > 9 ? 'hidden' : ''}">
                        <div class="card portfolio-card">
                            <img src="/IMG/${i}.jpg" class="card-img-top" alt="${category} ${i}">
                            <div class="card-body text-center">
                                <h5 class="card-title">${category} ${i}</h5>
                                <p class="card-text">${category}</p>
                            </div>
                        </div>
                    </div>`;
                container.insertAdjacentHTML('beforeend', cardHTML);
            }
        }

        function showMore(containerId, buttonId) {
            let container = document.getElementById(containerId);
            let hiddenItems = container.getElementsByClassName("hidden");

            for (let i = 0; i < 9; i++) {
                if (hiddenItems.length > 0) {
                    hiddenItems[0].classList.remove("hidden");
                }
            }

            if (hiddenItems.length === 0) {
                document.getElementById(buttonId).style.display = "none";
            }
        }

        // Generate cards saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function () {
            generateCards("wedding-container", "Wedding", 18);
            generateCards("prewedding-container", "Pre-Wedding", 18);
            generateCards("event-container", "Event Photography", 18);
        });
    </script>

    <script>
        // Saat halaman di-scroll
        window.addEventListener("scroll", function () {
            const navbar = document.querySelector(".navbar");
            if (window.scrollY > 0) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>

</body>

<?= $this->endSection() ?>