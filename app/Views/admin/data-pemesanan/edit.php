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
                <?= csrf_field(); ?>

                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['nama_lengkap']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">No. Telepon</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['no_telepon']) ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Email</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['email']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Mempelai</label>
                        <p class="form-control-plaintext text-muted"><?= !empty($pemesanan['nama_mempelai']) ? esc($pemesanan['nama_mempelai']) : '-' ?></p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Waktu Pemesanan</label>
                        <p class="form-control-plaintext text-muted"><?= esc(date('Y-m-d H:i', strtotime($pemesanan['waktu_pemesanan']))) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Paket Layanan</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['nama_paket']) ?></p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Jenis Layanan</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['jenis_layanan']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Waktu Pemotretan</label>
                        <p class="form-control-plaintext text-muted"><?= esc(date('Y-m-d H:i', strtotime($pemesanan['waktu_pemotretan']))) ?></p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">jenis Pembayaran</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['jenis_pembayaran']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Harga</label>
                        <p class="form-control-plaintext text-muted">Rp<?= number_format($pemesanan['harga'], 0, ',', '.') ?></p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Lokasi Pemotretan</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['lokasi_pemotretan']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Link Maps Lokasi Pemotretan</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['link_maps_pemotretan']) ?></p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Link Maps Lokasi Pengiriman Album</label>
                        <p class="form-control-plaintext text-muted"><?= !empty($pemesanan['link_maps_pengiriman']) ? esc($pemesanan['link_maps_pengiriman']) : '-' ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Instagram</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['instagram']) ?></p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Status Pembayaran</label>
                        <p class="form-control-plaintext text-muted"><?= esc($pemesanan['status_pembayaran']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Link Hasil Foto</label>
                        <input type="text" name="link_hasil_foto" class="form-control"
                        value="<?= old('link_hasil_foto', $pemesanan['link_hasil_foto']) ?>">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Status (Tracking)</label>
                    <select name="status" class="form-select">
                        <option value="Pemotretan" <?= $pemesanan['status'] == 'Pemotretan' ? 'selected' : '' ?>>Pemotretan</option>
                        <option value="Editing" <?= $pemesanan['status'] == 'Editing' ? 'selected' : '' ?>>Editing</option>
                        <?php if (strtolower($pemesanan['jenis_layanan']) === 'wedding'): ?>
                            <option value="Pencetakan" <?= $pemesanan['status'] == 'Pencetakan' ? 'selected' : '' ?>>Pencetakan</option>
                        <?php endif; ?>
                        <option value="Pengiriman" <?= $pemesanan['status'] == 'Pengiriman' ? 'selected' : '' ?>>Pengiriman</option>
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