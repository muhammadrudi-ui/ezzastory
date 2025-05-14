<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="title mt-4">
    <h3 class="text-start text-dark fw-bold">Dashboard</h3>
</div>

<!-- Mengambil data pada bulan ini -->
<div class="row mt-4">
    <div class="col-12 col-sm-6 col-md-3 mb-3">
        <div class="card p-3 shadow-sm text-center">
            <h6 class="text-muted mb-1">Pendapatan Bulan Ini</h6>
            <h4 class="fw-bold mb-0">Rp. <?= number_format($pendapatan_bulan_ini, 0, ',', '.') ?></h4>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 mb-3">
        <div class="card p-3 shadow-sm text-center">
            <h6 class="text-muted mb-1">Total Pemesanan Bulan Ini</h6>
            <h4 class="fw-bold mb-0"><?= $total_pemesanan ?> Customer</h4>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 mb-3">
        <div class="card p-3 shadow-sm text-center">
            <h6 class="text-muted mb-1">Pesanan Sudah Selesai</h6>
            <h4 class="fw-bold mb-0"><?= $pesanan_selesai ?> Customer</h4>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 mb-3">
        <div class="card p-3 shadow-sm text-center">
            <h6 class="text-muted mb-1">Pesanan Dalam Proses</h6>
            <h4 class="fw-bold mb-0"><?= $pesanan_dalam_proses ?> Customer</h4>
        </div>
    </div>
</div>

<!-- Mengambil data dalam 1 tahun -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card p-4 shadow-sm">
            <h5 class="mb-3 fw-bold">Jumlah Pemesanan dalam 1 Tahun</h5>
            <div style="height: 300px;">
                <canvas id="chartPemesanan"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Inisialisasi Chart
    let ctx = document.getElementById('chartPemesanan').getContext('2d');
    let chartPemesanan = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= $chart_labels ?>,
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: <?= $chart_data ?>,
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderColor: '#007bff',
                borderWidth: 2,
                tension: 0.3,
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