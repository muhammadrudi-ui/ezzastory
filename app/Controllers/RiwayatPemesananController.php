<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PemesananModel;
use App\Models\PaketLayananModel;
use App\Models\ProfilePerusahaanModel;
use App\Models\UserModel;
use App\Models\PembayaranModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RiwayatPemesananController extends BaseController
{
    protected $pemesananModel;
    protected $paketLayananModel;
    protected $profileModel;
    protected $userModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
        $this->profileModel = new ProfilePerusahaanModel();
        $this->paketLayananModel = new PaketLayananModel();
        $this->userModel = new UserModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function riwayat()
    {
        $search = $this->request->getGet('search');
        $filterBulan = $this->request->getGet('filter_bulan');

        $builder = $this->pemesananModel
            ->select('
                pemesanan.*, 
                users.username AS nama_user, 
                users.email, 
                user_profile.nama_lengkap, 
                user_profile.no_telepon, 
                user_profile.instagram, 
                paket_layanan.nama AS nama_paket,
                paket_layanan.harga AS harga
            ')
            ->join('users', 'users.id = pemesanan.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id = users.id', 'left')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->where('pemesanan.status', 'Selesai')
            ->orderBy('pemesanan.status_selesai_at', 'DESC');

        if ($search) {
            $builder->groupStart()
                ->like('user_profile.nama_lengkap', $search)
                ->orLike('paket_layanan.nama', $search)
                ->orLike('pemesanan.jenis_pembayaran', $search)
                ->orLike('pemesanan.lokasi_pemotretan', $search)
                ->orLike('pemesanan.nama_mempelai', $search)
                ->groupEnd();
        }

        if ($filterBulan) {
            $builder->where("DATE_FORMAT(pemesanan.waktu_pemesanan, '%Y-%m') =", $filterBulan);
        }

        $data = [
            'riwayat' => $builder->findAll(),
            'search' => $search,
            'filterBulan' => $filterBulan
        ];

        return view('admin/data-pemesanan/riwayat', $data);
    }

    public function exportExcel()
    {
        $search = $this->request->getGet('search');
        $filterBulan = $this->request->getGet('filter_bulan');

        $builder = $this->pemesananModel
            ->select('
                pemesanan.*, 
                users.username AS nama_user, 
                users.email, 
                user_profile.nama_lengkap, 
                user_profile.no_telepon, 
                user_profile.instagram, 
                paket_layanan.nama AS nama_paket,
                paket_layanan.harga AS harga
            ')
            ->join('users', 'users.id = pemesanan.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id = users.id', 'left')
            ->join('paket_layanan', 'paket_layanan.id = pemesanan.paket_id', 'left')
            ->where('pemesanan.status', 'Selesai')
            ->orderBy('pemesanan.created_at', 'DESC');

        if ($search) {
            $builder->groupStart()
                ->like('user_profile.nama_lengkap', $search)
                ->orLike('paket_layanan.nama', $search)
                ->orLike('pemesanan.jenis_pembayaran', $search)
                ->orLike('pemesanan.lokasi_pemotretan', $search)
                ->orLike('pemesanan.nama_mempelai', $search)
                ->orLike('pemesanan.status', $search)
                ->groupEnd();
        }

        if ($filterBulan) {
            $builder->where("DATE_FORMAT(pemesanan.waktu_pemesanan, '%Y-%m') =", $filterBulan);
        }

        $data = $builder->findAll();

        // Buat file Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul Laporan
        $sheet->mergeCells('A1:N1');
        $sheet->setCellValue('A1', 'LAPORAN PEMESANAN SELESAI');
        if ($filterBulan) {
            $sheet->mergeCells('A2:N2');
            $sheet->setCellValue('A2', 'Periode: ' . date('F Y', strtotime($filterBulan . '-01')));
        }

        // Header Kolom
        $headers = [
            'No',
            'Nama Lengkap',
            'Email',
            'No Telepon',
            'Tanggal Pemesanan',
            'Paket Layanan',
            'Harga (Rp)',
            'Tanggal Pemotretan',
            'Jenis Pembayaran',
            'Lokasi Pemotretan',
            'Link Maps Lokasi Pemotretan',
            'Link Maps Lokasi Pengiriman Album',
            'Nama Mempelai',
            'Instagram'
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col.'4', $header);
            $sheet->getColumnDimension($col)->setAutoSize(true);
            $col++;
        }

        // Isi data
        $row = 5;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue("A$row", $no++);
            $sheet->setCellValue("B$row", $item['nama_lengkap']);
            $sheet->setCellValue("C$row", $item['email']);
            $sheet->setCellValue("D$row", $item['no_telepon']);
            $sheet->setCellValue("E$row", date('d/m/Y H:i', strtotime($item['waktu_pemesanan'])));
            $sheet->setCellValue("F$row", $item['nama_paket']);

            // Format harga dengan benar (tanpa pembagian 100)
            $harga = $item['harga'];
            $sheet->setCellValue("G$row", $harga);
            $sheet->getStyle("G$row")->getNumberFormat()->setFormatCode('#,##0');

            $sheet->setCellValue("H$row", date('d/m/Y H:i', strtotime($item['waktu_pemotretan'])));
            $sheet->setCellValue("I$row", ucfirst($item['jenis_pembayaran']));
            $sheet->setCellValue("J$row", $item['lokasi_pemotretan']);

            // Link Maps Pemotretan
            if (!empty($item['link_maps_pemotretan'])) {
                $sheet->setCellValue("K$row", 'Link Lokasi Pemotretan');
                $sheet->getCell("K$row")->getHyperlink()->setUrl($item['link_maps_pemotretan']);
            } else {
                $sheet->setCellValue("K$row", '-');
            }

            // Link Maps Pengiriman
            if (!empty($item['link_maps_pengiriman'])) {
                $sheet->setCellValue("L$row", 'Link Lokasi Pengiriman');
                $sheet->getCell("L$row")->getHyperlink()->setUrl($item['link_maps_pengiriman']);
            } else {
                $sheet->setCellValue("L$row", '-');
            }

            $sheet->setCellValue("M$row", $item['nama_mempelai']);

            // Username Instagram
            if (!empty($item['instagram'])) {
                $instagram = $item['instagram'];
                // Pastikan tidak ada @ ganda
                $instagram = ltrim($instagram, '@');
                $sheet->setCellValue("N$row", '@' . $instagram);
                $sheet->getCell("N$row")->getHyperlink()->setUrl('https://instagram.com/' . $instagram);
            } else {
                $sheet->setCellValue("N$row", '-');
            }

            $row++;
        }

        // Styling judul
        $titleStyle = [
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD']
            ]
        ];
        $sheet->getStyle('A1:A2')->applyFromArray($titleStyle);
        $sheet->getRowDimension(1)->setRowHeight(25);
        $sheet->getRowDimension(2)->setRowHeight(20);

        // Styling header kolom
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF']
                ]
            ]
        ];
        $sheet->getStyle('A4:N4')->applyFromArray($headerStyle);
        $sheet->getRowDimension(4)->setRowHeight(25);

        // Styling isi data
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD']
                ]
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ]
        ];
        $sheet->getStyle('A5:N'.($row - 1))->applyFromArray($dataStyle);

        // Format angka untuk kolom harga (tanpa pembagian 100)
        $sheet->getStyle('G5:G'.($row - 1))->getNumberFormat()->setFormatCode('#,##0');

        // Format tanggal
        $sheet->getStyle('E5:E'.($row - 1))->getNumberFormat()->setFormatCode('dd/mm/yyyy hh:mm');
        $sheet->getStyle('H5:H'.($row - 1))->getNumberFormat()->setFormatCode('dd/mm/yyyy hh:mm');

        // Style untuk hyperlink
        $hyperlinkStyle = [
            'font' => [
                'color' => ['rgb' => '0563C1'],
                'underline' => \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE
            ]
        ];
        $sheet->getStyle('K5:K'.($row - 1))->applyFromArray($hyperlinkStyle);
        $sheet->getStyle('L5:L'.($row - 1))->applyFromArray($hyperlinkStyle);
        $sheet->getStyle('N5:N'.($row - 1))->applyFromArray($hyperlinkStyle);

        // Alternating row color
        $alternateColor = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E6E6E6']
            ]
        ];
        for ($i = 5; $i < $row; $i++) {
            if ($i % 2 == 0) {
                $sheet->getStyle('A'.$i.':N'.$i)->applyFromArray($alternateColor);
            }
        }

        // Freeze header
        $sheet->freezePane('A5');

        // Unduh file
        $filename = 'Laporan_Pemesanan_Selesai_' . ($filterBulan ? $filterBulan . '_' : '') . date('YmdHis') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
