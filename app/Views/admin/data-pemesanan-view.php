<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="title mt-4">
        <h3 class="text-start text-dark fw-bold">Data Pemesanan</h3>
    </div>

    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
        <div class="input-group" style="max-width: 250px;">
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search"
                aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="input-group" style="max-width: 180px;">
            <input type="month" class="form-control" id="filterBulan" placeholder="Pilih Bulan">
        </div>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle d-flex align-items-center gap-2" type="button"
                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-filter"></i> Filter Status
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#"><i class="fas fa-camera"></i> Proses Pemotretan</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Proses Editing</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-print"></i> Pencetakan Album</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-check-circle"></i> Pemesanan Diterima</a></li>
            </ul>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Lokasi</th>
                            <th class="align-middle">Jenis Layanan</th>
                            <th class="align-middle">Pilihan Paket</th>
                            <th class="align-middle">Tanggal Pemesanan</th>
                            <th class="align-middle">Waktu Pemotretan</th>
                            <th class="align-middle">Status</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < 4; $i++): ?>
                            <tr>
                                <td>PT Contoh</td>
                                <td>Jakarta</td>
                                <td>Wedding</td>
                                <td>Paket Platinum</td>
                                <td>2025-02-27</td>
                                <td>2025-03-05 08:00</td>
                                <td>Pemotretan</td>
                                <td class="text-nowrap">
                                    <div class="d-flex gap-2">
                                        <a href="data-pemesanan-edit" class="btn btn-warning btn-sm" title="Edit">
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