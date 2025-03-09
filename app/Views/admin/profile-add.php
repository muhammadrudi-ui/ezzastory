<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Tambah Data Perusahaan</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('profile/store'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control"
                            placeholder="Masukkan nama perusahaan" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Logo Perusahaan</label>
                        <input type="file" name="logo" class="form-control"
                            onchange="previewImage(event, 'previewLogo')">
                        <img id="previewLogo" src="#" alt="Preview Logo" class="mt-2 d-none" width="100">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi"
                        required></textarea>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 1</label>
                        <input type="file" name="slider1" class="form-control"
                            onchange="previewImage(event, 'previewSlider1')">
                        <img id="previewSlider1" src="#" alt="Preview Slider 1" class="mt-2 d-none" width="100">
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 2</label>
                        <input type="file" name="slider2" class="form-control"
                            onchange="previewImage(event, 'previewSlider2')">
                        <img id="previewSlider2" src="#" alt="Preview Slider 2" class="mt-2 d-none" width="100">
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 3</label>
                        <input type="file" name="slider3" class="form-control"
                            onchange="previewImage(event, 'previewSlider3')">
                        <img id="previewSlider3" src="#" alt="Preview Slider 3" class="mt-2 d-none" width="100">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 1</label>
                        <input type="text" name="keunggulan1" class="form-control"
                            placeholder="Masukkan keunggulan pertama" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 2</label>
                        <input type="text" name="keunggulan2" class="form-control"
                            placeholder="Masukkan keunggulan kedua" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 3</label>
                        <input type="text" name="keunggulan3" class="form-control"
                            placeholder="Masukkan keunggulan ketiga" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Background Judul</label>
                    <input type="file" name="bg_judul" class="form-control"
                        onchange="previewImage(event, 'previewBgJudul')">
                    <img id="previewBgJudul" src="#" alt="Preview BG Judul" class="mt-2 d-none" width="100">
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Visi</label>
                        <textarea name="visi" class="form-control" rows="2" placeholder="Masukkan visi perusahaan"
                            required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Misi</label>
                        <textarea name="misi" class="form-control" rows="2" placeholder="Masukkan misi perusahaan"
                            required></textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Owner</label>
                        <input type="text" name="nama_owner" class="form-control" placeholder="Masukkan nama owner"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Foto Owner</label>
                        <input type="file" name="foto_owner" class="form-control"
                            onchange="previewImage(event, 'previewOwner')">
                        <img id="previewOwner" src="#" alt="Preview Owner" class="mt-2 d-none" width="100">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">CTA</label>
                    <textarea name="cta" class="form-control" rows="2" placeholder="Masukkan kalimat CTA"
                        required></textarea>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" placeholder="Masukkan no. telepon"
                            required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Instagram</label>
                        <input type="text" name="instagram" class="form-control"
                            placeholder="Masukkan username Instagram">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat perusahaan"
                        required></textarea>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('paket-layanan-view'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

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