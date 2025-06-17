<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Data Pemesanan</h3>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Filter Search, Bulan, dan Status -->
    <form id="filterForm" class="d-flex flex-wrap justify-content-end gap-2 mb-3" method="GET" action="<?= base_url('admin/data-pemesanan/index'); ?>">

        <!-- Search -->
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

        <!-- Filter Status -->
        <select name="filter_status" class="form-select" style="max-width: 200px;" onchange="document.getElementById('filterForm').submit();">
            <option value="">-- Semua Status --</option>
            <option value="Pemesanan" <?= $filterStatus == 'Pemesanan' ? 'selected' : '' ?>>Pemesanan</option>
            <option value="Pemotretan" <?= $filterStatus == 'Pemotretan' ? 'selected' : '' ?>>Pemotretan</option>
            <option value="Editing" <?= $filterStatus == 'Editing' ? 'selected' : '' ?>>Editing</option>
            <option value="Pencetakan" <?= $filterStatus == 'Pencetakan' ? 'selected' : '' ?>>Pencetakan</option>
            <option value="Pengiriman" <?= $filterStatus == 'Pengiriman' ? 'selected' : '' ?>>Pengiriman</option>
        </select>
    </form>

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
                            <th class="align-middle">Status Pembayaran</th>
                            <th class="align-middle">Lokasi Pemotretan</th>
                            <th class="align-middle">Link Maps Lokasi Pemotretan</th>
                            <th class="align-middle">Link Maps Lokasi Pengiriman Album</th>
                            <th class="align-middle">Nama Mempelai</th>
                            <th class="align-middle">Instagram</th>
                            <th class="align-middle">Status</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($pemesanan) && count($pemesanan) > 0): ?>
                        <?php foreach ($pemesanan as $key => $item): ?>
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
                        <td>
                                    <span class="badge bg-<?= $item['status_pembayaran'] === 'Lunas' ? 'success' : ($item['status_pembayaran'] === 'DP' ? 'warning' : 'danger') ?>">
                                        <?= esc($item['status_pembayaran']) ?>
                                    </span>
                                </td>
                        <td><?= esc($item['lokasi_pemotretan']) ?></td>
                        <td><a href="<?= esc($item['link_maps_pemotretan']) ?>" target="_blank">Lihat Maps</a></td>
                        <td>
                            <?php if (!empty($item['link_maps_pengiriman'])): ?>
                                <a href="<?= esc($item['link_maps_pengiriman']) ?>" target="_blank">Lihat Maps</a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= !empty($item['nama_mempelai']) ? esc($item['nama_mempelai']) : '-' ?></td>
                        <td>
                            <a href="https://instagram.com/<?= esc($item['instagram']) ?>" target="_blank">@<?= esc($item['instagram']) ?></a>
                        </td>
                        <td><?= esc($item['status']) ?></td>
                        <td>
                            <a href="<?= base_url('admin/data-pemesanan/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
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