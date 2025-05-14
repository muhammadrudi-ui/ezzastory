<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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

        /* Ketersediaan Jadwal */
        .calendar-container {
            width: 100%;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .calendar-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .calendar-controls button {
            transition: background-color 0.3s, color 0.3s;
        }

        .calendar-controls button:hover {
            background-color: dark;
            color: white;
        }

        .calendar-table th,
        .calendar-table td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
            height: 80px;
            border: 1px solid #ddd;
            font-weight: bold;
            transition: background 0.3s;
        }

        .calendar-table td:hover {
            background: rgb(236, 236, 236);
            cursor: pointer;
        }

        .reserved {
            color: red;
            padding: 8px;
            position: relative;
        }

        .reserved::after {
            content: 'Booked';
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            padding: 2px 5px;
            border-radius: 5px;
            font-size: 10px;
        }

        .available {
            color: green;
            border-radius: 8px;
            padding: 8px;
        }

        .calendar-note {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .modal-header .modal-title {
            font-size: 1.5rem;
        }

        .badge {
            font-size: 12px;
            padding: 5px 10px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        @media (max-width: 576px) {
            .d-flex {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .table {
                font-size: 12px;
            }
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .calendar-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .calendar-controls {
                margin-top: 10px;
            }

            .table-responsive {
                overflow-x: auto;
            }
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
            width: 100%;
            max-width: 1000px;
            margin: 0 auto 20px;
            position: relative;
            padding: 20px 10px;
        }

        /* Dark Accordion Styles */
        .accordion-button:not(.collapsed) {
            background-color:rgb(42, 42, 42);
            color:rgb(255, 255, 255);
        }
        
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(144, 144, 144, 0.5); /* Abu-abu gelap */
            border-color:rgb(144, 144, 144, 0.5);
        }
        .tracking-step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .tracking-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: #fff;
            border: 2px solid #e9ecef;
            position: relative;
            transition: all 0.3s ease;
        }

        .tracking-icon.pending {
            color: #adb5bd;
            border-color: #e9ecef;
            background: #fff;
        }

        .tracking-icon.active {
            background: #000;
            color: white;
            border-color: #000;
            transform: scale(1.1);
        }

        .tracking-icon.completed {
            background: #adb5bd;
            color: white;
            border-color: #adb5bd;
        }

        .tracking-connector {
            position: absolute;
            top: 25px;
            left: 50%;
            width: calc(100% - 50px);
            height: 2px;
            background: #e9ecef;
            z-index: -1;
            transform: translateX(25px);
        }

        .tracking-connector.active {
            background: #adb5bd;
        }

        .tracking-step:last-child .tracking-connector {
            display: none;
        }

        .tracking-label {
            margin-top: 15px;
            text-align: center;
            width: 100%;
        }

        .tracking-text {
            font-size: 14px;
            font-weight: 500;
            display: block;
            color: #adb5bd;
        }

        .tracking-text.active {
            color: #000;
            font-weight: 600;
        }

        .tracking-text.completed {
            color: #adb5bd;
        }

        .tracking-status {
            font-size: 12px;
            color: #000;
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            padding: 2px 10px;
            display: inline-block;
            margin-top: 5px;
            font-weight: 500;
        }

        .tracking-info {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Responsiveness */
        @media (max-width: 991px) {
            .tracking-container {
                padding: 10px 0;
            }
            
            .tracking-icon {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
            
            .tracking-connector {
                top: 22px;
            }
        }

        @media (max-width: 767px) {
            .tracking-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 30px;
                padding-left: 30px;
            }
            
            .tracking-step {
                flex-direction: row;
                width: 100%;
                align-items: center;
                gap: 15px;
            }
            
            .tracking-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
            
            .tracking-connector {
                top: 20px;
                left: 20px;
                width: 2px;
                height: calc(100% + 30px);
                transform: none;
            }
            
            .tracking-label {
                margin-top: 0;
                text-align: left;
            }
            
            .tracking-text {
                font-size: 14px;
            }
            
            .tracking-status {
                margin-top: 3px;
            }
            
            .tracking-step:last-child .tracking-connector {
                display: none;
            }
        }

        @media (max-width: 575px) {
            .tracking-icon {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }
            
            .tracking-connector {
                left: 18px;
            }
            
            .tracking-text {
                font-size: 13px;
            }
            
            .tracking-status {
                font-size: 11px;
            }
        }

        /* Riwayat */
        .card-hover-effect {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
    </style>

    <!-- Hero Section -->
<section class="hero-section">
    <?php foreach ($profile_perusahaan as $profile): ?>
        <img src="<?= base_url($profile['background_judul']) ?>" alt="Hero Background" loading="lazy">
        <h1>Reservasi</h1>
    <?php endforeach; ?>
</section>

    <div class="container mt-5">
        <!-- Tabs -->
        <ul class="nav nav-tabs scroll-animate fade-in" id="reservasiTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link <?= isset($active_tab) && $active_tab === 'jadwal' ? 'active' : '' ?>" 
                        id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal" 
                        type="button" role="tab" aria-controls="jadwal" aria-selected="<?= $active_tab === 'jadwal' ? 'true' : 'false' ?>">
                        Jadwal
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link <?= isset($active_tab) && $active_tab === 'reservasi' ? 'active' : '' ?>" 
                        id="reservasi-tab" data-bs-toggle="tab" data-bs-target="#reservasi" 
                        type="button" role="tab" aria-controls="reservasi" aria-selected="<?= $active_tab === 'reservasi' ? 'true' : 'false' ?>">
                        Reservasi
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link <?= isset($active_tab) && $active_tab === 'pembayaran' ? 'active' : '' ?>" 
                        id="pembayaran-tab" data-bs-toggle="tab" data-bs-target="#pembayaran" 
                        type="button" role="tab" aria-controls="pembayaran" aria-selected="<?= $active_tab === 'pembayaran' ? 'true' : 'false' ?>">
                        Pembayaran
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link <?= isset($active_tab) && $active_tab === 'tracking' ? 'active' : '' ?>" 
                        id="tracking-tab" data-bs-toggle="tab" data-bs-target="#tracking" 
                        type="button" role="tab" aria-controls="tracking" aria-selected="<?= $active_tab === 'tracking' ? 'true' : 'false' ?>">
                        Tracking
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link <?= isset($active_tab) && $active_tab === 'riwayat' ? 'active' : '' ?>" 
                        id="riwayat-tab" data-bs-toggle="tab" data-bs-target="#riwayat" 
                        type="button" role="tab" aria-controls="riwayat" aria-selected="<?= $active_tab === 'riwayat' ? 'true' : 'false' ?>">
                        Riwayat
                </button>
            </li>
        </ul>

        <div class="tab-content mt-4" id="reservasiTabContent">
            <!-- Jadwal -->
            <div class="tab-pane fade <?= isset($active_tab) && $active_tab === 'jadwal' ? 'show active' : '' ?>" 
            id="jadwal" role="tabpanel" aria-labelledby="jadwal-tab">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <div>
                            <h4 id="calendarMonth" class="text-dark"></h4>
                        </div>
                        <div class="calendar-controls">
                            <button class="btn btn-outline-dark btn-sm" id="prevMonth">‹</button>
                            <button class="btn btn-outline-dark btn-sm" id="nextMonth">›</button>
                            <select id="yearFilter" class="form-select form-select-sm"></select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-center calendar-table">
                            <thead>
                                <tr>
                                    <th>Minggu</th>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
                                </tr>
                            </thead>
                            <tbody id="calendarBody"></tbody>
                        </table>
                    </div>
                    <div class="calendar-note">
                        <p><small>*Dalam 1 Hari Tidak Ada Batasan untuk Jenis Layanan Selain Wedding.</small></p>
                    </div>
                </div>

                <!-- Modal Bootstrap -->
                <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h5 class="modal-title w-100 fw-bold">Detail Reservasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div>
                                        <span class="badge bg-danger small">Sudah Reservasi: <span
                                                id="bookedCount">3</span></span>
                                        <span class="badge bg-success small">Sisa Kuota Reservasi: <span
                                                id="remainingQuota">5</span></span>
                                    </div>
                                    <h6 class="fw-bold">Tanggal: <span id="reservationDate">Senin, 25 September
                                            2024</span>
                                    </h6>
                                </div>

                                <!-- Tabel Pengguna -->
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped table-bordered text-center">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Paket Layanan</th>
                                                <th>Waktu Pemotretan</th>
                                                <th>Lokasi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="reservationList">
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Informasi Tambahan -->
                                <div class="calendar-note">
                                    <p><small>*Dalam 1 Hari Tidak Ada Batasan untuk Jenis Layanan Selain
                                            Wedding.</small>
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORM RESERVASI -->
            <div class="tab-pane fade <?= isset($active_tab) && $active_tab === 'reservasi' ? 'show active' : '' ?>" 
            id="reservasi" role="tabpanel" aria-labelledby="reservasi-tab">
    <div class="reservasi-card" style="max-width: 1000px;">
       <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>

        <h4 class="text-center mb-3">Formulir Reservasi</h4>
        <form action="<?= base_url('user/pemesanan/simpan') ?>" method="post">
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" 
                        value="<?= $user_data['nama_lengkap'] ?? '' ?>" 
                        placeholder="Masukkan nama lengkap" required readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" 
                        value="<?= $user_data['email'] ?? '' ?>" 
                        placeholder="Masukkan email" required readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" name="telepon" class="form-control" 
                        value="<?= $user_data['no_telepon'] ?? '' ?>" 
                        placeholder="Masukkan nomor telepon" required readonly>
                </div>
                    <?php
                        $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$waktuSekarang = $now->format('Y-m-d\TH:i');
?>
                    <div class="mb-3">
                        <label class="form-label">Waktu Pemesanan</label>
                        <input type="datetime-local" name="waktu_pemesanan" class="form-control"
                            value="<?= $waktuSekarang ?>" readonly required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Paket Layanan</label>
                        <select name="paket_layanan" class="form-select" id="paketLayanan" required>
                            <option value="" selected disabled>Pilih Paket Layanan</option>
                            <?php foreach ($paket_layanan as $paket): ?>
                                <option value="<?= $paket['id'] ?>" 
                                    data-deskripsi="<?= esc($paket['benefit']) ?>"
                                    data-harga="<?= number_format($paket['harga'], 0, ',', '.') ?>"
                                    <?= (isset($_GET['paket_id']) && $_GET['paket_id'] == $paket['id']) ? 'selected' : '' ?>>
                                    <?= esc($paket['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Paket</label>
                        <textarea class="form-control" id="deskripsiPaket" readonly rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <p class="form-control-plaintext fw-bold" id="hargaPaket">Rp 0</p>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                    <?php
    $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$waktuSekarang = $now->format('Y-m-d\TH:i');
?>       
    <label class="form-label">Waktu Pemotretan</label>
    <input type="datetime-local" name="waktu_pemotretan" class="form-control" value="<?= $waktuSekarang ?>" required>
</div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Pembayaran</label>
                        <select name="jenis_pembayaran" class="form-select" required>
                            <option value="" selected disabled>Pilih Jenis Pembayaran</option>
                            <option value="Lunas">Lunas</option>
                            <option value="DP">DP (Down Payment)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi Pemotretan (Ex. Rogojampi/Srono/Banyuwangi)</label>
                        <input type="text" name="lokasi_pemotretan" class="form-control" 
                            placeholder="Masukkan lokasi pemotretan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi Pemotretan (Link Maps)</label>
                        <input type="text" name="link_maps_pemotretan" class="form-control" 
                            placeholder="Masukkan link Google Maps lokasi pemotretan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi Pengiriman Album (Link Maps)</label>
                        <input type="text" name="link_maps_pengiriman" class="form-control"
                            placeholder="Masukkan link Google Maps lokasi pengiriman album" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Mempelai Pria & Wanita</label>
                        <input type="text" name="nama_mempelai" class="form-control"
                            placeholder="Masukkan nama mempelai pria & wanita" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Username Instagram</label>
                    <input type="text" name="instagram" class="form-control"
                        value="<?= $user_data['instagram'] ?? '' ?>"
                        placeholder="Masukkan username Instagram Anda" required readonly>
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-dark w-100">Kirim Reservasi</button>
            <!-- Catatan Pembayaran -->
            <div class="mt-4 p-3 border rounded bg-light">
                <h6 class="text-danger"><strong>Catatan:</strong></h6>
                <ul class="mb-0">
                    <li>DP sebesar 50% dari harga paket layanan.</li>
                    <li>Pembayaran DP maksimal H-3 sebelum acara.</li>
                    <li>Pelunasan maksimal H+3 setelah acara.</li>
                    <li>Proses editing dan pencetakan dilakukan setelah pelunasan.</li>
                    <li>Estimasi pengerjaan album sekitar 2–4 minggu.</li>
                </ul>
            </div>
        </form>
    </div>
</div>

<!-- Payment -->
<div class="tab-pane fade <?= isset($active_tab) && $active_tab === 'pembayaran' ? 'show active' : '' ?>" 
id="pembayaran" role="tabpanel" aria-labelledby="pembayaran-tab">
    <div class="card mt-4 border-0 shadow-sm">
        <div class="card-body p-2">
        <h4 class="text-center mb-4 fw-bold text-dark">Informasi Pembayaran</h4>
            <?php if (empty($all_pemesanan) || !array_filter($all_pemesanan, fn ($p) => $p['status'] !== 'Selesai')): ?>
                <div class="alert alert-dark text-center">
                    <i class="fas fa-info-circle me-2"></i> Belum ada data pemesanan. Silakan buat pemesanan terlebih dahulu untuk melihat informasi pembayaran.
                </div>
            <?php else: ?>
                <div class="accordion" id="paymentAccordion">
                    <?php foreach ($all_pemesanan as $index => $pemesanan): ?>
                        <?php if ($pemesanan['status'] !== 'Selesai'): ?>
                        <div class="accordion-item border rounded-3 mb-3">
                            <h2 class="accordion-header" id="heading<?= $index ?>">
                                <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $index ?>">
                                    <div class="d-flex flex-column flex-md-row w-100 gap-3">
                                        <div>
                                            <span class="badge bg-white bg-opacity-15 text-dark">Paket</span>
                                            <strong class="ms-1"><?= esc($pemesanan['nama_paket'] ?? '-') ?></strong>
                                        </div>
                                        <div>
                                            <span class="badge bg-white bg-opacity-15 text-dark">Mempelai</span>
                                            <strong class="ms-1"><?= esc($pemesanan['nama_mempelai'] ?? '-') ?></strong>
                                        </div>
                                        <div>
                                            <span class="badge bg-white bg-opacity-15 text-dark">Jenis Bayar</span>
                                            <strong class="ms-1 text-capitalize"><?= esc($pemesanan['jenis_pembayaran'] ?? '-') ?></strong>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#paymentAccordion">
                                <div class="accordion-body pt-3">
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <?php if (!empty($pemesanan['foto'])): ?>
                                                <img src="<?= base_url($pemesanan['foto']) ?>" class="img-fluid rounded-3" alt="<?= esc($pemesanan['nama_paket']) ?>">
                                            <?php else: ?>
                                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height: 150px;">
                                                    <i class="fas fa-image fa-3x text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-9">
                                            <h5><?= esc($pemesanan['nama_paket']) ?></h5>
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-primary bg-opacity-10 text-primary me-2">Harga Paket</span>
                                                <span class="fw-bold">Rp <?= number_format($pemesanan['harga'], 0, ',', '.') ?></span>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-info bg-opacity-10 text-info me-2">Tanggal & Waktu Pemotretan</span>
                                                <span><?= date('d M Y H:i', strtotime($pemesanan['waktu_pemotretan'])) ?> WIB</span>
                                            </div>
                                            <div>
                                                <span class="badge bg-secondary bg-opacity-10 text-body-secondary">Status Pembayaran</span>
                                                <strong class="ms-1"><?= esc($pemesanan['status_pembayaran'] ?? '-') ?></strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <?php if (!empty($pembayaran[$pemesanan['id']])): ?>
                                            <?php $canCancel = true; ?>
                                            <?php foreach ($pembayaran[$pemesanan['id']] as $bayar): ?>
                                                <?php if ($bayar['status'] === 'success') {
                                                    $canCancel = false;
                                                } ?>
                                                <div class="col-md-<?= $pemesanan['jenis_pembayaran'] === 'DP' ? '6' : '12' ?>">
                                                    <div class="card border border-light-subtle rounded-3 shadow-sm h-100">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                                <h6 class="mb-0 text-capitalize">
                                                                    <?= esc($bayar['jenis']) ?>
                                                                    <?php if ($bayar['jenis'] === 'DP'): ?>
                                                                        <span class="badge bg-warning bg-opacity-10 text-warning ms-2">50%</span>
                                                                    <?php elseif ($bayar['jenis'] === 'Pelunasan'): ?>
                                                                        <span class="badge bg-<?= $pemesanan['jenis_pembayaran'] === 'DP' ? 'warning' : 'success' ?> bg-opacity-10 text-<?= $pemesanan['jenis_pembayaran'] === 'DP' ? 'warning' : 'success' ?> ms-2">
                                                                            <?= $pemesanan['jenis_pembayaran'] === 'DP' ? '50%' : '100%' ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </h6>
                                                                <span class="badge bg-<?= $bayar['status'] === 'success' ? 'success' : 'warning' ?> bg-opacity-25 text-dark text-capitalize">
                                                                    <i class="fa-solid <?= $bayar['status'] === 'success' ? 'fa-check-circle' : 'fa-clock' ?> me-1"></i>
                                                                    <?= esc($bayar['status']) ?>
                                                                </span>
                                                            </div>
                                                            <div class="mb-3">
                                                                <span class="text-muted small">Jumlah</span>
                                                                <div class="fs-5 fw-semibold text-dark">Rp <?= number_format($bayar['jumlah'], 0, ',', '.') ?></div>
                                                            </div>
                                                            <?php if ($bayar['status'] === 'pending'): ?>
                                                                <form action="<?= base_url('user/pembayaran/bayar/' . $bayar['id']) ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <button type="submit" class="btn btn-outline-dark w-100">
                                                                        <i class="fa-solid fa-credit-card me-1"></i> Bayar Sekarang
                                                                    </button>
                                                                </form>
                                                            <?php else: ?>
                                                                <div class="alert alert-success p-2 small mb-0 d-flex align-items-center">
                                                                    <i class="fa-solid fa-check-circle me-2"></i>
                                                                    <div>
                                                                        <strong>Sudah Dibayar</strong><br>
                                                                        <?php if (!empty($bayar['tanggal_bayar'])): ?>
                                                                            <span class="text-muted"><?= date('d M Y H:i', strtotime($bayar['tanggal_bayar'])) ?></span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <!-- Tambahkan tombol batalkan jika semua pembayaran masih pending -->
                                            <?php if ($canCancel): ?>
                                                <div class="col-12 mt-3">
                                                    <form action="<?= base_url('user/pemesanan/batal/' . $pemesanan['id']) ?>" method="post" id="cancelForm<?= $pemesanan['id'] ?>">
                                                        <?= csrf_field() ?>
                                                        <button type="button" class="btn btn-danger w-100" onclick="confirmCancel(<?= $pemesanan['id'] ?>)">
                                                            <i class="fa-solid fa-times-circle me-1"></i> Batalkan Pemesanan
                                                        </button>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="col-12">
                                                <div class="alert alert-secondary text-muted small">
                                                    <i class="fa-solid fa-circle-info me-2"></i> Tidak ditemukan data pembayaran untuk pemesanan ini.
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Tracking -->
<div class="tab-pane fade <?= isset($active_tab) && $active_tab === 'tracking' ? 'show active' : '' ?>" 
id="tracking" role="tabpanel" aria-labelledby="tracking-tab">
    <h4 class="text-center mb-4 fw-bold text-dark">Tracking Pemesanan Anda</h4>
    <?php if (empty($all_pemesanan) || !array_filter($all_pemesanan, fn ($p) => $p['status'] !== 'Selesai')): ?>
        <div class="alert alert-dark text-center">
            <i class="fas fa-info-circle me-2"></i> Belum ada data pemesanan. Silakan buat pemesanan terlebih dahulu untuk melihat tracking proses.
        </div>
    <?php else: ?>
        <div class="accordion" id="trackingAccordion">
            <?php foreach ($all_pemesanan as $index => $pemesanan): ?>
                <?php if ($pemesanan['status'] !== 'Selesai'): ?>
                <div class="accordion-item border rounded-4 mb-3 shadow-sm overflow-hidden">
                    <h2 class="accordion-header" id="trackingHeading<?= $index ?>">
                        <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#trackingCollapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="trackingCollapse<?= $index ?>">
                            <div class="d-flex flex-column flex-md-row w-100 gap-3">
                                <div>
                                    <span class="badge bg-white bg-opacity-15 text-dark">Paket</span>
                                    <strong class="ms-1"><?= esc($pemesanan['nama_paket'] ?? '-') ?></strong>
                                </div>
                                <div>
                                    <span class="badge bg-white bg-opacity-15 text-dark">Mempelai</span>
                                    <strong class="ms-1"><?= esc($pemesanan['nama_mempelai'] ?? '-') ?></strong>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="trackingCollapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#trackingAccordion">
                        <div class="accordion-body pt-4 pb-4">
                            <h4 class="text-center mb-4 fw-bold">Proses Pemesanan</h4>
                            <div class="tracking-container">
                                <?php
                                $steps = [
                                    'Pemesanan' => ['icon' => 'fa-calendar-check', 'label' => 'Pemesanan'],
                                    'Pemotretan' => ['icon' => 'fa-camera', 'label' => 'Pemotretan'],
                                    'Editing' => ['icon' => 'fa-pen-to-square', 'label' => 'Editing'],
                                    'Pencetakan' => ['icon' => 'fa-print', 'label' => 'Pencetakan'],
                                    'Pengiriman' => ['icon' => 'fa-truck', 'label' => 'Pengiriman'],
                                ];

                    $currentStatus = $tracking_steps[$pemesanan['id']]['current_status'];
                    $statusOrder = array_keys($steps);
                    $currentIndex = array_search($currentStatus, $statusOrder);

                    foreach ($steps as $status => $step):
                        $isActive = $status === $currentStatus;
                        $isPast = array_search($status, $statusOrder) < $currentIndex;
                        ?>
                                    <div class="tracking-step">
                                        <?php if ($isActive): ?>
                                            <div class="tracking-icon active">
                                                <i class="fa-solid <?= $step['icon'] ?>"></i>
                                            </div>
                                        <?php elseif ($isPast): ?>
                                            <div class="tracking-icon completed">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                        <?php else: ?>
                                            <div class="tracking-icon pending">
                                                <i class="fa-solid fa-<?= $step['icon'] ?>"></i>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($status !== 'Pengiriman'): ?>
                                            <div class="tracking-connector <?= $isPast ? 'active' : '' ?>"></div>
                                        <?php endif; ?>
                                        
                                        <div class="tracking-label">
                                            <span class="tracking-text <?= $isActive ? 'active' : ($isPast ? 'completed' : '') ?>">
                                                <?= $step['label'] ?>
                                            </span>
                                            <?php if ($isActive): ?>
                                                <span class="tracking-status">Sedang Diproses</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <div class="tracking-info mt-4">
                                <?php if ($pemesanan['status'] === 'Pengiriman'): ?>
                                    <form action="<?= base_url('user/pemesanan/selesai/' . $pemesanan['id']) ?>" method="post" id="completeForm<?= $pemesanan['id'] ?>">
                                        <?= csrf_field() ?>
                                        <button type="button" class="btn btn-dark w-100 mt-3" onclick="confirmComplete(<?= $pemesanan['id'] ?>)">
                                            <i class="fa-solid fa-check-circle me-1"></i> Selesai Pesanan
                                        </button>
                                    </form>
                                <?php elseif ($pemesanan['status'] !== 'Selesai'): ?>
                                    <div class="alert alert-light border d-flex align-items-center rounded-4">
                                        <i class="fa-solid fa-circle-info text-dark me-3 fs-4"></i>
                                        <div>
                                            <strong class="d-block mb-1">Status Pemesanan: <?= $pemesanan['status'] ?></strong>
                                            <p class="mb-0">
                                                <?php
                                        $descriptions = [
                                            'Pemesanan' => 'Pesanan Anda telah kami terima dan sedang dalam proses.',
                                            'Pemotretan' => 'Persiapan dan proses pemotretan sedang berlangsung.',
                                            'Editing' => 'Tim kami sedang melakukan proses editing dan pemilihan foto terbaik.',
                                            'Pencetakan' => 'Foto-foto terbaik sedang dalam proses pencetakan album.',
                                            'Pengiriman' => 'Album foto Anda sedang dalam proses pengiriman.'
                                        ];
                                    echo $descriptions[$pemesanan['status']] ?? 'Pesanan Anda sedang diproses.';
                                    ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($pemesanan['catatan_status'])): ?>
                                    <div class="alert alert-light border rounded-4 mt-3">
                                        <i class="fa-solid fa-comment-dots me-2 text-dark"></i>
                                        <strong>Catatan:</strong>
                                        <p class="mb-0 mt-2"><?= nl2br(esc($pemesanan['catatan_status'])) ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Riwayat Pemesanan -->
<div class="tab-pane fade <?= isset($active_tab) && $active_tab === 'riwayat' ? 'show active' : '' ?>" 
id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
    <div class="container-fluid">
        <h4 class="text-center mb-4 fw-bold text-dark">Riwayat Pemesanan Anda</h4>
        
        <?php if (empty($riwayat_pemesanan)) : ?>
            <div class="alert alert-dark text-center">
                <i class="fas fa-info-circle me-2"></i> Belum ada riwayat pemesanan yang selesai.
            </div>
        <?php else : ?>
            <div class="row">
                <?php foreach ($riwayat_pemesanan as $riwayat) : ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow border-0 card-hover-effect">
                            <div class="card-header bg-dark text-white">
                                <h5 class="card-title mb-0"><?= $riwayat['nama_mempelai'] ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Paket:</span>
                                    <strong><?= $riwayat['nama_paket'] ?></strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Harga:</span>
                                    <strong>Rp <?= number_format($riwayat['harga'], 0, ',', '.') ?></strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Pemesanan:</span>
                                    <small><?= date('d M Y H:i', strtotime($riwayat['waktu_pemesanan'])) ?></small>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Pemotretan:</span>
                                    <small><?= date('d M Y H:i', strtotime($riwayat['waktu_pemotretan'])) ?></small>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Pembayaran:</span>
                                    <span><?= $riwayat['jenis_pembayaran'] ?></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Instagram:</span>
                                    <a href="https://instagram.com/<?= $riwayat['instagram'] ?>" 
                                       target="_blank" class="text-decoration-none">
                                       @<?= $riwayat['instagram'] ?>
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                <span class="badge rounded-pill bg-dark p-2">
                                    <i class="fas fa-check-circle me-1"></i> <?= $riwayat['status'] ?>
                                </span>
                                <small class="text-muted">
                                    Selesai: <?= date('d/m/Y', strtotime($riwayat['status_selesai_at'])) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>


</div>
</div>


<!-- Jika User Belum Melengkapi Profil Pribadi -->
<?php if (!$isProfileComplete): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Lengkapi Profil',
        text: 'Silakan lengkapi data diri Anda terlebih dahulu sebelum melakukan reservasi.',
        icon: 'warning',
        confirmButtonText: 'Lengkapi Sekarang'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('user/profile') ?>';
        }
    });
</script>
<?php endif; ?>

<!-- Kalender -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = new bootstrap.Modal(document.getElementById("reservationModal"));
        const calendarBody = document.getElementById("calendarBody");
        const calendarMonth = document.getElementById("calendarMonth");
        const prevMonthBtn = document.getElementById("prevMonth");
        const nextMonthBtn = document.getElementById("nextMonth");
        const yearFilter = document.getElementById("yearFilter");

        let currentDate = new Date();
        const reservations = {
            5: [{ nama: "John Doe", paket: "Premium", waktu: "10:00", lokasi: "Room A" }],
            14: [{ nama: "Jane Doe", paket: "Haircut", waktu: "14:00", lokasi: "Room B" }]
        };

        function generateYearOptions() {
            const currentYear = new Date().getFullYear();
            for (let i = currentYear - 3; i <= currentYear + 3; i++) {
                const option = document.createElement("option");
                option.value = i;
                option.textContent = i;
                yearFilter.appendChild(option);
            }
            yearFilter.value = currentYear;
        }

        function renderCalendar() {
            calendarBody.innerHTML = "";
            const month = currentDate.getMonth();
            const year = currentDate.getFullYear();

            calendarMonth.textContent = new Intl.DateTimeFormat("id-ID", { month: "long", year: "numeric" }).format(currentDate);

            const firstDayOfMonth = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            let currentDay = 1;
            let row = document.createElement("tr");

            // Menyesuaikan jika Minggu harus di awal (opsional, tergantung format kalender)
            const offset = firstDayOfMonth === 0 ? 6 : firstDayOfMonth - 1;

            // Menambahkan sel kosong sebelum tanggal 1
            for (let i = 0; i < offset; i++) {
                row.appendChild(document.createElement("td"));
            }

            for (let i = offset; i < 7; i++) {
                row.appendChild(createCalendarCell(currentDay));
                currentDay++;
            }
            calendarBody.appendChild(row);

            while (currentDay <= daysInMonth) {
                row = document.createElement("tr");
                for (let i = 0; i < 7 && currentDay <= daysInMonth; i++) {
                    row.appendChild(createCalendarCell(currentDay));
                    currentDay++;
                }
                calendarBody.appendChild(row);
            }

            // Pastikan kalender selalu memiliki 6 baris agar tidak berubah ukuran
            while (calendarBody.children.length < 6) {
                row = document.createElement("tr");
                for (let i = 0; i < 7; i++) {
                    row.appendChild(document.createElement("td"));
                }
                calendarBody.appendChild(row);
            }
        }

        function createCalendarCell(day) {
            const cell = document.createElement("td");
            cell.textContent = day;
            cell.setAttribute("data-day", day);
            cell.classList.add(reservations[day] ? "reserved" : "available");
            cell.addEventListener("click", function () {
                showReservationDetails(day);
            });
            return cell;
        }

        function showReservationDetails(day) {
            const reservationDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
            document.getElementById("reservationDate").textContent = reservationDate.toLocaleDateString("id-ID", { weekday: "long", day: "numeric", month: "long", year: "numeric" });

            const reservationList = document.getElementById("reservationList");
            reservationList.innerHTML = "";

            if (reservations[day]) {
                reservations[day].forEach(res => {
                    let row = `<tr><td>${res.nama}</td><td>${res.paket}</td><td>${res.waktu}</td><td>${res.lokasi}</td></tr>`;
                    reservationList.innerHTML += row;
                });
                document.getElementById("bookedCount").textContent = reservations[day].length;
                document.getElementById("remainingQuota").textContent = 10 - reservations[day].length;
            } else {
                document.getElementById("bookedCount").textContent = 0;
                document.getElementById("remainingQuota").textContent = 10;
            }

            modal.show();
        }

        prevMonthBtn.addEventListener("click", function () {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthBtn.addEventListener("click", function () {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        yearFilter.addEventListener("change", function () {
            currentDate.setFullYear(parseInt(this.value));
            renderCalendar();
        });

        generateYearOptions();
        renderCalendar();
    });

</script>

<!-- Deskripsi & Harga Paket Layanan -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const paketSelect = document.getElementById('paketLayanan');
    const deskripsiTextarea = document.getElementById('deskripsiPaket');
    const hargaDisplay = document.getElementById('hargaPaket');

    paketSelect.addEventListener('change', function() {
        const selectedOption = paketSelect.options[paketSelect.selectedIndex];
        const deskripsi = selectedOption.getAttribute('data-deskripsi');
        const harga = selectedOption.getAttribute('data-harga');
        
        deskripsiTextarea.value = deskripsi || '';
        hargaDisplay.textContent = harga ? 'Rp ' + harga : 'Rp 0';
    });

    // Trigger change event initially if there's a selected value
    if (paketSelect.value) {
        paketSelect.dispatchEvent(new Event('change'));
    }
});
</script>

<!-- SweetAlert Batalkan Pemesanan Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmCancel(pemesananId) {
        Swal.fire({
            title: "Batalkan Pemesanan",
            text: "Apakah Anda yakin ingin membatalkan pemesanan ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Batalkan",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancelForm' + pemesananId).submit();
            }
        });
    }

    // SweetAlert Menyelesaikan Pemesanan
    function confirmComplete(pemesananId) {
        Swal.fire({
            title: "Konfirmasi Penyelesaian",
            text: "Apakah Anda yakin ingin menyelesaikan pemesanan ini?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Selesaikan",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form secara langsung
                document.getElementById(`completeForm${pemesananId}`).submit();
            }
        });
    }
</script>

<!-- CTA to Tab Reservasi -->
<script>
function activateReservasiTab() {
    // Pastikan Bootstrap Tab tersedia
    if (typeof bootstrap !== 'undefined') {
        const reservasiTab = new bootstrap.Tab(document.querySelector('#reservasi-tab'));
        reservasiTab.show();
    }
}

// Aktifkan tab Reservasi secara otomatis jika URL memiliki hash #reservasi
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash === '#reservasi') {
        activateReservasiTab();
    }
});
</script>

<?= $this->endSection() ?>