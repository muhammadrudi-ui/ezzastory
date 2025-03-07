<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Riwayat Pemesanan</h3>
    </div>

    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search"
                aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="input-group" style="max-width: 180px;">
            <input type="month" class="form-control" id="filterBulan" placeholder="Pilih Bulan">
        </div>

        <a href="#" class="btn btn-primary">Cetak Laporan</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="align-middle">Nama Customer</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">No. Telp</th>
                            <th class="align-middle">Jenis Layanan</th>
                            <th class="align-middle">Paket Layanan</th>
                            <th class="align-middle">Harga</th>
                            <th class="align-middle">Tanggal Pemesanan</th>
                            <th class="align-middle">Tanggal Pemotretan</th>
                            <th class="align-middle">Metode Pembayaran</th>
                            <th class="align-middle">Status Pembayaran</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < 4; $i++): ?>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>+62 812-3456-7890</td>
                                <td>Wedding</td>
                                <td>Paket Platinum</td>
                                <td>Rp 5.000.000</td>
                                <td>2025-02-27</td>
                                <td>2025-03-05 08:00</td>
                                <td>Transfer Bank</td>
                                <td>Lunas</td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><?= $this->endSection() ?>