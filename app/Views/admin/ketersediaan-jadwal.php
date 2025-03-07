<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<!-- Custom Styles -->
<style>
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
        color: red !important;
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
        color: green !important;
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
</style>

<div class="title mt-4">
    <h3 class="text-start text-dark fw-bold">Ketersediaan Jadwal</h3>
</div>

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
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100 fw-bold">Detail Reservasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <span class="badge bg-danger small">Sudah Reservasi: <span id="bookedCount">3</span></span>
                        <span class="badge bg-success small">Sisa Kuota Reservasi: <span
                                id="remainingQuota">5</span></span>
                    </div>
                    <h6 class="fw-bold">Tanggal: <span id="reservationDate">Senin, 25 September 2024</span></h6>
                </div>

                <!-- Tabel Pengguna -->
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Layanan</th>
                                <th>Paket Layanan</th>
                                <th>Waktu</th>
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
                    <p><small>*Dalam 1 Hari Tidak Ada Batasan untuk Jenis Layanan Selain Wedding.</small></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

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
            5: [{ nama: "John Doe", layanan: "Spa", paket: "Premium", waktu: "10:00", lokasi: "Room A" }],
            14: [{ nama: "Jane Doe", layanan: "Salon", paket: "Haircut", waktu: "14:00", lokasi: "Room B" }]
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
                    let row = `<tr><td>${res.nama}</td><td>${res.layanan}</td><td>${res.paket}</td><td>${res.waktu}</td><td>${res.lokasi}</td></tr>`;
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

<?= $this->endSection() ?>