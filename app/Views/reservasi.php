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
            gap: var(--gap-size, 60px);
            /* Mengurangi jarak antar proses */
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

        .tracking-estimate {
            margin-top: 60px;
            font-size: 18px;
            color: grey;
            text-align: center;
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
                                            <!-- Data reservasi akan ditambahkan via JavaScript -->
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
            <div class="tab-pane fade" id="reservasi">
                <div class="reservasi-card" style="max-width: 1000px;"> <!-- Memperlebar card -->
                    <h4 class="text-center mb-3">Formulir Reservasi</h4>
                    <form>
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama lengkap"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Masukkan email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" placeholder="Masukkan nomor telepon"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Waktu Pemesanan</label>
                                    <input type="datetime-local" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Paket Layanan</label>
                                    <select class="form-select" id="paketLayanan" required>
                                        <option value="" selected disabled>Pilih Paket Layanan</option>
                                        <option value="silver">Paket Silver</option>
                                        <option value="gold">Paket Gold</option>
                                        <option value="platinum">Paket Platinum</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Paket</label>
                                    <textarea class="form-control" id="deskripsiPaket" readonly rows="3"
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Waktu Pemotretan</label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Pembayaran</label>
                                    <select class="form-select" required>
                                        <option value="" selected disabled>Pilih Jenis Pembayaran</option>
                                        <option>Lunas</option>
                                        <option>DP (Down Payment)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Metode Pembayaran</label>
                                    <select class="form-select" required>
                                        <option value="" selected disabled>Pilih Metode Pembayaran</option>
                                        <option>Transfer Bank</option>
                                        <option>Kartu Kredit</option>
                                        <option>e-Wallet</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lokasi Pemotretan (Ex. Rogojampi/Srono/Banyuwangi)</label>
                                    <input type="text" class="form-control" placeholder="Masukkan lokasi pemotretan"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lokasi Pemotretan (Link Maps)</label>
                                    <input type="text" class="form-control" placeholder="Masukkan lokasi pemotretan"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lokasi Pengiriman Album (Link Maps)</label>
                                    <input type="text" class="form-control"
                                        placeholder="Masukkan lokasi pengiriman album" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Mempelai Pria & Wanita</label>
                                    <input type="text" class="form-control"
                                        placeholder="Masukkan nama mempelai pria & wanita" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Link Instagram</label>
                                    <input type="text" class="form-control" placeholder="Masukkan link Instagram"
                                        required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Kirim Reservasi</button>
                        <!-- Catatan Pembayaran -->
                        <div class="mt-4 p-3 border rounded bg-light">
                            <h6 class="text-danger"><strong>Catatan:</strong></h6>
                            <ul class="mb-0">
                                <li>DP Minimal 500rb</li>
                                <li>Pelunasan Maksimal H+3 Setelah Acara</li>
                                <li>Setelah Ada Pelunasan Baru kami edit dan Cetak</li>
                                <li>(Pengerjaan Album Kisaran 2-4 Minggu)</li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tracking -->
            <div class="tab-pane fade" id="tracking">
                <h4 class="text-center mb-4">Tracking Proses</h4>
                <div class="d-flex justify-content-center text-center tracking-container" style="--gap-size: 60px;">
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
                <div class="tracking-estimate">Pesanan Anda diperkirakan selesai pada 21 Desember 2024.</div>
            </div>


            <!-- Riwayat -->
            <div class="tab-pane fade" id="riwayat">
                <h4 class="text-center mb-4">Riwayat Pemesanan</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Metode Pembayaran</th>
                                <th>Waktu Pemesanan</th>
                                <th>Jenis Layanan</th>
                                <th>Paket Layanan</th>
                                <th>Harga</th>
                                <th>Waktu Pemotretan</th>
                                <th>Lokasi Pemotretan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>+62 812-3456-7890</td>
                                <td>johndoe@email.com</td>
                                <td>Transfer Bank</td>
                                <td>2024-09-18 14:30</td>
                                <td>Fotografi</td>
                                <td>Wedding</td>
                                <td>Rp 5.000.000</td>
                                <td>2024-09-20 10:00</td>
                                <td>Jakarta</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Smith</td>
                                <td>+62 813-9876-5432</td>
                                <td>janesmith@email.com</td>
                                <td>Kartu Kredit</td>
                                <td>2024-09-17 09:45</td>
                                <td>Videografi</td>
                                <td>Prewedding</td>
                                <td>Rp 3.500.000</td>
                                <td>2024-09-22 15:30</td>
                                <td>Bandung</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Michael Lee</td>
                                <td>+62 815-6543-2109</td>
                                <td>michaellee@email.com</td>
                                <td>e-Wallet</td>
                                <td>2024-09-16 18:20</td>
                                <td>Fotografi</td>
                                <td>Family Portrait</td>
                                <td>Rp 2.000.000</td>
                                <td>2024-09-25 11:00</td>
                                <td>Surabaya</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Lisa Wong</td>
                                <td>+62 819-2233-4455</td>
                                <td>lisawong@email.com</td>
                                <td>Transfer Bank</td>
                                <td>2024-09-15 20:00</td>
                                <td>Fotografi & Videografi</td>
                                <td>Corporate Event</td>
                                <td>Rp 7.500.000</td>
                                <td>2024-09-30 08:00</td>
                                <td>Yogyakarta</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>David Kim</td>
                                <td>+62 812-1122-3344</td>
                                <td>davidkim@email.com</td>
                                <td>e-Wallet</td>
                                <td>2024-09-14 16:10</td>
                                <td>Videografi</td>
                                <td>Music Video</td>
                                <td>Rp 10.000.000</td>
                                <td>2024-10-02 19:00</td>
                                <td>Bali</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</body>

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

<script>
    document.getElementById("paketLayanan").addEventListener("change", function () {
        let paket = this.value;
        let deskripsiPaket = document.getElementById("deskripsiPaket");
        let hargaPaket = document.getElementById("hargaPaket");

        let paketData = {
            silver: {
                deskripsi: "Paket Silver mencakup sesi foto 2 jam dengan 30 hasil editan terbaik.",
                harga: "Rp 2.000.000"
            },
            gold: {
                deskripsi: "Paket Gold mencakup sesi foto 4 jam dengan 60 hasil editan terbaik dan album cetak.",
                harga: "Rp 4.500.000"
            },
            platinum: {
                deskripsi: "Paket Platinum mencakup sesi foto 6 jam, unlimited hasil editan, album premium, dan video highlight.",
                harga: "Rp 8.000.000"
            }
        };

        if (paketData[paket]) {
            deskripsiPaket.value = paketData[paket].deskripsi;
            hargaPaket.value = paketData[paket].harga;
        } else {
            deskripsiPaket.value = "";
            hargaPaket.value = "";
        }
    });
</script>

<?= $this->endSection() ?>