<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>


<style>
    .transition-all {
        transition: all 0.3s ease;
    }

    .fixed-card {
        min-height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 123, 255, 0) 100%);
        pointer-events: none;
    }

    h6.text-muted {
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        max-width: 100%;
    }

    h4.fw-bold {
        font-size: 1.5rem;
        transition: color 0.3s ease;
    }

    .card:hover h4 {
        color: #212529 !important;
    }

    @media (min-width: 576px) and (max-width: 991px) {
        .fixed-card {
            min-height: 140px;
            padding: 1.25rem !important;
        }

        h6.text-muted {
            font-size: 0.85rem;
        }

        h4.fw-bold {
            font-size: 1.35rem;
        }
    }

    @media (max-width: 575.98px) {
        .fixed-card {
            min-height: 130px;
            padding: 1.25rem !important;
        }

        h6.text-muted {
            font-size: 0.8rem;
        }

        h4.fw-bold {
            font-size: 1.25rem;
        }
    }
</style>

<div class="container-fluid mt-4">
    <div class="title mb-4">
        <h3 class="text-start text-dark fw-bold">Dashboard</h3>
    </div>

    <!-- Mengambil data pada bulan ini -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card p-4 shadow-sm text-center bg-white rounded-3 position-relative overflow-hidden transition-all fixed-card" style="border: none;">
                <div class="card-overlay"></div>
                <h6 class="text-muted mb-2">Pendapatan Bulan Ini</h6>
                <h4 class="fw-bold mb-0 text-primary">Rp. <?= number_format($pendapatan_bulan_ini, 0, ',', '.') ?></h4>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card p-4 shadow-sm text-center bg-white rounded-3 position-relative overflow-hidden transition-all fixed-card" style="border: none;">
                <div class="card-overlay"></div>
                <h6 class="text-muted mb-2">Pemesanan Bulan Ini</h6>
                <h4 class="fw-bold mb-0 text-success"><?= $total_pemesanan ?> Customer</h4>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card p-4 shadow-sm text-center bg-white rounded-3 position-relative overflow-hidden transition-all fixed-card" style="border: none;">
                <div class="card-overlay"></div>
                <h6 class="text-muted mb-2">Pesanan Sudah Selesai</h6>
                <h4 class="fw-bold mb-0 text-info"><?= $pesanan_selesai ?> Customer</h4>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card p-4 shadow-sm text-center bg-white rounded-3 position-relative overflow-hidden transition-all fixed-card" style="border: none;">
                <div class="card-overlay"></div>
                <h6 class="text-muted mb-2">Pesanan Dalam Proses</h6>
                <h4 class="fw-bold mb-0 text-warning"><?= $pesanan_dalam_proses ?> Customer</h4>
            </div>
        </div>
    </div>

    <!-- Chart dalam 1 tahun -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card p-4 shadow-sm bg-white rounded-3 mb-4" style="border: none;">
                <h5 class="mb-3 fw-bold text-dark">Pemesanan dalam 1 Tahun</h5>
                <div style="height: 350px;">
                    <canvas id="chartPemesanan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card p-4 shadow-sm bg-white rounded-3" style="border: none;">
                <h5 class="mb-3 fw-bold text-dark">Pendapatan dalam 1 Tahun</h5>
                <div style="height: 350px;">
                    <canvas id="chartPendapatan"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Orders Chart (top)
    let ctxOrders = document.getElementById('chartPemesanan').getContext('2d');
    new Chart(ctxOrders, {
        type: 'line',
        data: {
            labels: <?= $chart_labels ?>,
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: <?= $chart_pemesanan_data ?>,
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderColor: '#007bff',
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 6,
                pointBackgroundColor: '#007bff',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                fill: true
            }]
        },
        options: getChartOptions('Customer')
    });

    // Revenue Chart (bottom)
    let ctxRevenue = document.getElementById('chartPendapatan').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'bar',
        data: {
            labels: <?= $chart_labels ?>,
            datasets: [{
                label: 'Pendapatan',
                data: <?= $chart_pendapatan_data ?>,
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                borderColor: '#28a745',
                borderWidth: 2,
                borderRadius: 4
            }]
        },
        options: getChartOptions('Rp', true)
    });

    // Shared chart options function
    function getChartOptions(unitPrefix, isCurrency = false) {
        return {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#333',
                    bodyColor: '#333',
                    borderColor: '#ddd',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (isCurrency) {
                                label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            } else {
                                label += context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#555' }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#eee' },
                    ticks: {
                        color: '#555',
                        callback: function(value) {
                            if (isCurrency) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                            return unitPrefix ? value + ' ' + unitPrefix : value;
                        }
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeInOutQuart'
            }
        }
    }
</script>

<?= $this->endSection() ?>