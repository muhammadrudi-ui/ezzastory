<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<style>
    /* Filter Container */
    .filter-container {
        display: flex;
        flex-wrap: nowrap;
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .filter-container {
            flex-wrap: wrap;
        }
        
        .filter-group {
            flex: 1 1 200px;
        }
        
        .action-buttons {
            flex: 0 0 100%;
            justify-content: flex-end;
            margin-top: 10px;
        }
    }
    
    @media (max-width: 768px) {
        .filter-group {
            flex: 1 1 100%;
        }
    }
    
    .search-group {
        flex-grow: 1;
    }
    
    .date-group {
        min-width: 180px;
    }
    
    .status-group {
        min-width: 180px;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <h3 class="text-dark fw-bold mb-0">Laporan Keuangan</h3>
        </div>
    </div>

    <!-- Filter Section -->
    <form id="filterForm" method="GET" action="<?= base_url('admin/laporan-keuangan/index'); ?>">
        <div class="filter-container mt-3">
            <!-- Search Input -->
            <div class="filter-group search-group">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari..." name="search" value="<?= esc($search ?? '') ?>">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Tanggal Awal -->
            <div class="filter-group date-group">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                    <input type="date" class="form-control" name="filter_tanggal_awal" value="<?= esc($filter_tanggal_awal ?? '') ?>">
                </div>
            </div>

            <!-- Tanggal Akhir -->
            <div class="filter-group date-group">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                    <input type="date" class="form-control" name="filter_tanggal_akhir" value="<?= esc($filter_tanggal_akhir ?? '') ?>">
                </div>
            </div>

            <!-- Status Pembayaran -->
            <div class="filter-group status-group">
                <select name="filter_status_pembayaran" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="Belum Bayar" <?= $filter_status_pembayaran == 'Belum Bayar' ? 'selected' : '' ?>>Belum Bayar</option>
                    <option value="DP" <?= $filter_status_pembayaran == 'DP' ? 'selected' : '' ?>>DP</option>
                    <option value="Lunas" <?= $filter_status_pembayaran == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
                </select>
            </div>

            <!-- Action Buttons -->
<div class="filter-group action-buttons d-flex align-items-center" style="height: 38px;">
    <button type="submit" class="btn btn-primary btn-sm py-1">
        <i class="fas fa-filter me-1"></i> Filter
    </button>
    <a href="<?= site_url('admin/laporan-keuangan/cetak') .
                '?search=' . urlencode($search ?? '') .
                '&filter_tanggal_awal=' . urlencode($filter_tanggal_awal ?? '') .
                '&filter_tanggal_akhir=' . urlencode($filter_tanggal_akhir ?? '') .
                '&filter_status_pembayaran=' . urlencode($filter_status_pembayaran ?? '')
?>" class="btn btn-danger btn-sm py-1 ms-2">
        <i class="fas fa-file-pdf me-1"></i> PDF
    </a>
</div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Paket</th>
                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Pembayaran</th>
                            <th>Dibayar</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pemesanan)): ?>
                            <tr>
                                <td colspan="8" class="py-4">Tidak ada data ditemukan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pemesanan as $pesan): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($pesan['waktu_pemesanan'])) ?></td>
                                    <td><?= esc($pesan['nama_lengkap']) ?></td>
                                    <td><?= esc($pesan['nama_paket']) ?></td>
                                    <td><?= esc($pesan['jenis_layanan']) ?></td>
                                    <td>Rp<?= number_format($pesan['harga'], 0, ',', '.') ?></td>
                                    <td><?= esc($pesan['jenis_pembayaran']) ?></td>
                                    <td>Rp<?= number_format($pesan['jumlah_pembayaran'], 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($pesan['sisa_pembayaran'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-4 mx-auto">
            <div class="card outline-dark">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Total Pemasukan</h5>
                    <h3 class="fw-bold">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Responsive adjustments
    function handleResize() {
        const form = document.getElementById('filterForm');
        if (window.innerWidth < 768) {
            // Mobile view
            form.classList.add('flex-column');
            form.classList.remove('flex-wrap');
        } else {
            // Desktop view
            form.classList.remove('flex-column');
            form.classList.add('flex-wrap');
        }
    }

    // Initial call and event listener
    handleResize();
    window.addEventListener('resize', handleResize);
});
</script>

<?= $this->endSection() ?>