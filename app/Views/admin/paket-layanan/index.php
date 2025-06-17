<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<style>
    .truncate-lines {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: left !important;
    }
    .truncate-lines ul {
        padding-left: 20px;
        margin: 0;
    }
    .truncate-lines li {
        list-style-type: disc;
        margin-bottom: 5px;
    }
</style>

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
                <table class="table table-striped align-middle">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center align-middle">Nama</th>
                            <th class="text-center align-middle">Foto</th>
                            <th class="text-left align-middle">Benefit</th>
                            <th class="text-center align-middle">Harga</th>
                            <th class="text-center align-middle">Jenis Layanan</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($paketLayanan) && count($paketLayanan) > 0): ?>
                            <?php foreach ($paketLayanan as $key => $paket): ?>
                                <tr>
                                    <td class="text-center"><?= esc($paket['nama']) ?></td>
                                    <td class="text-center">
                                        <img src="<?= base_url($paket['foto']) ?>" class="rectangle" width="75" height="75"
                                            style="object-fit: cover; border-radius: 3px;" alt="Foto Paket" loading="lazy">
                                    </td>
                                    <td class="text-left">
                                        <div class="truncate-lines" title="<?= strip_tags($paket['benefit']) ?>">
                                            <?= $paket['benefit'] ?>
                                        </div>
                                    </td>
                                    <td class="text-center">Rp. <?= number_format($paket['harga'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= esc($paket['jenis_layanan']) ?></td>
                                    <td class="text-center text-nowrap">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>