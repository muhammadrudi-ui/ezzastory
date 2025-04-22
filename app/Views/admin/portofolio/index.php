<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Portofolio</h3>
    </div>

    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
        <form class="input-group" style="max-width: 250px;" method="GET"
            action="<?= base_url('admin/portofolio/index'); ?>">
            <input type="text" class="form-control" placeholder="Search..." name="search"
                value="<?= isset($search) ? esc($search) : ''; ?>">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <a href="<?= base_url('admin/portofolio/add') ?>" class="btn btn-success">Tambah Data</a>
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
                        <?php if (isset($portofolio) && count($portofolio) > 0): ?>
                            <?php foreach ($portofolio as $key => $porto): ?>
                                <tr>
                                    <td><?= ($porto['nama_mempelai']) ?></td>
                                    <td>
                                        <img src="<?= base_url('uploads/portofolio/' . $porto['foto_utama']) ?>"
                                            class="rectangle" width="75" height="75"
                                            style="object-fit: cover; border-radius: 3px;" alt="Foto Paket" loading="lazy">
                                    </td>
                                    <td><?= ($porto['jenis_layanan']) ?></td>
                                    <td class="text-nowrap align-middle">
                                        <div class="d-flex gap-2 justify-content-center align-items-center">
                                            <a href="<?= base_url('admin/portofolio/edit/' . $porto['id']) ?>"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit text-white"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" title="Hapus"
                                                onclick="confirmDelete(<?= $porto['id'] ?>)">
                                                <i class="fas fa-trash-alt text-white"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td class="text-center fw-bold py-3" style="width: 100%;" colspan="100%">
                                    Tidak ada data Portofolio
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <?= $pager->links('default', 'bootstrap_pagination') ?>
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
                window.location.href = "/admin/portofolio/delete/" + id;
            }
        });
    }
</script>

<!-- Tambahkan link SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>