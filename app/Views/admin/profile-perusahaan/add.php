<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Tambah Data Perusahaan</h3>
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
            <form action="<?= base_url('admin/profile-perusahaan/proses-add'); ?>" method="POST"
                enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control"
                            placeholder="Masukkan nama perusahaan" value="<?= old('nama_perusahaan') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Logo Perusahaan</label>
                        <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg, image/jpg"
                            onchange="previewImage(event, 'previewLogo')" required>
                        <small class="text-muted">Maksimal ukuran file: 1MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewLogo" src="#" alt="Preview Logo" class="d-none" width="100">
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi"
                        required><?= old('deskripsi') ?></textarea>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 1</label>
                        <input type="file" name="slider_1" class="form-control"
                            accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'previewSlider1')"
                            required>
                        <small class="text-muted">Maksimal ukuran file: 1MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewSlider1" src="#" alt="Preview Slider 1" class="d-none" width="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 2</label>
                        <input type="file" name="slider_2" class="form-control"
                            accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'previewSlider2')"
                            required>
                        <small class="text-muted">Maksimal ukuran file: 1MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewSlider2" src="#" alt="Preview Slider 2" class="d-none" width="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 3</label>
                        <input type="file" name="slider_3" class="form-control"
                            accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'previewSlider3')"
                            required>
                        <small class="text-muted">Maksimal ukuran file: 1MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewSlider3" src="#" alt="Preview Slider 3" class="d-none" width="100">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 1</label>
                        <input type="text" name="keunggulan_1" class="form-control"
                            placeholder="Masukkan keunggulan pertama" value="<?= old('keunggulan_1') ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 2</label>
                        <input type="text" name="keunggulan_2" class="form-control"
                            placeholder="Masukkan keunggulan kedua" value="<?= old('keunggulan_2') ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 3</label>
                        <input type="text" name="keunggulan_3" class="form-control"
                            placeholder="Masukkan keunggulan ketiga" value="<?= old('keunggulan_3') ?>" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Background Judul</label>
                    <input type="file" name="background_judul" class="form-control"
                        accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'previewBgJudul')"
                        required>
                    <small class="text-muted">Maksimal ukuran file: 1MB (JPG, JPEG, PNG).</small>
                    <div class="mt-2">
                        <img id="previewBgJudul" src="#" alt="Preview Background Judul" class="d-none" width="100">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Visi</label>
                        <textarea name="visi" id="visi" class="form-control" rows="2" placeholder="Masukkan visi perusahaan"
                            required><?= old('visi') ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Misi</label>
                        <textarea name="misi" id="misi" class="form-control" rows="2" placeholder="Masukkan misi perusahaan"
                            required><?= old('misi') ?></textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Owner</label>
                        <input type="text" name="nama_owner" class="form-control" placeholder="Masukkan nama owner"
                            value="<?= old('nama_owner') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Foto Owner</label>
                        <input type="file" name="foto_owner" class="form-control"
                            accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event, 'previewOwner')"
                            required>
                        <small class="text-muted">Maksimal ukuran file: 2MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewOwner" src="#" alt="Preview Foto Owner" class="d-none" width="100">
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">CTA</label>
                    <textarea name="cta" class="form-control" rows="2" placeholder="Masukkan kalimat CTA"
                        required><?= old('cta') ?></textarea>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" placeholder="Masukkan no. telepon"
                            value="<?= old('no_telp') ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                            value="<?= old('email') ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Instagram</label>
                        <input type="text" name="instagram" class="form-control"
                            placeholder="Masukkan username Instagram" value="<?= old('instagram') ?>" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat perusahaan"
                        required> <?= old('alamat') ?> </textarea>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('admin/profile-perusahaan/index'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CDN CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .catch(error => {
            console.error(error);
            });
            ClassicEditor
        .create(document.querySelector('#visi'))
        .catch(error => {
            console.error(error);
            });
            ClassicEditor
        .create(document.querySelector('#misi'))
        .catch(error => {
            console.error(error);
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