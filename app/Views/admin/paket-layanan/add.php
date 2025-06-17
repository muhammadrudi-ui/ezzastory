<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Tambah Paket Layanan</h3>
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
            <form action="<?= base_url('admin/paket-layanan/proses-add'); ?>" method="POST"
                enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="fw-bold">Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control" placeholder="Masukkan nama paket"
                        value="<?= old('nama_paket') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/png, image/jpeg, image/jpg"
                        onchange="previewImage(event, 'previewFoto')" required>
                    <small class="text-muted">Maksimal ukuran file: 1MB (JPG, JPEG, PNG).</small>
                    <div class="mt-2">
                        <img id="previewFoto" src="#" alt="Preview Foto" class="d-none" width="100">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Benefit</label>
                    <textarea name="benefit" id="benefit" class="form-control" rows="3" placeholder="Masukkan benefit paket"><?= old('benefit') ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Harga</label>
                    <input type="number" name="harga" class="form-control" placeholder="Masukkan harga paket"
                        value="<?= old('harga') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="jenis_layanan" class="form-label">Jenis Layanan</label>
                    <select class="form-select" name="jenis_layanan" required>
                        <option value="Wedding" <?= old('jenis_layanan') == 'Wedding' ? 'selected' : '' ?>>Wedding</option>
                        <option value="Engagement" <?= old('jenis_layanan') == 'Engagement' ? 'selected' : '' ?>>Engagement</option>
                        <option value="Pre-Wedding" <?= old('jenis_layanan') == 'Pre-Wedding' ? 'selected' : '' ?>>Pre-Wedding</option>
                        <option value="Wisuda" <?= old('jenis_layanan') == 'Wisuda' ? 'selected' : '' ?>>Wisuda</option>
                        <option value="Event Lainnya" <?= old('jenis_layanan', 'Event Lainnya') == 'Event Lainnya' ? 'selected' : '' ?>>Event Lainnya</option>
                    </select>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
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
    document.querySelector('form').addEventListener('submit', function(event) {
        // Ambil instance CKEditor
        let benefitEditor = CKEditor.instances['benefit'];

        // Ambil nilai dari CKEditor
        let benefit = benefitEditor.getData();
   
        // Validasi manual
        if (!benefit) {
            event.preventDefault(); // Hentikan submit
            alert('Harap isi benefit.');
            return;
        }

        // Update nilai textarea asli sebelum submit
        document.querySelector('#benefit').value = benefit;
    });
</script>
<script>
    function previewImage(event, id) {
        let reader = new FileReader();
        reader.onload = function () {
            let output = document.getElementById(id);
            output.src = reader.result;
            output.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?= $this->endSection() ?>