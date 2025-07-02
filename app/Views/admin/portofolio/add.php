<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Tambah Portofolio</h3>
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
            <form action="<?= base_url('admin/portofolio/proses-add'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama</label>
                        <input type="text" name="nama_mempelai" class="form-control"
                            placeholder="Masukkan nama" value="<?= old('nama_mempelai') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Foto (Maksimal 18)</label>
                        <input type="file" name="foto[]" class="form-control" multiple
                            onchange="previewMultipleImages(event)" accept="image/png, image/jpeg, image/jpg">
                        <small class="text-muted">Maksimal ukuran file: 1MB (JPG, JPEG, PNG).</small>
                        <div id="previewContainer" class="mt-2 d-flex flex-wrap"></div>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Jenis Layanan</label>
                    <select name="jenis_layanan" class="form-select" required>
                        <option value="" disabled selected>Pilih Jenis Layanan</option>
                        <option value="Wedding" <?= old('jenis_layanan') == 'Wedding' ? 'selected' : '' ?>>Wedding</option>
                        <option value="Engagement" <?= old('jenis_layanan') == 'Engagement' ? 'selected' : '' ?>>Engagement
                        </option>
                        <option value="Pre-Wedding" <?= old('jenis_layanan') == 'Pre-Wedding' ? 'selected' : '' ?>>
                            Pre-Wedding</option>
                        <option value="Wisuda" <?= old('jenis_layanan') == 'Wisuda' ? 'selected' : '' ?>>
                            Wisuda</option>
                        <option value="Event Lainnya" <?= old('jenis_layanan') == 'Event Lainnya' ? 'selected' : '' ?>>
                            Event Lainnya</option>
                    </select>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('admin/portofolio/index'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewMultipleImages(event) {
        let files = event.target.files;
        let previewContainer = document.getElementById("previewContainer");
        previewContainer.innerHTML = "";

        if (files.length > 18) {
            alert("Maksimal 18 gambar yang dapat diunggah.");
            event.target.value = "";
            return;
        }

        for (let i = 0; i < files.length; i++) {
            let reader = new FileReader();
            reader.onload = function () {
                let img = document.createElement("img");
                img.src = reader.result;
                img.classList.add("m-1", "border", "rounded");
                img.style.width = "100px";
                img.style.height = "100px";
                img.style.objectFit = "cover";
                img.style.display = "inline-block";
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(files[i]);
        }
    }
</script>

<?= $this->endSection() ?>