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

    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
    <form class="input-group" style="max-width: 250px;" method="GET"
            action="<?= base_url('admin/data-pemesanan/index'); ?>">
            <input type="text" class="form-control" placeholder="Search..." name="search"
                value="<?= isset($search) ? esc($search) : ''; ?>">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <div class="input-group" style="max-width: 180px;">
            <input type="month" class="form-control" id="filterBulan" placeholder="Pilih Bulan">
        </div>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle d-flex align-items-center gap-2" type="button"
                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-filter"></i> Filter Status
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#"><i class="fas fa-camera"></i> Proses Pemotretan</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Proses Editing</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-print"></i> Pencetakan Album</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-check-circle"></i> Pemesanan Diterima</a></li>
            </ul>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">No. Telepon</th>
                            <th class="align-middle">Waktu Pemesanan</th>
                            <th class="align-middle">Paket Layanan</th>
                            <th class="align-middle">Harga</th>
                            <th class="align-middle">Waktu Pemotretan</th>
                            <th class="align-middle">Jenis Pembayaran</th>
                            <th class="align-middle">Metode Pembayaran</th>
                            <th class="align-middle">Lokasi Pemotretan</th>
                            <th class="align-middle">Lokasi Pengiriman Album</th>
                            <th class="align-middle">Status</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < 4; $i++): ?>
                            <tr>
                                <td>Andreas</td>
                                <td>081234567891</td>
                                <td>2025-03-05 08:00</td>
                                <td>Paket Platinum</td>
                                <td>Rp. 2.000.000</td>
                                <td>2025-03-05 08:00</td>
                                <td>Lunas</td>
                                <td>Bank BNI</td>
                                <td>Link Maps</td>
                                <td>Link Maps</td>
                                <td>Editing</td>
                                <td class="text-nowrap">
                                    <div class="d-flex gap-2">
                                        <a href="data-pemesanan-edit" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit text-white"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>