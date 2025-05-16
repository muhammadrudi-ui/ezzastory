<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #343a40; color: white; }
        h3 { text-align: center; }
    </style>
</head>
<body>
    <h3>Laporan Keuangan <?= $filter_bulan ? 'Bulan ' . date('F Y', strtotime($filter_bulan . '-01')) : '' ?></h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal Pemesanan</th>
                <th>Nama Customer</th>
                <th>No. Telepon</th>
                <th>Paket Layanan</th>
                <th>Jenis Layanan</th>
                <th>Harga</th>
                <th>Jenis Pembayaran</th>
                <th>Jumlah Pembayaran</th>
                <th>Sisa Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pemesanan as $pesan): ?>
                <tr>
                    <td><?= date('Y-m-d', strtotime($pesan['waktu_pemesanan'])) ?></td>
                    <td><?= esc($pesan['nama_lengkap']) ?></td>
                    <td><?= esc($pesan['no_telepon']) ?></td>
                    <td><?= esc($pesan['nama_paket']) ?></td>
                    <td><?= esc($pesan['jenis_layanan']) ?></td>
                    <td>Rp <?= number_format($pesan['harga'], 0, ',', '.') ?></td>
                    <td><?= esc($pesan['jenis_pembayaran']) ?></td>
                    <td>Rp <?= number_format($pesan['jumlah_pembayaran'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($pesan['sisa_pembayaran'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h4>Total Pemasukan: Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></h4>
</body>
</html>