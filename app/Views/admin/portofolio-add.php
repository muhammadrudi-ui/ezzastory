<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Tambah Portofolio</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('portofolio/store'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Mempelai</label>
                        <input type="text" name="nama_mempelai" class="form-control"
                            placeholder="Masukkan nama mempelai" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Foto</label>
                        <input type="file" name="foto" class="form-control"
                            onchange="previewImage(event, 'previewFoto')">
                        <img id="previewFoto" src="#" alt="Preview Foto" class="mt-2 d-none" width="100">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Jenis Layanan</label>
                    <select name="jenis_layanan" class="form-select" required>
                        <option value="" selected disabled>Pilih Jenis Layanan</option>
                        <option value="Wedding">Wedding</option>
                        <option value="Engagement">Engagement</option>
                        <option value="Pre-Wedding">Pre-Wedding</option>
                        <option value="Other">Lainnya</option>
                    </select>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('portofolio-view'); ?>" class="btn btn-secondary">Kembali</a>
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