<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Edit Data Perusahaan</h3>
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
            <form action="<?= base_url('admin/profile-perusahaan/proses-edit/' . $profile['id']); ?>" method="POST"
                enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control"
                            value="<?= old('nama_perusahaan', $profile['nama_perusahaan']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Logo</label>
                        <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg, image/jpg"
                            onchange="previewImage(this, 'previewLogo')">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal ukuran file:
                            1MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewLogo" src="<?= base_url($profile['logo']) ?>" alt="Logo" class="mt-2"
                                width="100">
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"
                        required><?= old('deskripsi', $profile['deskripsi']) ?></textarea>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 1</label>
                        <input type="file" name="slider_1" class="form-control"
                            accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this, 'previewSlider1')">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal ukuran file:
                            1MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewSlider1" src="<?= base_url($profile['slider_1']) ?>" alt="Preview Slider 1"
                                class="mt-2" width="100">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Slider 2</label>
                        <input type="file" name="slider_2" class="form-control"
                            accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this, 'previewSlider2')">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal ukuran file:
                            1MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewSlider2" src="<?= base_url($profile['slider_2']) ?>" alt="Preview Slider 2"
                                class="mt-2" width="100">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold">Slider 3</label>
                        <input type="file" name="slider_3" class="form-control"
                            accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this, 'previewSlider3')">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal ukuran file:
                            1MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewSlider3" src="<?= base_url($profile['slider_3']) ?>" alt="Preview Slider 3"
                                class="mt-2" width="100">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 1</label>
                        <input type="text" name="keunggulan_1" class="form-control"
                            value="<?= old('keunggulan_1', $profile['keunggulan_1']) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 2</label>
                        <input type="text" name="keunggulan_2" class="form-control"
                            value="<?= old('keunggulan_2', $profile['keunggulan_2']) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 3</label>
                        <input type="text" name="keunggulan_3" class="form-control"
                            value="<?= old('keunggulan_3', $profile['keunggulan_3']) ?>" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Backgound Judul</label>
                    <input type="file" name="background_judul" class="form-control"
                        accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this, 'previewBackground')">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal ukuran file:
                        1MB (JPG, JPEG, PNG).</small>
                    <div class="mt-2">
                        <img id="previewBackground" src="<?= base_url($profile['background_judul']) ?>"
                            alt="Background Judul" class="mt-2" width="100">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Visi</label>
                        <textarea name="visi" id="visi" class="form-control" rows="2"
                            required><?= old('visi', $profile['visi']) ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Misi</label>
                        <textarea name="misi" id="misi" class="form-control" rows="2"
                            required><?= old('misi', $profile['misi']) ?></textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Owner</label>
                        <input type="text" name="nama_owner" class="form-control"
                            value="<?= old('nama_owner', $profile['nama_owner']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Foto Owner</label>
                        <input type="file" name="foto_owner" class="form-control"
                            accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this, 'previewOwner')">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal ukuran file:
                            1MB (JPG, JPEG, PNG).</small>
                        <div class="mt-2">
                            <img id="previewOwner" src="<?= base_url($profile['foto_owner']) ?>" alt="Foto Owner"
                                class="mt-2" width="100">
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">CTA</label>
                    <textarea name="cta" class="form-control" rows="2"
                        required><?= old('cta', $profile['cta']) ?></textarea>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">No. Telp</label>
                        <input type="text" name="no_telp" class="form-control"
                            value="<?= old('no_telp', $profile['no_telp']) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="<?= old('email', $profile['email']) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Instagram</label>
                        <input type="text" name="instagram" class="form-control"
                            value="<?= old('instagram', $profile['instagram']) ?>" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"
                        required><?= old('alamat', $profile['alamat']) ?></textarea>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('admin/profile-perusahaan/index'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

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
    function previewImage(input, previewId) {
        let file = input.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<?= $this->endSection() ?>