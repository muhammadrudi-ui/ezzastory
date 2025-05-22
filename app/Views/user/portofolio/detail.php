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

        /* Animasi untuk foto */
        .gallery-container img {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .gallery-container img.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Portofolio Section */
        .portofolio {
            padding: 60px 0;
        }

        .gallery-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery-container img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            display: block;
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .gallery-container {
                gap: 20px;
            }
            
            .gallery-container img {
                max-height: 60vh;
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
            <div class="gallery-container">
                <?php if (!empty($fotos)): ?>
                    <?php foreach ($fotos as $index => $foto): ?>
                        <img 
                            src="<?= $index < 2 ? base_url($foto['nama_file']) : 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' ?>" 
                            data-src="<?= base_url($foto['nama_file']) ?>" 
                            alt="Foto Portofolio <?= $index + 1 ?>" 
                            loading="lazy"
                            class="scroll-animate"
                            <?php if ($index >= 2): ?>
                                decoding="async"
                            <?php endif; ?>
                        >
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
            <a href="<?= base_url('user/reservasi#reservasi') ?>" class="btn btn-dark">Reservasi Sekarang</a>
        </div>
    </section>

    <!-- Lazy Load & Scroll Animation Image -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Lazy load images
    const lazyImages = [].slice.call(document.querySelectorAll('img[data-src]'));
    
    if ('IntersectionObserver' in window) {
        let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });

        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    }

    // Animasi scroll
    const scrollElements = document.querySelectorAll('.scroll-animate');
    
    const elementInView = (el) => {
        const elementTop = el.getBoundingClientRect().top;
        return (elementTop <= (window.innerHeight || document.documentElement.clientHeight));
    };
    
    const displayScrollElement = (element) => {
        element.classList.add('visible');
    };

    const handleScrollAnimation = () => {
        scrollElements.forEach((el) => {
            if (elementInView(el)) {
                displayScrollElement(el);
            }
        });
    };
    
    // Initialize
    window.addEventListener('load', handleScrollAnimation);
    window.addEventListener('scroll', handleScrollAnimation);
});
</script>

<?= $this->endSection() ?>