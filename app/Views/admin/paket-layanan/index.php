<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Paket Layanan</h3>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
        <form class="input-group" style="max-width: 250px;" method="GET"
            action="<?= base_url('admin/paket-layanan/index'); ?>">
            <input type="text" class="form-control" placeholder="Search..." name="search"
                value="<?= isset($search) ? esc($search) : ''; ?>">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <a href="<?= base_url('admin/paket-layanan/add') ?>" class="btn btn-success">Tambah Data</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Foto</th>
                            <th class="align-middle">Benefit</th>
                            <th class="align-middle">Harga</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($paketLayanan) && count($paketLayanan) > 0): ?>
                            <?php foreach ($paketLayanan as $key => $paket): ?>
                                <tr>
                                    <td><?= $paket['nama'] ?></td>
                                    <td>
                                        <img src="<?= base_url($paket['foto']) ?>" class="rectangle" width="75" height="75"
                                            style="object-fit: cover; border-radius: 3px;" alt="Foto Paket" loading="lazy">
                                    </td>
                                    <td><?= $paket['benefit'] ?></td>
                                    <td>Rp. <?= number_format($paket['harga'], 0, ',', '.') ?></td>
                                    <td class="text-nowrap">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="<?= base_url('admin/paket-layanan/edit/' . $paket['id']) ?>"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit text-white"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" title="Hapus"
                                                onclick="confirmDelete(<?= $paket['id'] ?>)">
                                                <i class="fas fa-trash-alt text-white"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td class="text-center fw-bold py-3" style="width: 100%;" colspan="100%">
                                    Tidak ada data paket layanan
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
                window.location.href = "<?= base_url('admin/paket-layanan/delete/') ?>" + id;
            }
        });
    }
</script>

<!-- Tambahkan link SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>