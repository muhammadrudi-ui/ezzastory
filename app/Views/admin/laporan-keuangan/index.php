<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Laporan Keuangan</h3>
    </div>

    <!-- Filter Search, Bulan, dan Status Pembayaran -->
    <form id="filterForm" class="d-flex flex-wrap justify-content-end gap-2 mb-3" method="GET" action="<?= base_url('admin/laporan-keuangan/index'); ?>">
        <!-- Search Manual (dengan tombol) -->
        <div class="input-group" style="max-width: 250px;">
            <input type="text" class="form-control" placeholder="Search..." name="search" value="<?= esc($search ?? '') ?>">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Filter Bulan (auto submit) -->
        <div class="input-group" style="max-width: 180px;">
            <input type="month" class="form-control" name="filter_bulan" value="<?= esc($filter_bulan ?? '') ?>" onchange="document.getElementById('filterForm').submit();">
        </div>

        <!-- Filter Status Pembayaran (auto submit) -->
        <select name="filter_status_pembayaran" class="form-select" style="max-width: 200px;" onchange="document.getElementById('filterForm').submit();">
            <option value="">-- Semua Status Pembayaran --</option>
            <option value="Belum Bayar" <?= $filter_status_pembayaran == 'Belum Bayar' ? 'selected' : '' ?>>Belum Bayar</option>
            <option value="DP" <?= $filter_status_pembayaran == 'DP' ? 'selected' : '' ?>>DP</option>
            <option value="Lunas" <?= $filter_status_pembayaran == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
        </select>

        <!-- Tombol Cetak Laporan dengan Filter -->
        <a href="<?= site_url('admin/laporan-keuangan/cetak') .
                    '?search=' . urlencode($search ?? '') .
                    '&filter_bulan=' . urlencode($filter_bulan ?? '') .
                    '&filter_status_pembayaran=' . urlencode($filter_status_pembayaran ?? '')
?>" 
        class="btn btn-danger">
            <i class="fas fa-file-pdf me-1"></i> Cetak Laporan
        </a>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Tanggal Pemesanan</th>
                            <th>Nama Customer</th>
                            <th>No. Telepon</th>
                            <th>Paket Layanan</th>
                            <th>Jenis Layanan</th>
                            <th>Harga</th>
                            <th>Jenis Pembayaran</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Sisa Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pemesanan)): ?>
                            <tr>
                                <td colspan="8">Tidak ada data ditemukan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pemesanan as $pesan): ?>
                                <tr>
                                    <td><?= date('Y-m-d', strtotime($pesan['waktu_pemesanan'])) ?></td>
                                    <td><?= esc($pesan['nama_lengkap']) ?></td>
                                    <td><?= esc($pesan['no_telepon']) ?></td>
                                    <td><?= esc($pesan['nama_paket']) ?></td>
                                    <td><?= esc($pesan['jenis_layanan']) ?></td>
                                    <td>Rp <?= number_format($pesan['harga'], 0, ',', '.') ?></td>
                                    <td><?= esc($pesan['jenis_pembayaran']) ?></td>
                                    <td>Rp <?= number_format($pesan['jumlah_pembayaran'], 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($pesan['sisa_pembayaran'], 0, ',', '.') ?></td>
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

<?= $this->endSection() ?>