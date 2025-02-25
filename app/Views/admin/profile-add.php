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
                        <label class="fw-bold">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" placeholder="Masukkan no. telepon"
                            required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Instagram</label>
                        <input type="text" name="instagram" class="form-control"
                            placeholder="Masukkan username Instagram">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi"
                        required></textarea>
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

                <div class="mt-3">
                    <label class="fw-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat perusahaan"
                        required></textarea>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Foto Perusahaan</label>
                    <input type="file" name="foto" class="form-control" onchange="previewImage(event)">
                    <img id="preview" src="#" alt="Preview" class="mt-2 d-none" width="100">
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('profile-perusahaan'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        let reader = new FileReader();
        reader.onload = function () {
            let output = document.getElementById('preview');
            output.src = reader.result;
            output.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?= $this->endSection() ?>