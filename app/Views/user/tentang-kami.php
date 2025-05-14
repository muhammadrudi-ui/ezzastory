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

        /* About Section */
        .about-section {
            padding: 60px 0;
        }

        .about-section h2 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 40px;
        }

        .about-description {
            text-align: justify;
            font-size: 16px;
            margin-bottom: 40px;
            color: #555;
        }

        /* Visi Misi */
        .vision-mission {
            display: flex;
            justify-content: space-around;
            margin-bottom: 40px;
            gap: 20px;
        }

        .vision-mission div {
            width: 45%;
        }

        .vision-mission h3 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .vision-mission ul {
            font-size: 16px;
            color: #555;
            list-style-type: disc;
            padding-left: 20px;
        }

        .vision-mission ul li {
            margin-bottom: 10px;
        }

       /* Team Section */
        .team-section {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-top: 60px;
            flex-wrap: wrap;
            padding: 20px;
        }

        .team-card {
            width: 280px;
            height: 360px;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15), 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2), 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .team-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .team-card:hover img {
            transform: scale(1.05);
        }

        .team-card .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7));
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 20px;
        }

        .team-card:hover .overlay {
            opacity: 1;
        }

        .team-card .overlay-content {
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .team-card:hover .overlay-content {
            transform: translateY(0);
        }

        .team-card h4 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .team-card p {
            font-size: 15px;
            color: #e0e0e0;
            margin-top: 8px;
            font-weight: 300;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <?php foreach ($profile_perusahaan as $profile): ?>
            <img src="<?= base_url($profile['background_judul']) ?>" alt="Hero Background" loading="lazy">
            <h1 class="title-about-us scroll-animate scale-up">Tentang Kami</h1>
        <?php endforeach; ?>
    </section>

    <!-- About Us Section -->
    <section class="about-section">
        <div class="container scroll-animate fade-in">
            <?php foreach ($profile_perusahaan as $profile): ?>
                <h2>Tentang Ezzastory</h2>

                <!-- Deskripsi -->
                <div class="about-description scroll-animate fade-in">
                    <p><?= ($profile['deskripsi']) ?></p>
                </div>

                <!-- Visi dan Misi -->
                <div class="vision-mission scroll-animate fade-in">
                    <!-- Visi -->
                    <div>
                        <h3>Visi</h3>
                        <ul>
                            <?= ($profile['visi']) ?>
                        </ul>
                    </div>

                    <!-- Misi -->
                    <div>
                        <h3>Misi</h3>
                        <ul>
                            <?= ($profile['misi']) ?>
                        </ul>
                    </div>
                </div>

                <!-- Team Section -->
                <h2 class="tittle-owner scroll-animate fade-in">Owner</h2>
                <div class="team-section scroll-animate fade-in">
                    <!-- Owner Card -->
                    <div class="team-card">
                        <img src="<?= base_url($profile['foto_owner']) ?>" alt="Owner" loading="lazy">
                        <div class="overlay">
                            <div class="overlay-content">
                                <h4><?= ($profile['nama_owner']) ?></h4>
                                <p>Owner</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</body>

<?= $this->endSection() ?>