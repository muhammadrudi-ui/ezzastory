<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Portofolio</h3>
    </div>

    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search"
                aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <a href="portofolio-add" class="btn btn-success">Tambah Data</a>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="align-middle">Nama Mempelai</th>
                            <th class="align-middle">Foto</th>
                            <th class="align-middle">Jenis Layanan</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < 4; $i++): ?>
                            <tr>
                                <td>Jhon & Anne</td>
                                <td>
                                    <img src="/IMG/1.jpg" class="rectangle" width="75" height="75" loading="lazy">
                                </td>
                                <td>Wedding</td>
                                <td class="text-nowrap align-middle">
                                    <div class="d-flex gap-2 justify-content-center align-items-center">
                                        <a href="portofolio-edit" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit text-white"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="confirmDelete(<?= $i ?>)">
                                            <i class="fas fa-trash-alt text-white"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Konfirmasi Hapus",
            text: "Apakah Anda yakin ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "profile-perusahaan-delete/" + id;
            }
        });
    }
</script>

<!-- Tambahkan link SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>