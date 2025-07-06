<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Riwayat Pemesanan</h3>
    </div>

    <!-- Filter Search, Bulan, dan Export Excel -->
    <form id="filterForm" class="d-flex flex-wrap justify-content-end gap-2 mb-3" method="GET" action="<?= base_url('admin/data-pemesanan/riwayat'); ?>">
        <!-- Search Manual -->
        <div class="input-group" style="max-width: 250px;">
            <input type="text" class="form-control" placeholder="Search..." name="search"
                value="<?= esc($search ?? '') ?>">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Filter Bulan -->
        <div class="input-group" style="max-width: 180px;">
            <input type="month" class="form-control" name="filter_bulan" value="<?= esc($filterBulan ?? '') ?>" onchange="document.getElementById('filterForm').submit();">
        </div>
        
        <!-- Tombol Cetak Laporan -->
         <a href="<?= base_url('admin/data-pemesanan/export-excel') . '?search=' . esc($search ?? '') . '&filter_bulan=' . esc($filterBulan ?? '') ?>" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
    </form>
</div>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">No. Telepon</th>
                            <th class="align-middle">Waktu Pemesanan</th>
                            <th class="align-middle">Paket Layanan</th>
                            <th class="align-middle">Jenis Layanan</th>
                            <th class="align-middle">Harga</th>
                            <th class="align-middle">Waktu Pemotretan</th>
                            <th class="align-middle">Jenis Pembayaran</th>
                            <th class="align-middle">Lokasi Pemotretan</th>
                            <th class="align-middle">Link Maps Lokasi Pemotretan</th>
                            <th class="align-middle">Link Maps Lokasi Pengiriman Album</th>
                            <th class="align-middle">Nama Mempelai</th>
                            <th class="align-middle">Instagram</th>
                            <th class="align-middle">Link Hasil Foto</th>
                            <th class="align-middle">Persetujuan Portofolio</th>
                            <th class="align-middle">Waktu Selesai Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($riwayat) && count($riwayat) > 0): ?>
                        <?php foreach ($riwayat as $key => $item): ?>
                    <tr>
                        <td><?= esc($item['nama_lengkap']) ?></td>
                        <td><?= esc($item['email']) ?></td>
                        <td><?= esc($item['no_telepon']) ?></td>
                        <td><?= esc(date('d M Y H:i', strtotime($item['waktu_pemesanan']))) ?></td>
                        <td><?= esc($item['nama_paket']) ?></td>
                        <td><?= esc($item['jenis_layanan']) ?></td>
                        <td>Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= esc(date('d M Y H:i', strtotime($item['waktu_pemotretan']))) ?></td>
                        <td><?= esc($item['jenis_pembayaran']) ?></td>
                        <td><?= esc($item['lokasi_pemotretan']) ?></td>
                        <td><a href="<?= esc($item['link_maps_pemotretan']) ?>" target="_blank">Lihat Maps</a></td>
                        <td><a href="<?= !empty($item['link_maps_pengiriman']) ? esc($item['link_maps_pengiriman']) : '-' ?>" target="_blank">Lihat Maps</a></td>
                        <td><?= !empty($item['nama_mempelai']) ? esc($item['nama_mempelai']) : '-' ?></td>
                        <td>
                            <a href="https://instagram.com/<?= esc($item['instagram']) ?>" target="_blank">@<?= esc($item['instagram']) ?></a>
                        </td>
                        <td>
                            <?php if (!empty($item['link_hasil_foto'])): ?>
                                <a href="<?= esc($item['link_hasil_foto']) ?>" target="_blank">Lihat Hasil Foto</a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= !empty($item['is_portfolio_approved']) ? esc($item['is_portfolio_approved']) : '-' ?></td>
                        <td><?= esc(date('d M Y H:i', strtotime($item['status_selesai_at']))) ?></td>
                    </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                    <tr>
                        <td colspan="15">Tidak ada data ditemukan.</td>
                    </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>