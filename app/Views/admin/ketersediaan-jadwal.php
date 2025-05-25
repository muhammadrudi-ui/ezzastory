<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<style>
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
        background-color: #343a40;
        color: white;
    }

    .calendar-table th,
    .calendar-table td {
        padding: 10px;
        text-align: center;
        vertical-align: middle;
        height: 80px;
        border: 1uji solid #ddd;
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
        min-width: 100px;
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
</style>

<div class="title mt-4">
    <h3 class="text-start text-dark fw-bold">Ketersediaan Jadwal</h3>
</div>

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
        <p><small><strong>Catatan:</strong> Paket layanan <strong>Wedding</strong> dibatasi maksimal 3 pemesanan per hari. Layanan lainnya tidak memiliki batasan kuota.</small></p>
    </div>
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
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
                <p class="text-muted small mb-3"><strong>Info Kuota:</strong> Kuota di atas hanya berlaku untuk paket layanan Wedding (maksimal 3 per hari). Layanan lain tidak dibatasi.</p>
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
                    <p><small><strong>Catatan:</strong> Paket layanan <strong>Wedding</strong> dibatasi maksimal 3 pemesanan per hari. Layanan lainnya tidak memiliki batasan kuota.</small></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript Kalender -->
<script src="<?= base_url('assets/js/calendar.js') ?>"></script>

<?= $this->endSection() ?>