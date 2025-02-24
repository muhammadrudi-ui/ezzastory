<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2 class="text-center text-primary fw-bold shadow-sm p-3 mb-4 bg-white rounded">Profile Perusahaan</h2>
    <div class="d-flex justify-content-end mb-3">
        <input type="text" class="form-control w-25 me-2" placeholder="Search...">
        <a href="#" class="btn btn-success">Tambah Data</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Deskripsi</th>
                            <th>Visi</th>
                            <th>Misi</th>
                            <th>Nama Karyawan</th>
                            <th>Foto</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Instagram</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PT Contoh</td>
                            <td>Perusahaan Teknologi</td>
                            <td>Menjadi Terbaik</td>
                            <td>Inovasi & Pelayanan</td>
                            <td>John Doe</td>
                            <td><img src="https://via.placeholder.com/50" class="rounded-circle"></td>
                            <td>08123456789</td>
                            <td>email@contoh.com</td>
                            <td>@instagram</td>
                            <td>Jl. Contoh No. 123</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>

                        <tr>
                            <td>PT Contoh</td>
                            <td>Perusahaan Teknologi</td>
                            <td>Menjadi Terbaik</td>
                            <td>Inovasi & Pelayanan</td>
                            <td>John Doe</td>
                            <td><img src="https://via.placeholder.com/50" class="rounded-circle"></td>
                            <td>08123456789</td>
                            <td>email@contoh.com</td>
                            <td>@instagram</td>
                            <td>Jl. Contoh No. 123</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>PT Contoh</td>
                            <td>Perusahaan Teknologi</td>
                            <td>Menjadi Terbaik</td>
                            <td>Inovasi & Pelayanan</td>
                            <td>John Doe</td>
                            <td><img src="https://via.placeholder.com/50" class="rounded-circle"></td>
                            <td>08123456789</td>
                            <td>email@contoh.com</td>
                            <td>@instagram</td>
                            <td>Jl. Contoh No. 123</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>PT Contoh</td>
                            <td>Perusahaan Teknologi</td>
                            <td>Menjadi Terbaik</td>
                            <td>Inovasi & Pelayanan</td>
                            <td>John Doe</td>
                            <td><img src="https://via.placeholder.com/50" class="rounded-circle"></td>
                            <td>08123456789</td>
                            <td>email@contoh.com</td>
                            <td>@instagram</td>
                            <td>Jl. Contoh No. 123</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>