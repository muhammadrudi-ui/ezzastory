<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


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

        /* TABS */
        .nav-tabs {
            justify-content: center;
            border-bottom: 2px solid #ddd;
        }

        .nav-tabs .nav-link {
            padding: 12px 20px;
            font-size: 16px;
            color: grey;
        }

        .nav-tabs .nav-link.active {
            background-color: black;
            color: white;
        }

        .tab-content {
            margin-top: 60px;
            margin-bottom: 60px;
        }

        /* FORM RESERVASI */
        .reservasi-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        /* TRACKING */
        .tracking-container {
            display: flex;
            gap: var(--gap-size, 120px);
            /* Default 30px, bisa diubah lewat inline style */
        }

        .tracking-step {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tracking-icon {
            width: 80px;
            height: 80px;
            background: grey;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }

        .tracking-step:first-child .tracking-icon {
            background: black;
        }

        .tracking-text {
            font-size: 16px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <img src="/IMG/1.jpg" alt="Hero Background">
        <h1>Reservasi</h1>
    </section>

    <div class="container mt-5">
        <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#jadwal">Jadwal</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reservasi">Reservasi</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tracking">Tracking</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#riwayat">Riwayat</button>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <!-- Jadwal -->
            <div class="tab-pane fade show active" id="jadwal">
                <div class="card p-4">
                    <h4 class="text-center mb-3">Jadwal Ketersediaan</h4>
                    <iframe src="https://calendar.google.com/calendar/embed?src=example@gmail.com" style="border: 0"
                        width="100%" height="500"></iframe>
                </div>
            </div>

            <!-- Reservasi -->
            <div class="tab-pane fade" id="reservasi">
                <div class="reservasi-card">
                    <h4 class="text-center mb-3">Formulir Reservasi</h4>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Paket</label>
                            <select class="form-select">
                                <option>Wedding</option>
                                <option>Pre-Wedding</option>
                                <option>Event Photography</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pemotretan</label>
                            <input type="date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-outline-dark w-100">Kirim Reservasi</button>
                    </form>
                </div>
            </div>

            <!-- Tracking -->
            <div class="tab-pane fade" id="tracking">
                <h4 class="text-center mb-4">Tracking Proses</h4>
                <div class="d-flex justify-content-center text-center tracking-container" style="--gap-size: 30px;">
                    <div class="tracking-step">
                        <div class="tracking-icon"><i class="fa-solid fa-camera"></i></div>
                        <div class="tracking-text mt-2">Pemotretan</div>
                    </div>
                    <div class="tracking-step">
                        <div class="tracking-icon"><i class="fa-solid fa-pen-to-square"></i></div>
                        <div class="tracking-text mt-2">Editing</div>
                    </div>
                    <div class="tracking-step">
                        <div class="tracking-icon"><i class="fa-solid fa-print"></i></div>
                        <div class="tracking-text mt-2">Pencetakan</div>
                    </div>
                    <div class="tracking-step">
                        <div class="tracking-icon"><i class="fa-solid fa-check"></i></div>
                        <div class="tracking-text mt-2">Pesanan Selesai</div>
                    </div>
                </div>
            </div>

            <!-- Riwayat -->
            <div class="tab-pane fade" id="riwayat">
                <h4 class="text-center mb-4">Riwayat Pemesanan</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Paket</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>Wedding</td>
                                <td>2024-09-20</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<?= $this->endSection() ?>