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

        /* FORM RESERVASI */
        .reservasi-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        /* Dropdown paket layanan */
        .dropdown-paket {
            position: relative;
        }
        
        .dropdown-paket .dropdown-menu {
            width: 100%;
            padding: 0;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .dropdown-paket .dropdown-toggle::after {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .dropdown-paket #paketOptionsContainer {
            scrollbar-width: thin;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .dropdown-paket #paketOptionsContainer::-webkit-scrollbar {
            width: 5px;
        }
        
        .dropdown-paket #paketOptionsContainer::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .dropdown-paket #paketOptionsContainer::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }
        
        .dropdown-paket #paketOptionsContainer::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        .dropdown-paket .paket-option {
            white-space: normal;
            padding: 8px 16px;
        }
        
        .dropdown-paket .paket-option:hover, 
        .dropdown-paket .paket-option:focus {
            background-color: #f8f9fa;
            color: #212529;
        }
        
        .dropdown-paket .dropdown-item.active, 
        .dropdown-paket .dropdown-item:active {
            background-color: #212529;
        }
        
        .dropdown-paket .form-select {
            text-align: left;
            padding-right: 2.5rem;
        }
        
        .dropdown-paket .search-container {
            padding: 0.5rem;
        }
        
        .dropdown-paket .dropdown-divider {
            margin: 0;
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
            flex-shrink: 0;
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

        /* Responsive */
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
                    <h4 id="calendarMonth" class="text-dark fw-bold"></h4>
                    <div class="calendar-controls">
                        <button class="btn btn-outline-dark btn-sm" id="prevMonth">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="btn btn-outline-dark btn-sm" id="nextMonth">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        <select id="yearFilter" class="form-select form-select-sm shadow-sm"></select>
                    </div>
                </div>
                <div class="table-responsive shadow-sm rounded">
                    <table class="table text-center calendar-table">
                        <thead class="table-light">
                            <tr>
                                <th>Senin</th>
                                <th>Selasa</th>
                                <th>Rabu</th>
                                <th>Kamis</th>
                                <th>Jumat</th>
                                <th>Sabtu</th>
                                <th>Minggu</th>
                            </tr>
                        </thead>
                        <tbody id="calendarBody"></tbody>
                    </table>
                </div>
                <div class="calendar-note text-muted mt-3">
                    <p><small><strong>Catatan:</strong></p>
                    <ul>
                        <li>Paket layanan <strong>Wedding</strong> dibatasi maksimal 3 pemesanan per hari, sedangkan layanan lainnya tidak memiliki batasan kuota.</li>
                        <li>Tanggal dengan tanda <span style="color: red;">■</span> menunjukkan tanggal yang telah berhasil dipesan.</li>
                        <li>Tanggal dengan tanda <span style="color: yellow;">■</span> menunjukkan pemesanan dengan Paket Layanan Wedding.</li>
                        <li>Tanggal kosong berwarna hijau menunjukkan ketersediaan untuk pemesanan baru.</li>
                    </ul>
                </small></p>
                </div>
            </div>

            <!-- Modal Bootstrap -->
            <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header text-center bg-dark text-white">
                            <h5 class="modal-title w-100 fw-bold">Detail Reservasi</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                <div class="quota-info">
                                    <span class="badge bg-danger me-2"><i class="bi bi-bookmark-check"></i> Sudah Reservasi: <span id="bookedCount">0</span></span>
                                    <span class="badge bg-success"><i class="bi bi-bookmark-plus"></i> Sisa Kuota Wedding: <span id="remainingQuota">3</span></span>
                                </div>
                                <h6 class="fw-bold">Tanggal: <span id="reservationDate"></span></h6>
                            </div>
                            <p class="text-muted small mb-6"><strong>Info Kuota:</strong></p>
                                <ul class="text-muted small">
                                    <li>Tanda berwarna merah menunjukkan paket layanan yang telah dipesan secara keseluruhan.</li>
                                    <li>Tanda berwarna hijau menunjukkan ketersediaan kuota untuk Paket Layanan Wedding.</li>
                                </ul>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-center">
                                    <thead class="table-dark">
                                        <tr id="tableHeader">
                                            <!-- Header akan diisi oleh JavaScript berdasarkan role -->
                                        </tr>
                                    </thead>
                                    <tbody id="reservationList"></tbody>
                                </table>
                            </div>
                            <div class="calendar-note text-muted mt-3">
                                <p><small><strong>Catatan:</strong> Paket layanan <strong>Wedding</strong> dibatasi maksimal 3 pemesanan per hari, sedangkan layanan lainnya tidak memiliki batasan kuota.</small></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
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
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <p class="form-control-plaintext"><?= esc($user_data['nama_lengkap'] ?? '-') ?></p>
                                <input type="hidden" name="nama_lengkap" value="<?= esc($user_data['nama_lengkap'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p class="form-control-plaintext"><?= esc($user_data['email'] ?? '-') ?></p>
                                <input type="hidden" name="email" value="<?= esc($user_data['email'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nomor Telepon</label>
                                <p class="form-control-plaintext"><?= esc($user_data['no_telepon'] ?? '-') ?></p>
                                <input type="hidden" name="telepon" value="<?= esc($user_data['no_telepon'] ?? '') ?>">
                            </div>
                            <?php
                                $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$waktuSekarang = $now->format('Y-m-d\TH:i');
?>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Waktu Pemesanan</label>
                                <p class="form-control-plaintext"><?= date('d-m-Y H:i', strtotime($waktuSekarang)) ?></p>
                                <input type="hidden" name="waktu_pemesanan" value="<?= $waktuSekarang ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Paket Layanan</label>
                                <div class="dropdown dropdown-paket">
                                    <button class="form-select dropdown-toggle" type="button" id="dropdownPaketButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span id="selectedPaketText">Pilih Paket Layanan</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownPaketButton">
                                        <div class="search-container">
                                            <input type="text" class="form-control" id="searchPaketInput" placeholder="Cari paket..." autocomplete="off">
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <div id="paketOptionsContainer">
                                            <?php foreach ($paket_layanan as $paket): ?>
                                                <a class="dropdown-item paket-option" href="#" 
                                                    data-value="<?= $paket['id'] ?>"
                                                    data-deskripsi="<?= htmlspecialchars($paket['benefit']) ?>"
                                                    data-harga="<?= number_format($paket['harga'], 0, ',', '.') ?>"
                                                    data-jenis-layanan="<?= esc($paket['jenis_layanan'] ?? 'Event Lainnya') ?>"
                                                    <?= (isset($_GET['paket_id']) && $_GET['paket_id'] == $paket['id']) ? 'data-selected="true"' : '' ?>>
                                                    <?= esc($paket['nama']) . ' (' . esc($paket['jenis_layanan'] ?? 'Event Lainnya') . ')' ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="paket_layanan" id="paketLayanan" value="" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Paket</label>
                                <div class="form-control-plaintext" id="deskripsiPaket" style="min-height: 100px; cursor: default; background-color: transparent; border: 1px solid #ced4da; padding: 10px;">-</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <p class="form-control-plaintext fw-bold" id="hargaPaket">Rp 0</p>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Waktu Pemotretan</label>
                                <input type="datetime-local" name="waktu_pemotretan" id="waktuPemotretan" 
                                    class="form-control" value="<?= $waktuSekarang ?>" required>
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
                            <div class="mb-3" id="lokasiPengirimanField" style="display: none;">
                                <label class="form-label">Lokasi Pengiriman Album (Link Maps)</label>
                                <input type="text" name="link_maps_pengiriman" class="form-control"
                                    placeholder="Masukkan link Google Maps lokasi pengiriman album">
                            </div>
                            <div class="mb-3" id="namaMempelaiField" style="display: none;">
                                <label class="form-label">Nama Mempelai Pria & Wanita</label>
                                <input type="text" name="nama_mempelai" class="form-control"
                                    placeholder="Masukkan nama mempelai pria & wanita">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Username Instagram</label>
                                <p class="form-control-plaintext"><?= esc($user_data['instagram'] ?? '-') ?></p>
                                <input type="hidden" name="instagram" value="<?= esc($user_data['instagram'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Kirim Reservasi</button>
                    <!-- Catatan Pembayaran -->
                    <div class="mt-4 p-3 border rounded bg-light">
                        <h6 class="text-danger"><strong>Catatan:</strong></h6>
                        <ul class="mb-0">
                            <li>DP sebesar 30% dari harga paket layanan.</li>
                            <li>Pembayaran DP maksimal H-3 sebelum acara.</li>
                            <li>Proses editing dan pencetakan dilakukan setelah pelunasan.</li>
                            <li>Estimasi pengerjaan album sekitar 1-2 minggu.</li>
                            <li>Paket layanan Wedding hanya tersedia untuk 3 pemesanan aktif per hari berdasarkan tanggal pemotretan.</li>
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
                                            <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" 
                                                    type="button" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#collapse<?= $index ?>" 
                                                    aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" 
                                                    aria-controls="collapse<?= $index ?>">
                                                <div class="d-flex flex-column flex-md-row w-100 gap-3">
                                                    <div>
                                                        <span class="badge bg-white bg-opacity-15 text-dark">Paket</span>
                                                        <strong class="ms-1"><?= esc($pemesanan['nama_paket'] ?? '-') ?></strong>
                                                    </div>
                                                    <?php if (in_array(strtolower($pemesanan['jenis_layanan']), ['wedding', 'pre-wedding', 'engagement'])): ?>
                                                        <div>
                                                            <span class="badge bg-white bg-opacity-15 text-dark">Mempelai</span>
                                                            <strong class="ms-1"><?= esc($pemesanan['nama_mempelai'] ?? '-') ?></strong>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse<?= $index ?>" 
                                            class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" 
                                            data-bs-parent="#paymentAccordion">
                                            <div class="accordion-body pt-3">
                                                <div class="row mb-4">
                                                    <div class="col-md-3">
                                                    <div class="media-container" style="height: 150px; overflow: hidden;">
                                                        <?php if (!empty($pemesanan['foto'])): ?>
                                                            <img src="<?= base_url($pemesanan['foto']) ?>" 
                                                                class="img-fluid rounded-3 w-100 h-100 object-fit-cover" 
                                                                alt="<?= esc($pemesanan['nama_paket']) ?>" loading="lazy">
                                                        <?php else: ?>
                                                            <div class="bg-light rounded-3 w-100 h-100 d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-image fa-3x text-muted"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h5><?= esc($pemesanan['nama_paket']) ?></h5>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span class="badge bg-secondary bg-opacity-10 text-body-secondary me-2">Jenis Layanan</span>
                                                            <span class="fw-bold"><?= esc($pemesanan['jenis_layanan'] ?? 'Event Lainnya') ?></span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span class="badge bg-secondary bg-opacity-10 text-body-secondary me-2">Harga Paket</span>
                                                            <span class="fw-bold">Rp <?= number_format($pemesanan['harga'], 0, ',', '.') ?></span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span class="badge bg-secondary bg-opacity-10 text-body-secondary me-2">Tanggal & Waktu Pemotretan</span>
                                                            <span class="fw-bold"><?= date('d M Y H:i', strtotime($pemesanan['waktu_pemotretan'])) ?> WIB</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span class="badge bg-secondary bg-opacity-10 text-body-secondary me-2">Jenis Pembayaran</span>
                                                            <span class="fw-bold"><?= esc($pemesanan['jenis_pembayaran']) ?></span>
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
                                                                                    <span class="badge bg-warning bg-opacity-10 text-warning ms-2">30%</span>
                                                                                <?php elseif ($bayar['jenis'] === 'Pelunasan'): ?>
                                                                                    <span class="badge bg-<?= $pemesanan['jenis_pembayaran'] === 'DP' ? 'warning' : 'success' ?> bg-opacity-10 text-<?= $pemesanan['jenis_pembayaran'] === 'DP' ? 'warning' : 'success' ?> ms-2">
                                                                                        <?= $pemesanan['jenis_pembayaran'] === 'DP' ? '70%' : '100%' ?>
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
                                                                            <?php if ($bayar['status'] === 'pending'): ?>
                                                                                <button onclick="bayarSekarang(<?= $bayar['id'] ?>)" 
                                                                                    class="btn btn-outline-dark w-100"
                                                                                    id="payButton<?= $bayar['id'] ?>">
                                                                                <i class="fa-solid fa-credit-card me-1"></i> Bayar Sekarang
                                                                            </button>
                                                                            <?php endif; ?>
                                                                            <div class="alert alert-info small p-2 mt-3 mb-0">
                                                                                <i class="fa-solid fa-circle-info me-2"></i>
                                                                                <?php if ($pemesanan['jenis_pembayaran'] === 'DP'): ?>
                                                                                    <?php if ($bayar['jenis'] === 'DP'): ?>
                                                                                        Segera bayar maksimal H-3 sebelum pemotretan agar pemesanan terproses. Jika tidak, pemesanan akan otomatis dibatalkan.
                                                                                    <?php elseif ($bayar['jenis'] === 'Pelunasan'): ?>
                                                                                        Segera bayar pelunasan setelah pemotretan agar pemesanan segera masuk proses editing.
                                                                                    <?php endif; ?>
                                                                                <?php else: ?>
                                                                                    Segera bayar maksimal H-3 sebelum pemotretan agar pemesanan terproses. Jika tidak, pemesanan akan otomatis dibatalkan.
                                                                                <?php endif; ?>
                                                                            </div>
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
                                                        <!-- Button cancel jika pembayaran masih pending -->
                                                        <?php if ($canCancel): ?>
                                                            <div class="col-12 mt-3">
                                                                <form action="<?= base_url('user/pemesanan/batal/' . $pemesanan['id']) ?>" 
                                                                    method="post" 
                                                                    id="cancelForm<?= $pemesanan['id'] ?>">
                                                                    <?= csrf_field() ?>
                                                                    <button type="button" 
                                                                            class="btn btn-danger w-100" 
                                                                            onclick="confirmCancel(<?= $pemesanan['id'] ?>)">
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
                                            <span class="badge bg-white bg-opacity-15 text-dark">Jenis Layanan</span>
                                            <strong class="ms-1"><?= esc($pemesanan['jenis_layanan'] ?? '-') ?></strong>
                                        </div>
                                        <?php if (in_array(strtolower($pemesanan['jenis_layanan']), ['wedding', 'pre-wedding', 'engagement'])): ?>
                                            <div>
                                                <span class="badge bg-white bg-opacity-15 text-dark">Mempelai</span>
                                                <strong class="ms-1"><?= esc($pemesanan['nama_mempelai'] ?? '-') ?></strong>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </button>
                            </h2>
                            <div id="trackingCollapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#trackingAccordion">
                                <div class="accordion-body pt-4 pb-4">
                                    <h4 class="text-center mb-4 fw-bold">Proses Pemesanan</h4>
                                    <div class="tracking-container">
                                        <?php
                                        // Determine steps based on service type
                                        $isWedding = strtolower($pemesanan['jenis_layanan'] ?? '') === 'wedding';

                            $steps = [
                                'Pemesanan' => ['icon' => 'fa-calendar-check', 'label' => 'Pemesanan'],
                                'Pemotretan' => ['icon' => 'fa-camera', 'label' => 'Pemotretan'],
                                'Editing' => ['icon' => 'fa-pen-to-square', 'label' => 'Editing'],
                            ];

                            // Add printing step only for wedding services
                            if ($isWedding) {
                                $steps['Pencetakan'] = ['icon' => 'fa-print', 'label' => 'Pencetakan'];
                            }

                            $steps['Pengiriman'] = ['icon' => 'fa-truck', 'label' => 'Pengiriman'];

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
                                                        <i class="fa-solid <?= $step['icon'] ?>"></i>
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
                                        <?php if ($pemesanan['status'] === 'Pengiriman' || $pemesanan['status'] === 'Selesai'): ?>
                                            <div class="alert alert-light border rounded-4 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-photo-film text-dark me-3 fs-4"></i>
                                                    <div>
                                                        <strong class="d-block mb-1">Hasil Foto</strong>
                                                        <?php if (!empty($pemesanan['link_hasil_foto'])): ?>
                                                            <a href="<?= esc($pemesanan['link_hasil_foto']) ?>" class="text-primary" target="_blank">
                                                                <i class="fa-solid fa-link me-1"></i> Klik untuk melihat hasil foto di Google Drive
                                                            </a>
                                                        <?php else: ?>
                                                            <span class="text-muted">Link hasil foto belum tersedia</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php if ($pemesanan['status'] === 'Pengiriman'): ?>
                                                <form action="<?= base_url('user/pemesanan/selesai/' . $pemesanan['id']) ?>" method="post" id="completeForm<?= $pemesanan['id'] ?>">
                                                    <?= csrf_field() ?>
                                                    <button type="button" class="btn btn-dark w-100 mt-3" onclick="confirmComplete(<?= $pemesanan['id'] ?>)">
                                                        <i class="fa-solid fa-check-circle me-1"></i> Selesai Pesanan
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            
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
                                        <h5 class="card-title mb-0"><?= $riwayat['nama_paket'] ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Jenis Layanan:</span>
                                            <strong><?= $riwayat['jenis_layanan'] ?></strong>
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
                                            <span class="text-muted">Instagram:</span>
                                            <a href="https://instagram.com/<?= $riwayat['instagram'] ?>" 
                                            target="_blank" class="text-decoration-none">
                                            @<?= $riwayat['instagram'] ?>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Link Hasil Foto:</span>
                                            <?php if (!empty($riwayat['link_hasil_foto'])): ?>
                                                <a href="<?= esc($riwayat['link_hasil_foto']) ?>" target="_blank">Lihat Hasil Foto</a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </div> 

                                    </div>
                                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                        <span class="badge rounded-pill bg-dark p-2">
                                            <i class="fas fa-check-circle me-1"></i> <?= $riwayat['status'] ?>
                                        </span>
                                        <small class="text-muted">
                                            Selesai: <?= date('d M Y H:i', strtotime($riwayat['status_selesai_at'])) ?>
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
        confirmButtonText: 'Lengkapi Sekarang',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('user/profile') ?>';
        }
    });
</script>
<?php endif; ?>


<!-- Ketersediaan Jadwal -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="<?= base_url('assets/js/calendar.js') ?>"></script>


<!-- Include DOMPurify for sanitizing HTML (optional but recommended) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.1/purify.min.js"></script>

<!-- JavaScript untuk Paket Layanan, Deskripsi, dan Harga -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownPaketButton');
    const searchInput = document.getElementById('searchPaketInput');
    const paketOptionsContainer = document.getElementById('paketOptionsContainer');
    const selectedPaketText = document.getElementById('selectedPaketText');
    const paketLayananInput = document.getElementById('paketLayanan');
    const deskripsiDiv = document.getElementById('deskripsiPaket');
    const hargaDisplay = document.getElementById('hargaPaket');
    const waktuPemotretanInput = document.getElementById('waktuPemotretan');
    const lokasiPengirimanField = document.getElementById('lokasiPengirimanField');
    const namaMempelaiField = document.getElementById('namaMempelaiField');
    const csrfName = '<?= csrf_token() ?>';
    const csrfHash = '<?= csrf_hash() ?>';
    
    // Inisialisasi pilihan jika ada di URL
    const selectedOption = document.querySelector('.paket-option[data-selected="true"]');
    if (selectedOption) {
        selectPaketOption(selectedOption);
    }
    
    // Fungsi untuk memilih opsi paket
    function selectPaketOption(optionElement) {
        const value = optionElement.getAttribute('data-value');
        const text = optionElement.textContent;
        const deskripsi = optionElement.getAttribute('data-deskripsi');
        const harga = optionElement.getAttribute('data-harga');
        const jenisLayanan = optionElement.getAttribute('data-jenis-layanan');
        
        // Update tampilan
        selectedPaketText.textContent = text;
        paketLayananInput.value = value;
        
        // Update deskripsi dan harga
        deskripsiDiv.innerHTML = deskripsi ? DOMPurify.sanitize(deskripsi) : '-';
        hargaDisplay.textContent = harga ? 'Rp ' + harga : 'Rp 0';
        
        // Kontrol visibilitas field berdasarkan jenis layanan
        const jenisLayananLower = jenisLayanan ? jenisLayanan.toLowerCase() : '';
        if (jenisLayananLower === 'wedding') {
            lokasiPengirimanField.style.display = 'block';
            namaMempelaiField.style.display = 'block';
            lokasiPengirimanField.querySelector('input').required = true;
            namaMempelaiField.querySelector('input').required = true;
        } else if (['pre-wedding', 'engagement'].includes(jenisLayananLower)) {
            lokasiPengirimanField.style.display = 'none';
            namaMempelaiField.style.display = 'block';
            lokasiPengirimanField.querySelector('input').required = false;
            namaMempelaiField.querySelector('input').required = true;
        } else {
            lokasiPengirimanField.style.display = 'none';
            namaMempelaiField.style.display = 'none';
            lokasiPengirimanField.querySelector('input').required = false;
            namaMempelaiField.querySelector('input').required = false;
        }
        
        // Tutup dropdown
        const dropdown = new bootstrap.Dropdown(dropdownButton);
        dropdown.hide();
        
        // Cek ketersediaan jika waktu pemotretan sudah dipilih
        if (waktuPemotretanInput.value) {
            checkAvailability(value, waktuPemotretanInput.value);
        }
    }
    
    // Fungsi untuk memfilter opsi
    function filterPaketOptions() {
        const filter = searchInput.value.toUpperCase();
        const options = paketOptionsContainer.getElementsByClassName('paket-option');
        
        for (let i = 0; i < options.length; i++) {
            const text = options[i].textContent || options[i].innerText;
            if (text.toUpperCase().indexOf(filter) > -1) {
                options[i].style.display = "";
            } else {
                options[i].style.display = "none";
            }
        }
    }
    
    // Fungsi untuk mengecek ketersediaan
    function checkAvailability(paketId, waktuPemotretan) {
        fetch('<?= base_url('user/pemesanan/check-availability') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                [csrfName]: csrfHash
            },
            body: JSON.stringify({ paket_id: paketId, waktu_pemotretan: waktuPemotretan })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.is_available) {
                // Tandai opsi yang tidak tersedia
                const selectedOption = document.querySelector(`.paket-option[data-value="${paketId}"]`);
                if (selectedOption) {
                    selectedOption.textContent += ' (Penuh)';
                    selectedOption.classList.add('disabled');
                    selectedOption.style.color = '#dc3545';
                    selectedOption.style.textDecoration = 'line-through';
                    selectedOption.onclick = function(e) {
                        e.preventDefault();
                        alert(data.message);
                    };
                    
                    // Reset pilihan jika yang dipilih tidak tersedia
                    if (paketLayananInput.value == paketId) {
                        selectedPaketText.textContent = 'Pilih Paket Layanan';
                        paketLayananInput.value = '';
                        deskripsiDiv.innerHTML = '-';
                        hargaDisplay.textContent = 'Rp 0';
                        lokasiPengirimanField.style.display = 'none';
                        namaMempelaiField.style.display = 'none';
                        lokasiPengirimanField.querySelector('input').required = false;
                        namaMempelaiField.querySelector('input').required = false;
                    }
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // Event listeners
    searchInput.addEventListener('keyup', filterPaketOptions);
    
    // Klik opsi paket
    const options = document.querySelectorAll('.paket-option');
    options.forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            if (!this.classList.contains('disabled')) {
                selectPaketOption(this);
            }
        });
    });
    
    // Event untuk waktu pemotretan
    if (waktuPemotretanInput) {
        waktuPemotretanInput.addEventListener('change', function() {
            if (paketLayananInput.value) {
                checkAvailability(paketLayananInput.value, this.value);
            }
        });
    }
    
    // Inisialisasi saat halaman dimuat
    if (paketLayananInput.value) {
        const selectedOption = document.querySelector(`.paket-option[data-value="${paketLayananInput.value}"]`);
        if (selectedOption) {
            selectPaketOption(selectedOption);
        }
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

    // SweetAlert Menyelesaikan Pemesanan di Tracking
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
                document.getElementById(`completeForm${pemesananId}`).submit();
            }
        });
    }
</script>

<!-- CTA to Tab Reservasi -->
<script>
function activateReservasiTab() {
    if (typeof bootstrap !== 'undefined') {
        const reservasiTab = new bootstrap.Tab(document.querySelector('#reservasi-tab'));
        reservasiTab.show();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash === '#reservasi') {
        activateReservasiTab();
    }
});
</script>

<script>
async function bayarSekarang(paymentId) {
    const btn = event.target;
    try {
        // Tampilkan loading
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Memproses...';
        btn.disabled = true;

        // Panggil API pembayaran
        const response = await fetch(`<?= base_url('user/pembayaran/bayar/') ?>${paymentId}`);
        const data = await response.json();

        if (data.status !== 'success') {
            throw new Error(data.message || 'Gagal memulai pembayaran');
        }

        // Buka halaman baru untuk pembayaran
        if (data.redirect_url) {
            window.open(data.redirect_url, '_blank');

            // Periksa status pembayaran setiap 5 detik
            const checkPayment = setInterval(async () => {
                const statusResponse = await fetch(`<?= base_url('user/pembayaran/check-status/') ?>${data.order_id}`);
                const statusData = await statusResponse.json();

                if (statusData.status === 'settlement' || statusData.status === 'success') {
                    clearInterval(checkPayment);
                    window.location.href = `<?= base_url('user/pembayaran/finish?status=success&order_id=') ?>${data.order_id}`;
                } else if (statusData.status === 'expire' || statusData.status === 'deny' || statusData.status === 'cancel') {
                    clearInterval(checkPayment);
                    window.location.href = `<?= base_url('user/pembayaran/finish?status=error&order_id=') ?>${data.order_id}`;
                }
            }, 5000);

            // Berhenti polling setelah 5 menit
            setTimeout(() => clearInterval(checkPayment), 300000);
        } else {
            throw new Error('Tidak dapat mendapatkan URL pembayaran');
        }
    } catch (error) {
        console.error('Payment Error:', error);
        alert(error.message);
        window.location.reload();
    } finally {
        btn.innerHTML = '<i class="fa-solid fa-credit-card me-1"></i> Bayar Sekarang';
        btn.disabled = false;
    }
}
</script>

<?= $this->endSection() ?>