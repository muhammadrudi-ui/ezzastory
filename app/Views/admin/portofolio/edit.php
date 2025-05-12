<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Edit Portofolio</h3>
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

    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('admin/portofolio/proses-edit/' . $portofolio['id']); ?>" method="POST"
                enctype="multipart/form-data">
                <div class="mt-3">
                    <label class="fw-bold">Nama Mempelai</label>
                    <input type="text" name="nama_mempelai" class="form-control"
                        value="<?= $portofolio['nama_mempelai']; ?>" required>
                </div>
                <div class="mt-3">
                    <label class="fw-bold">Foto (Maksimal 10)</label>
                    <div id="previewContainer" class="mt-2 d-flex flex-wrap">
                        <?php foreach ($foto_portofolio as $foto): ?>
                            <div class="image-preview position-relative m-1" id="preview-<?= $foto['id']; ?>">
                                <img src="<?= base_url($foto['nama_file']) ?>"
                                    class="border rounded" width="100" height="100" style="object-fit:cover;">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                    onclick="removeExistingImage(<?= $foto['id']; ?>)">✖</button>
                                <input type="hidden" name="existing_foto[]" value="<?= $foto['id']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <input type="file" name="foto[]" class="form-control mt-2" multiple
                        onchange="previewNewImages(event)" accept="image/png, image/jpeg, image/jpg"> <small
                        class="text-muted">Maksimal ukuran file: 1MB (JPG, JPEG, PNG).</small>
                    <div id="newPreviewContainer" class="mt-2 d-flex flex-wrap"></div>
                    <input type="hidden" id="deleted_foto" name="deleted_foto">
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Jenis Layanan</label>
                    <select name="jenis_layanan" class="form-select">
                        <option value="Wedding" <?= $portofolio['jenis_layanan'] == 'Wedding' ? 'selected' : '' ?>>Wedding
                        </option>
                        <option value="Engagement" <?= $portofolio['jenis_layanan'] == 'Engagement' ? 'selected' : '' ?>>
                            Engagement</option>
                        <option value="Pre-Wedding" <?= $portofolio['jenis_layanan'] == 'Pre-Wedding' ? 'selected' : '' ?>>
                            Pre-Wedding</option>
                        <option value="Wisuda" <?= $portofolio['jenis_layanan'] == 'Wisuda' ? 'selected' : '' ?>>
                            Wisuda</option>
                        <option value="Event Lainnya" <?= $portofolio['jenis_layanan'] == 'Event Lainnya' ? 'selected' : '' ?>>Event Lainnya
                        </option>
                    </select>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('admin/portofolio/index'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let deletedFotos = [];

    function previewNewImages(event) {
        let files = event.target.files;
        let previewContainer = document.getElementById("newPreviewContainer");
        let existingImagesCount = document.querySelectorAll('#previewContainer img').length;
        let totalImages = existingImagesCount + files.length;

        if (totalImages > 10) {
            alert("Maksimal 10 gambar dapat diunggah.");
            event.target.value = "";
            return;
        }

        previewContainer.innerHTML = "";

        for (let i = 0; i < files.length; i++) {
            let reader = new FileReader();
            reader.onload = function () {
                let img = document.createElement("img");
                img.src = reader.result;
                img.classList.add("m-1", "border", "rounded");
                img.style.width = "100px";
                img.style.height = "100px";
                img.style.objectFit = "cover";
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(files[i]);
        }
    }

    function removeExistingImage(id) {
        let imgDiv = document.getElementById("preview-" + id);
        imgDiv.remove();
        deletedFotos.push(id);
        document.getElementById("deleted_foto").value = deletedFotos.join(",");
    }
</script>


<?= $this->endSection() ?>