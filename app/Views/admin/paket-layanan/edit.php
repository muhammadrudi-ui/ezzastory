<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Edit Paket Layanan</h3>
    </div>

    <?php if (session()->has('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('admin/paket-layanan/proses-edit/' . $paket['id']); ?>" method="POST"
                enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="fw-bold">Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control"
                        value="<?= old('nama_paket', $paket['nama']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/png, image/jpeg, image/jpg"
                        onchange="previewImage(this, 'previewFoto')">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal ukuran file: 2MB
                        (JPG, JPEG, PNG).</small>
                    <div class="mt-2">
                        <img id="previewFoto" src="<?= base_url($paket['foto']) ?>" alt="Foto Paket" width="100">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Benefit</label>
                    <textarea name="benefit" id="benefit" class="form-control" rows="3"
                        required><?= old('benefit', $paket['benefit']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= old('harga', $paket['harga']) ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="jenis_layanan" class="form-label">Jenis Layanan</label>
                    <select class="form-select" id="jenis_layanan" name="jenis_layanan" required>
                        <option value="Wedding" <?= old('jenis_layanan', $paket['jenis_layanan']) == 'Wedding' ? 'selected' : '' ?>>Wedding</option>
                        <option value="Engagement" <?= old('jenis_layanan', $paket['jenis_layanan']) == 'Engagement' ? 'selected' : '' ?>>Engagement</option>
                        <option value="Pre-Wedding" <?= old('jenis_layanan', $paket['jenis_layanan']) == 'Pre-Wedding' ? 'selected' : '' ?>>Pre-Wedding</option>
                        <option value="Wisuda" <?= old('jenis_layanan', $paket['jenis_layanan']) == 'Wisuda' ? 'selected' : '' ?>>Wisuda</option>
                        <option value="Event Lainnya" <?= old('jenis_layanan', $paket['jenis_layanan']) == 'Event Lainnya' ? 'selected' : '' ?>>Event Lainnya</option>
                    </select>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('admin/paket-layanan/index'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#benefit'))
        .catch(error => {
            console.error(error);
            });
            ClassicEditor
</script>
<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->endSection() ?>