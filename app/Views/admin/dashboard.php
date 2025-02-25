<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="title mt-4">
    <h3 class="text-start text-dark fw-bold">Dashboard</h3>
</div>

<div class="row mt-4">
    <div class="col-12 col-sm-6 col-lg-3 mb-3">
        <div class="card p-3 shadow-sm">
            <h5 class="text-muted">Today's Money</h5>
            <h3 class="fw-bold">$53k</h3>
            <span class="text-success">+55% than last week</span>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3 mb-3">
        <div class="card p-3 shadow-sm">
            <h5 class="text-muted">Today's Users</h5>
            <h3 class="fw-bold">2300</h3>
            <span class="text-success">+3% than last month</span>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3 mb-3">
        <div class="card p-3 shadow-sm">
            <h5 class="text-muted">Ads Views</h5>
            <h3 class="fw-bold">3,462</h3>
            <span class="text-danger">-2% than yesterday</span>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3 mb-3">
        <div class="card p-3 shadow-sm">
            <h5 class="text-muted">Sales</h5>
            <h3 class="fw-bold">$103,430</h3>
            <span class="text-success">+5% than yesterday</span>
        </div>
    </div>
</div>

<!-- Chart Jumlah Pemesanan -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card p-4 shadow-sm">
            <h5 class="mb-3 fw-bold">Jumlah Pemesanan dalam 1 Tahun</h5>
            <div style="height: 300px;"> <!-- Tambahkan batasan tinggi -->
                <canvas id="chartPemesanan"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data Dummy Jumlah Pemesanan per Bulan
    let pemesanan = {
        Jan: 120, Feb: 150, Mar: 180, Apr: 140, May: 200, Jun: 170,
        Jul: 190, Aug: 220, Sep: 160, Oct: 210, Nov: 180, Dec: 230
    };

    // Inisialisasi Chart
    let ctx = document.getElementById('chartPemesanan').getContext('2d');
    let chartPemesanan = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Object.keys(pemesanan),
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: Object.values(pemesanan),
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderColor: '#007bff',
                borderWidth: 2,
                tension: 0.3, // Membuat garis lebih halus
                pointRadius: 5,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { grid: { display: false } },
                y: { beginAtZero: true }
            }
        }
    });
</script>

<?= $this->endSection() ?>