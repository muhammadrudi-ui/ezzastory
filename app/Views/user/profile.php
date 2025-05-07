<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<section class="py-5" style="margin-top: 100px;">
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-4 text-center">Edit Profile</h2>

                <form action="<?= base_url('user/profile/update') ?>" method="post">
                    <div class="row g-4">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" value="<?= esc($user['username']) ?>"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="<?= esc($user['email']) ?>" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password Baru (Opsional)</label>
                                <input type="password" name="password" class="form-control">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <?php
                            $namaLengkapKosong = empty($user['nama_lengkap']);
$noTeleponKosong = empty($user['no_telepon']);
$instagramKosong = empty($user['instagram']);
?>

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="<?= esc($user['nama_lengkap'] ?? '') ?>"
                                    class="form-control <?= $namaLengkapKosong ? 'is-invalid' : '' ?>"
                                    placeholder="Masukkan Nama Lengkap" <?= $namaLengkapKosong ? 'required' : '' ?>>
                                <?php if ($namaLengkapKosong): ?>
                                    <div class="invalid-feedback">
                                        Nama Lengkap harus diisi.
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No Telepon</label>
                                <input type="text" name="no_telepon" value="<?= esc($user['no_telepon'] ?? '') ?>"
                                    class="form-control <?= $noTeleponKosong ? 'is-invalid' : '' ?>"
                                    placeholder="Masukkan No Telepon" <?= $noTeleponKosong ? 'required' : '' ?>>
                                <?php if ($noTeleponKosong): ?>
                                    <div class="invalid-feedback">
                                        No Telepon harus diisi.
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link Instagram / Username</label>
                                <input type="text" name="instagram" value="<?= esc($user['instagram'] ?? '') ?>"
                                    class="form-control <?= $instagramKosong ? 'is-invalid' : '' ?>"
                                    placeholder="Masukkan Link Instagram" <?= $instagramKosong ? 'required' : '' ?>>
                                <?php if ($instagramKosong): ?>
                                    <div class="invalid-feedback">
                                        Instagram harus diisi.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= base_url('user/beranda') ?>" class="btn btn-outline-dark">Batal</a>
                        <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>