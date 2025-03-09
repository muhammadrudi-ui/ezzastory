<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Edit Data Perusahaan</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('profile/update/1'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" value="PT Contoh Teknologi"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Logo</label>
                        <input type="file" name="logo" class="form-control">
                        <img id="logo-preview" src="/IMG/logo.jpg" alt="Logo" class="mt-2" width="100">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"
                        required>Perusahaan Teknologi yang bergerak di bidang pengembangan software.</textarea>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 1</label>
                        <input type="file" name="slider1" class="form-control">
                        <img src="/IMG/slider1.jpg" alt="Slider 1" class="mt-2" width="100">
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 2</label>
                        <input type="file" name="slider2" class="form-control">
                        <img src="/IMG/slider2.jpg" alt="Slider 2" class="mt-2" width="100">
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Slider 3</label>
                        <input type="file" name="slider3" class="form-control">
                        <img src="/IMG/slider3.jpg" alt="Slider 3" class="mt-2" width="100">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 1</label>
                        <input type="text" name="keunggulan1" class="form-control" value="Inovasi Teknologi">
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 2</label>
                        <input type="text" name="keunggulan2" class="form-control" value="Layanan Terbaik">
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Keunggulan 3</label>
                        <input type="text" name="keunggulan3" class="form-control" value="Tim Profesional">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Background Judul</label>
                    <input type="file" name="background_judul" class="form-control">
                    <img src="/IMG/bg-title.jpg" alt="Background Judul" class="mt-2" width="100">
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Visi</label>
                        <textarea name="visi" class="form-control" rows="2"
                            required>Menjadi perusahaan teknologi terbaik.</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Misi</label>
                        <textarea name="misi" class="form-control" rows="2"
                            required>Mengembangkan produk inovatif.</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Owner</label>
                        <input type="text" name="nama_owner" class="form-control" value="John Doe">
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Foto Owner</label>
                        <input type="file" name="foto_owner" class="form-control">
                        <img src="/IMG/owner.jpg" alt="Foto Owner" class="mt-2" width="100">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="fw-bold">No. Telp</label>
                        <input type="text" name="no_telp" class="form-control" value="08123456789" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="email@contoh.com" required>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Instagram</label>
                        <input type="text" name="instagram" class="form-control" value="@contohtech">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"
                        required>Jl. Contoh No. 123, Jakarta</textarea>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('profile-perusahaan'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

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