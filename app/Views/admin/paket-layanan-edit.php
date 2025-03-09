<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4 mb-4">
        <h3 class="text-start text-dark fw-bold">Edit Paket Layanan</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('paket-layanan/update/1'); ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="fw-bold">Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control" value="Paket Premium" required>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Foto</label>
                    <input type="file" name="foto" class="form-control">
                    <img src="/IMG/foto.jpg" alt="Foto" class="mt-2" width="100">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Benefit</label>
                    <textarea name="benefit" class="form-control" rows="3"
                        required>Benefit yang didapatkan...</textarea>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Harga</label>
                    <input type="text" name="harga" class="form-control" value="Rp 500.000" required>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('paket-layanan-view'); ?>" class="btn btn-secondary">Kembali</a>
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