<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Profil Admin</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Edit Profil</li>
    </ol>

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

    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= base_url('admin/profile/update') ?>" method="post">
                <div class="row g-4">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" value="<?= esc($user['username']) ?>" 
                                   class="form-control" 
                                   pattern="^\S{1,30}$"
                                   title="Username maksimal 30 karakter dan tidak boleh mengandung spasi"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="<?= esc($user['email']) ?>" class="form-control" required>
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
                            <input type="text" name="no_telepon"
                                   value="<?= esc($user['no_telepon'] ?? '') ?>"
                                   class="form-control <?= $noTeleponKosong ? 'is-invalid' : '' ?>"
                                   placeholder="Masukkan No Telepon"
                                   pattern="\d{10,13}" maxlength="13"
                                   title="Nomor telepon harus antara 10 hingga 13 digit angka"
                                   <?= $noTeleponKosong ? 'required' : '' ?>>
                            <?php if ($noTeleponKosong): ?>
                                <div class="invalid-feedback">
                                    No Telepon harus diisi.
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username Instagram</label>
                            <input type="text" name="instagram" value="<?= esc($user['instagram'] ?? '') ?>"
                                   class="form-control <?= $instagramKosong ? 'is-invalid' : '' ?>"
                                   placeholder="Masukkan Username Instagram" <?= $instagramKosong ? 'required' : '' ?>>
                            <?php if ($instagramKosong): ?>
                                <div class="invalid-feedback">
                                    Instagram harus diisi.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-dark">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>