<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Tambah Paket Layanan</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('paket-layanan/store'); ?>" method="POST">
                <div class="mb-3">
                    <label class="fw-bold">Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control" placeholder="Masukkan nama paket"
                        required>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Foto</label>
                    <input type="file" name="foto" class="form-control" onchange="previewImage(event, 'previewFoto')">
                    <img id="previewFoto" src="#" alt="Preview Foto" class="mt-2 d-none" width="100">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Benefit</label>
                    <textarea name="benefit" class="form-control" rows="3" placeholder="Masukkan benefit paket"
                        required></textarea>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Harga</label>
                    <input type="number" name="harga" class="form-control" placeholder="Masukkan harga paket" required>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('paket-layanan'); ?>" class="btn btn-secondary">Kembali</a>
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