<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Profile Perusahaan</h3>
    </div>

    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search"
                aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <a href="profile-perusahaan-add" class="btn btn-success">Tambah Data</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="align-middle">Nama Perusahaan</th>
                            <th class="align-middle">Deskripsi</th>
                            <th class="align-middle">Visi</th>
                            <th class="align-middle">Misi</th>
                            <th class="align-middle">Nama Karyawan</th>
                            <th class="align-middle">Foto</th>
                            <th class="align-middle">No. Telp</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">Instagram</th>
                            <th class="align-middle">Alamat</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < 4; $i++): ?>
                            <tr>
                                <td>PT Contoh</td>
                                <td>
                                    <div class="text-justify overflow-auto"
                                        style="max-height: 100px; width: 280px; white-space: normal;">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen book.
                                        It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                        the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                        with desktop publishing software like Aldus PageMaker including versions of Lorem
                                        Ipsum.
                                    </div>
                                </td>

                                <td>Menjadi Terbaik</td>
                                <td>Inovasi & Pelayanan</td>
                                <td>John Doe</td>
                                <td>
                                    <img src="/IMG/1.jpg" class="rectangle" width="75" height="75">
                                </td>
                                <td>08123456789</td>
                                <td>email@contoh.com</td>
                                <td>@instagram</td>
                                <td>
                                    <div class="text-justify" style="width: 180px;">
                                        Jl. Contoh No. 123
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    <div class="d-flex gap-2">
                                        <a href="profile-perusahaan-edit" class="btn btn-warning btn-sm" title="Edit">
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