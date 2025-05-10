<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Edit Status Pemesanan</h3>
    </div>

    <!-- Form Edit Data Pemesanan -->
<div class="card">
    <div class="card-body">
        <form action="<?= base_url('admin/data-pemesanan/update/' . $pemesanan['id']); ?>" method="POST">
            <?= csrf_field(); ?> <!-- Untuk keamanan CSRF -->

            <div class="row">
                <div class="col-md-6">
                    <label class="fw-bold">Nama</label>
                    <input type="text" name="nama" class="form-control text-muted" value="<?= esc($pemesanan['nama_lengkap']) ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">No. Telepon</label>
                    <input type="text" name="no_telp" class="form-control text-muted" value="<?= esc($pemesanan['no_telepon']) ?>" readonly>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="fw-bold">Waktu Pemesanan</label>
                    <input type="text" name="waktu_pemesanan" class="form-control text-muted" value="<?= esc(date('Y-m-d H:i', strtotime($pemesanan['waktu_pemesanan']))) ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">Paket Layanan</label>
                    <input type="text" name="paket" class="form-control text-muted" value="<?= esc($pemesanan['nama_paket']) ?>" readonly>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="fw-bold">Waktu Pemotretan</label>
                    <input type="text" name="waktu_pemotretan" class="form-control text-muted" value="<?= esc(date('Y-m-d H:i', strtotime($pemesanan['waktu_pemotretan']))) ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">Harga</label>
                    <input type="text" name="harga" class="form-control text-muted" value="Rp<?= number_format($pemesanan['harga'], 0, ',', '.') ?>" readonly>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="fw-bold">Metode Pembayaran</label>
                    <input type="text" name="metode_pembayaran" class="form-control text-muted" value="<?= esc($pemesanan['jenis_pembayaran']) ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">Jenis Pembayaran</label>
                    <input type="text" name="jenis_pembayaran" class="form-control text-muted" value="<?= esc($pemesanan['jenis_pembayaran']) ?>" readonly>
                </div>
            </div>

            <div class="mt-3">
                <label class="fw-bold">Lokasi Pemotretan</label>
                <input type="text" name="lokasi_pemotretan" class="form-control text-muted" value="<?= esc($pemesanan['lokasi_pemotretan']) ?>" readonly>
            </div>

            <div class="mt-3">
                <label class="fw-bold">Lokasi Pengiriman Album</label>
                <input type="text" name="lokasi_pengiriman" class="form-control text-muted" value="<?= esc($pemesanan['link_maps_pengiriman']) ?>" readonly>
            </div>

            <div class="mt-3">
    <label class="fw-bold">Status</label>
    <select name="status" class="form-select">
        <option value="Pemotretan" <?= $pemesanan['status'] == 'Pemotretan' ? 'selected' : '' ?>>Proses Pemotretan</option>
        <option value="Editing" <?= $pemesanan['status'] == 'Editing' ? 'selected' : '' ?>>Proses Editing</option>
        <option value="Pencetakan" <?= $pemesanan['status'] == 'Pencetakan' ? 'selected' : '' ?>>Pencetakan Album</option>
        <option value="Pengiriman" <?= $pemesanan['status'] == 'Pengiriman' ? 'selected' : '' ?>>Pengiriman</option>
        <option value="Selesai" <?= $pemesanan['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
    </select>
</div>


            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('admin/data-pemesanan/index'); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

</div>

<?= $this->endSection() ?>