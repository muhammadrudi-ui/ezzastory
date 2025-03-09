<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Edit Status Pemesanan</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('data-pemesanan/update/1'); ?>" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama</label>
                        <input type="text" name="nama" class="form-control text-muted" value="Andreas" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control text-muted" value="081234567891" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Waktu Pemesanan</label>
                        <input type="text" name="waktu_pemesanan" class="form-control text-muted"
                            value="2025-03-05 08:00" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Paket Layanan</label>
                        <input type="text" name="paket" class="form-control text-muted" value="Paket Platinum" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Waktu Pemotretan</label>
                        <input type="text" name="waktu_pemotretan" class="form-control text-muted"
                            value="2025-03-05 08:00" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Harga</label>
                        <input type="text" name="harga" class="form-control text-muted" value="Rp. 2.000.000" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Metode Pembayaran</label>
                        <input type="text" name="metode_pembayaran" class="form-control text-muted" value="Bank BNI"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Jenis Pembayaran</label>
                        <input type="text" name="jenis_pembayaran" class="form-control text-muted" value="Lunas"
                            readonly>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Lokasi Pemotretan</label>
                    <input type="text" name="lokasi_pemotretan" class="form-control text-muted" value="Rogojampi"
                        readonly>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Lokasi Pengiriman Album</label>
                    <input type="text" name="lokasi_pengiriman" class="form-control text-muted" value="Link Maps"
                        readonly>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="Proses Pemotretan" selected>Proses Pemotretan</option>
                        <option value="Proses Editing">Proses Editing</option>
                        <option value="Pencetakan Album">Pencetakan Album</option>
                        <option value="Pemesanan Diterima">Pemesanan Diterima</option>
                    </select>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('data-pemesanan'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>