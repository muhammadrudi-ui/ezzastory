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
                paket_layanan.harga AS harga,
                paket_layanan.jenis_layanan AS jenis_layanan
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
                paket_layanan.harga AS harga,
                paket_layanan.jenis_layanan AS jenis_layanan
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
                ->orLike('paket_layanan.jenis_layanan', $search)
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

        // Create new Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('Your System Name')
            ->setTitle('Laporan Pemesanan Selesai')
            ->setSubject('Laporan Pemesanan')
            ->setDescription('Laporan pemesanan yang sudah selesai diproses');

        // Report Title
        $sheet->mergeCells('A1:O1');
        $sheet->setCellValue('A1', 'LAPORAN PEMESANAN SELESAI');
        $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        if ($filterBulan) {
            $sheet->mergeCells('A2:O2');
            $sheet->setCellValue('A2', 'Periode: ' . date('F Y', strtotime($filterBulan . '-01')));
            $sheet->getStyle('A2')->getFont()->setSize(12);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        // Column Headers
        $headers = [
            'No',
            'Nama Lengkap',
            'Email',
            'No Telepon',
            'Tanggal Pemesanan',
            'Paket Layanan',
            'Jenis Layanan',
            'Harga (Rp)',
            'Tanggal Pemotretan',
            'Jenis Pembayaran',
            'Lokasi Pemotretan',
            'Link Maps Lokasi Pemotretan',
            'Link Maps Lokasi Pengiriman Album',
            'Nama Mempelai',
            'Instagram'
        ];

        // Set header styles
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
                'startColor' => ['rgb' => '4472C4']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF']
                ]
            ]
        ];

        // Write headers
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col.'4', $header);
            $sheet->getColumnDimension($col)->setAutoSize(true);
            $col++;
        }
        $sheet->getStyle('A4:O4')->applyFromArray($headerStyle);
        $sheet->getRowDimension(4)->setRowHeight(25);

        // Data rows
        $row = 5;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue("A$row", $no++);
            $sheet->setCellValue("B$row", $item['nama_lengkap'] ?? '');
            $sheet->setCellValue("C$row", $item['email'] ?? '');
            $sheet->setCellValue("D$row", $item['no_telepon'] ?? '');
            $sheet->setCellValue("E$row", !empty($item['waktu_pemesanan']) ? date('d/m/Y H:i', strtotime($item['waktu_pemesanan'])) : '');
            $sheet->setCellValue("F$row", $item['nama_paket'] ?? '');
            $sheet->setCellValue("G$row", $item['jenis_layanan'] ?? '');

            // Format price with proper number format
            $sheet->setCellValue("H$row", $item['harga'] ?? 0);
            $sheet->getStyle("H$row")->getNumberFormat()->setFormatCode('#,##0');

            $sheet->setCellValue("I$row", !empty($item['waktu_pemotretan']) ? date('d/m/Y H:i', strtotime($item['waktu_pemotretan'])) : '');
            $sheet->setCellValue("J$row", !empty($item['jenis_pembayaran']) ? ucfirst($item['jenis_pembayaran']) : '');
            $sheet->setCellValue("K$row", $item['lokasi_pemotretan'] ?? '');

            // Link Maps Pemotretan
            if (!empty($item['link_maps_pemotretan'])) {
                $sheet->setCellValue("L$row", 'Link Lokasi Pemotretan');
                $sheet->getCell("L$row")->getHyperlink()->setUrl($item['link_maps_pemotretan']);
            } else {
                $sheet->setCellValue("L$row", '-');
            }

            // Link Maps Pengiriman
            if (!empty($item['link_maps_pengiriman'])) {
                $sheet->setCellValue("M$row", 'Link Lokasi Pengiriman');
                $sheet->getCell("M$row")->getHyperlink()->setUrl($item['link_maps_pengiriman']);
            } else {
                $sheet->setCellValue("M$row", '-');
            }

            $sheet->setCellValue("N$row", $item['nama_mempelai'] ?? '');

            // Instagram handle
            if (!empty($item['instagram'])) {
                $instagram = ltrim($item['instagram'], '@');
                $sheet->setCellValue("O$row", '@' . $instagram);
                $sheet->getCell("O$row")->getHyperlink()->setUrl('https://instagram.com/' . $instagram);
            } else {
                $sheet->setCellValue("O$row", '-');
            }

            $row++;
        }

        // Apply data styles
        $dataStyle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ],
                'inside' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD']
                ]
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ]
        ];
        $sheet->getStyle('A5:O'.($row - 1))->applyFromArray($dataStyle);

        // Format date columns
        $sheet->getStyle('E5:E'.($row - 1))->getNumberFormat()->setFormatCode('dd/mm/yyyy hh:mm');
        $sheet->getStyle('I5:I'.($row - 1))->getNumberFormat()->setFormatCode('dd/mm/yyyy hh:mm');

        // Format numeric columns
        $sheet->getStyle('H5:H'.($row - 1))->getNumberFormat()->setFormatCode('#,##0');

        // Hyperlink styles
        $hyperlinkStyle = [
            'font' => [
                'color' => ['rgb' => '0563C1'],
                'underline' => \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE
            ]
        ];
        $sheet->getStyle('L5:L'.($row - 1))->applyFromArray($hyperlinkStyle);
        $sheet->getStyle('M5:M'.($row - 1))->applyFromArray($hyperlinkStyle);
        $sheet->getStyle('O5:O'.($row - 1))->applyFromArray($hyperlinkStyle);

        // Alternate row coloring
        for ($i = 5; $i < $row; $i++) {
            if ($i % 2 == 0) {
                $sheet->getStyle("A$i:O$i")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFEEEEEE');
            }
        }

        // Set column widths for better display
        $sheet->getColumnDimension('B')->setWidth(25); // Nama Lengkap
        $sheet->getColumnDimension('C')->setWidth(25); // Email
        $sheet->getColumnDimension('E')->setWidth(18); // Tanggal Pemesanan
        $sheet->getColumnDimension('F')->setWidth(20); // Paket Layanan
        $sheet->getColumnDimension('G')->setWidth(15); // Jenis Layanan
        $sheet->getColumnDimension('H')->setWidth(15); // Harga
        $sheet->getColumnDimension('I')->setWidth(18); // Tanggal Pemotretan
        $sheet->getColumnDimension('J')->setWidth(15); // Jenis Pembayaran
        $sheet->getColumnDimension('K')->setWidth(25); // Lokasi Pemotretan
        $sheet->getColumnDimension('L')->setWidth(20); // Link Maps Pemotretan
        $sheet->getColumnDimension('M')->setWidth(20); // Link Maps Pengiriman
        $sheet->getColumnDimension('N')->setWidth(20); // Nama Mempelai
        $sheet->getColumnDimension('O')->setWidth(15); // Instagram

        // Freeze header row
        $sheet->freezePane('A5');

        // Set print settings
        $sheet->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4)
            ->setFitToWidth(1)
            ->setFitToHeight(0);

        // Download file
        $filename = 'Laporan_Pemesanan_Selesai_' . ($filterBulan ? date('F_Y', strtotime($filterBulan . '-01')) : 'Semua') . '_' . date('YmdHis') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
