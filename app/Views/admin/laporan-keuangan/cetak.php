<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1.5cm 1cm 1cm 1cm;
            @top-center {
                content: element(header);
            }
        }
        
        .header {
            position: running(header);
            text-align: center;
            padding: 5px 0;
            border-bottom: 2px solid #2c3e50;
            background-color: white;
            margin-bottom: 15px;
        }
        
        .header-fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: white;
            text-align: center;
            padding: 5px 0;
            border-bottom: 2px solid #2c3e50;
            margin: 0;
        }
        
        body { 
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.4;
            color: #333;
            font-size: 10pt;
            padding-top: 100px; /* Space Padding Top */
        }
        
        .content {
            margin-top: 20px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 16pt;
            color: #2c3e50;
            font-weight: bold;
        }
        
        .header .company-info {
            margin: 2px 0;
            font-size: 8pt;
            color: #555;
        }
        
        .header .period {
            margin: 2px 0;
            font-size: 10pt;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .summary-table {
            width: 100%;
            margin: 15px 0;
            border-collapse: collapse;
            page-break-inside: avoid;
        }
        
        .summary-table th, 
        .summary-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        .summary-table th {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        
        .summary-table .total-cell {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        
        .jenis-layanan-section {
            margin: 20px 0;
            page-break-inside: avoid;
        }
        
        .jenis-layanan-title {
            background-color: #f8f9fa;
            padding: 8px 12px;
            border-left: 4px solid #3498db;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 11pt;
        }
        
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 9pt;
        }
        
        .detail-table th, 
        .detail-table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
        }
        
        .detail-table th {
            background-color: #34495e;
            color: white;
            font-weight: bold;
        }
        
        .detail-table .total-row {
            background-color: #ecf0f1;
            font-weight: bold;
        }
        
        .grand-total {
            margin: 25px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border: 2px solid #3498db;
            text-align: center;
            page-break-inside: avoid;
        }
        
        .grand-total h3 {
            margin: 0 0 5px 0;
            color: #2c3e50;
            font-size: 12pt;
        }
        
        .grand-total h2 {
            margin: 0;
            color: #3498db;
            font-size: 16pt;
        }
        
        .print-info {
            margin-top: 20px;
            font-size: 8pt;
            color: #777;
            text-align: right;
        }
        
        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        thead {
            display: table-header-group;
        }
        
        tfoot {
            display: table-footer-group;
        }
        
        /* Media query khusus untuk print */
        @media print {
            .header-fixed {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
            }
            
            body {
                padding-top: 80px !important;
            }
            
            .content {
                margin-top: 0;
            }
            
            .force-page-break {
                page-break-before: always;
            }
        }
        
        .page-header {
            display: none;
        }
        
        @media print {
            .page-header {
                display: block;
                text-align: center;
                padding: 5px 0;
                border-bottom: 2px solid #2c3e50;
                margin-bottom: 15px;
                page-break-after: avoid;
            }
            
            .page-header h1 {
                margin: 0;
                font-size: 16pt;
                color: #2c3e50;
                font-weight: bold;
            }
            
            .page-header .company-info {
                margin: 2px 0;
                font-size: 8pt;
                color: #555;
            }
            
            .page-header .period {
                margin: 2px 0;
                font-size: 10pt;
                font-weight: bold;
                color: #2c3e50;
            }
        }
    </style>
</head>
<body>
    <!-- Header Fixed untuk tampilan dan print -->
    <div class="header header-fixed">
        <h1>EZZASTORY</h1>
        <div class="company-info">
            Desa Badean, Kecamatan Blimbingsari, Kabupaten Banyuwangi | Telp: 082245670135 | Email: ezzastory@gmail.com
        </div>
        <div class="period"><?= $periode_display ?></div>
    </div>

    <div class="content">
        <!-- Ringkasan Per Jenis Layanan -->
        <table class="summary-table">
            <thead>
                <tr>
                    <th style="width: 40%;">Jenis Layanan</th>
                    <th style="width: 30%;">Total Pemasukan</th>
                    <th style="width: 30%;">Persentase</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jenis_layanan as $jenis): ?>
                    <?php if (!empty($data_pemesanan_per_jenis[$jenis])): ?>
                    <tr>
                        <td><?= esc($jenis) ?></td>
                        <td style="text-align: right;">Rp <?= number_format($total_pemasukan_per_jenis[$jenis], 0, ',', '.') ?></td>
                        <td style="text-align: right;"><?= $total_pemasukan_keseluruhan > 0 ? number_format(($total_pemasukan_per_jenis[$jenis] / $total_pemasukan_keseluruhan) * 100, 2) : 0 ?>%</td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                <tr class="total-cell">
                    <td><strong>TOTAL KESELURUHAN</strong></td>
                    <td style="text-align: right;"><strong>Rp <?= number_format($total_pemasukan_keseluruhan, 0, ',', '.') ?></strong></td>
                    <td style="text-align: right;"><strong>100%</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Detail Per Jenis Layanan -->
        <?php foreach ($jenis_layanan as $jenis): ?>
            <?php if (!empty($data_pemesanan_per_jenis[$jenis])): ?>
            
            <!-- Header untuk setiap section yang mungkin berpindah halaman -->
            <div class="page-header">
                <h1>EZZASTORY</h1>
                <div class="company-info">
                    Desa Badean, Kecamatan Blimbingsari, Kabupaten Banyuwangi | Telp: 082245670135 | Email: ezzastory@gmail.com
                </div>
                <div class="period"><?= $periode_display ?></div>
            </div>
            
            <div class="jenis-layanan-section">
                <div class="jenis-layanan-title">
                    <?= esc($jenis) ?> - Total: Rp <?= number_format($total_pemasukan_per_jenis[$jenis], 0, ',', '.') ?>
                </div>
                
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th style="width: 12%;">Tanggal</th>
                            <th style="width: 20%;">Nama Customer</th>
                            <th style="width: 18%;">Paket Layanan</th>
                            <th style="width: 12%;">Harga</th>
                            <th style="width: 13%;">Jenis Pembayaran</th>
                            <th style="width: 13%;">Dibayar</th>
                            <th style="width: 12%;">Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_pemesanan_per_jenis[$jenis] as $pesan): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($pesan['waktu_pemesanan'])) ?></td>
                            <td><?= esc($pesan['nama_lengkap']) ?></td>
                            <td><?= esc($pesan['nama_paket']) ?></td>
                            <td style="text-align: right;">Rp <?= number_format($pesan['harga'], 0, ',', '.') ?></td>
                            <td><?= esc($pesan['jenis_pembayaran']) ?></td>
                            <td style="text-align: right;">Rp <?= number_format($pesan['jumlah_pembayaran'], 0, ',', '.') ?></td>
                            <td style="text-align: right;">Rp <?= number_format($pesan['sisa_pembayaran'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="total-row">
                            <td colspan="6"><strong>Total <?= esc($jenis) ?></strong></td>
                            <td style="text-align: right;"><strong>Rp <?= number_format($total_pemasukan_per_jenis[$jenis], 0, ',', '.') ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Grand Total -->
        <div class="grand-total">
            <h3>TOTAL PEMASUKAN KESELURUHAN</h3>
            <h2>Rp <?= number_format($total_pemasukan_keseluruhan, 0, ',', '.') ?></h2>
        </div>

        <div class="print-info">
            Dicetak pada: <?= $tanggal_cetak ?> | EZZASTORY - Laporan Keuangan
        </div>
    </div>
</body>
</html>