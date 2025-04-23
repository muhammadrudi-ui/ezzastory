<?= $this->extend('layout/app-visitor') ?>

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
            font-size: 18px;
            margin-bottom: 40px;
            color: #555;
        }

        /* Vision and Mission */
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

        /* Team Cards */
        .team-section {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-top: 60px;
            flex-wrap: wrap;
        }

        .team-card {
            width: 250px;
            height: 320px;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            /* Mengatur jarak antar card */
        }

        .team-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .team-card .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
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

        .team-card h4 {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .team-card p {
            font-size: 14px;
            color: #ddd;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <?php foreach ($profile_perusahaan as $profile): ?>
            <img src="<?= base_url($profile['background_judul']) ?>" alt="Hero Background" loading="lazy">
            <h1>Tentang Kami</h1>
        <?php endforeach; ?>
    </section>

    <!-- About Us Section -->
    <section class="about-section">
        <div class="container">
            <?php foreach ($profile_perusahaan as $profile): ?>
                <h2>Tentang Ezzastory</h2>

                <!-- Description -->
                <div class="about-description">
                    <p><?= ($profile['deskripsi']) ?></p>
                </div>

                <!-- Vision and Mission -->
                <div class="vision-mission">
                    <!-- Vision -->
                    <div>
                        <h3>Visi</h3>
                        <ul>
                            <?= esc($profile['visi']) ?>
                        </ul>
                    </div>

                    <!-- Mission -->
                    <div>
                        <h3>Misi</h3>
                        <ul>
                            <?= ($profile['misi']) ?>
                        </ul>
                    </div>
                </div>

                <!-- Team Section -->
                <h2>Owner</h2>
                <div class="team-section">
                    <!-- Owner Card -->
                    <div class="team-card">
                        <img src="<?= base_url($profile['foto_owner']) ?>" alt="Owner" loading="lazy">
                        <div class="overlay">
                            <div>
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