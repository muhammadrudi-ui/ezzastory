<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<style>
    .ellipsis-multiline {
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Profile Perusahaan</h3>
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

    <!-- Add Data -->
    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
        <a href="<?= base_url('admin/profile-perusahaan/add') ?>" class="btn btn-success">Tambah Data</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="align-middle">Nama Perusahaan</th>
                            <th class="align-middle">Logo</th>
                            <th class="align-middle">Deskripsi</th>
                            <th class="align-middle">Slider 1</th>
                            <th class="align-middle">Slider 2</th>
                            <th class="align-middle">Slider 3</th>
                            <th class="align-middle">Keunggulan 1</th>
                            <th class="align-middle">Keunggulan 2</th>
                            <th class="align-middle">Keunggulan 3</th>
                            <th class="align-middle">Background Judul</th>
                            <th class="align-middle">Visi</th>
                            <th class="align-middle">Misi</th>
                            <th class="align-middle">Nama Owner</th>
                            <th class="align-middle">Foto Owner</th>
                            <th class="align-middle">CTA</th>
                            <th class="align-middle">No. Telp</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">Instagram</th>
                            <th class="align-middle">Alamat</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($profileModel) && count($profileModel) > 0): ?>
                            <?php foreach ($profileModel as $key => $profile): ?>
                                <tr>
                                    <td><?= $profile['nama_perusahaan'] ?></td>
                                    <td>
                                        <img src="<?= base_url($profile['logo']) ?>" class="rectangle" width="75" height="75"
                                            style="object-fit: cover; border-radius: 3px;" alt="Logo Perusahaan" loading="lazy">
                                    </td>
                                    <td>
                                        <div class="text-start ellipsis-multiline" style="max-width: 280px;">
                                            <?= esc($profile['deskripsi']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="<?= base_url($profile['slider_1']) ?>" class="rectangle" width="75"
                                            height="75" style="object-fit: cover; border-radius: 3px;" alt="Slider 1"
                                            loading="lazy">
                                    </td>
                                    <td>
                                        <img src="<?= base_url($profile['slider_2']) ?>" class="rectangle" width="75"
                                            height="75" style="object-fit: cover; border-radius: 3px;" alt="Slider 2"
                                            loading="lazy">
                                    </td>
                                    <td>
                                        <img src="<?= base_url($profile['slider_3']) ?>" class="rectangle" width="75"
                                            height="75" style="object-fit: cover; border-radius: 3px;" alt="Slider 3"
                                            loading="lazy">
                                    </td>
                                    <td><?= $profile['keunggulan_1'] ?></td>
                                    <td><?= $profile['keunggulan_2'] ?></td>
                                    <td><?= $profile['keunggulan_3'] ?></td>
                                    <td>
                                        <img src="<?= base_url($profile['background_judul']) ?>" class="rectangle" width="75"
                                            height="75" style="object-fit: cover; border-radius: 3px;" alt="Background Judul"
                                            loading="lazy">
                                    </td>
                                    <td>
                                        <div class="text-start ellipsis-multiline" style="max-width: 200px;">
                                            <?= esc($profile['visi']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-start ellipsis-multiline" style="max-width: 200px;">
                                            <?= esc($profile['misi']) ?>
                                        </div>
                                    </td>
                                    <td><?= $profile['nama_owner'] ?></td>
                                    <td>
                                        <img src="<?= base_url($profile['foto_owner']) ?>" class="rectangle" width="75"
                                            height="75" style="object-fit: cover; border-radius: 3px;" alt="Foto Owner"
                                            loading="lazy">
                                    </td>
                                    <td>
                                        <div class="text-justify overflow-auto"
                                            style="max-height: 100px; width: 280px; white-space: normal;">
                                            <?= $profile['cta'] ?>
                                        </div>
                                    </td>
                                    <td><?= $profile['no_telp'] ?></td>
                                    <td><?= $profile['email'] ?></td>
                                    <td><?= $profile['instagram'] ?></td>
                                    <td>
                                        <div class="text-justify" style="width: 180px;">
                                            <?= $profile['alamat'] ?>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex gap-2">
                                            <a href="<?= base_url('admin/profile-perusahaan/edit/' . $profile['id']) ?>"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit text-white"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" title="Hapus"
                                                onclick="confirmDelete(<?= $profile['id'] ?>)">
                                                <i class="fas fa-trash-alt text-white"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td class="text-center fw-bold py-3" style="width: 100%;" colspan="100%">
                                    Tidak ada data profile perusahaan
                                </td>
                            </tr>
                        <?php endif; ?>
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
                window.location.href = "<?= base_url('admin/profile-perusahaan/delete/') ?>" + id;
            }
        });
    }

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>