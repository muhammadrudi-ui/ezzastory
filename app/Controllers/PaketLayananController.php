<?php

namespace App\Controllers;

use App\Models\PaketLayananModel;
use App\Models\ProfilePerusahaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class PaketLayananController extends BaseController
{
    protected $paketLayananModel;

    public function __construct()
    {
        $this->paketLayananModel = new PaketLayananModel();
        $this->profileModel = new ProfilePerusahaanModel();
    }

    public function index()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        $data['paket_layanan'] = $this->paketLayananModel->findAll();
        return view('user/paket-layanan', $data);
    }

    public function index_admin()
    {
        $perPage = 5; // Jumlah data per halaman
        $search = $this->request->getGet('search'); // Ambil nilai input pencarian

        if ($search) {
            $this->paketLayananModel
                ->groupStart()
                ->like('nama', $search)
                ->orLike('benefit', $search)
                ->orLike('harga', $search)
                ->groupEnd();
        }

        $data['paketLayanan'] = $this->paketLayananModel->paginate($perPage);
        $data['pager'] = $this->paketLayananModel->pager;
        $data['search'] = $search; // Kirim data pencarian ke view

        return view('admin/paket-layanan/index', $data);
    }


    public function add_admin()
    {
        return view('admin/paket-layanan/add');
    }

    public function store()
    {
        // Validasi input
        $rules = [
            'nama_paket' => 'required',
            'benefit' => 'required',
            'harga' => 'required|numeric|greater_than[0]',
            'foto' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload file
        $file = $this->request->getFile('foto');
        $fileName = $file->getRandomName();
        $file->move('uploads/paket_layanan', $fileName);

        // Simpan data
        $data = [
            'nama' => $this->request->getPost('nama_paket'),
            'foto' => 'uploads/paket_layanan/' . $fileName,
            'benefit' => $this->request->getPost('benefit'),
            'harga' => $this->request->getPost('harga'),
        ];

        $this->paketLayananModel->insert($data);
        return redirect()->to('admin/paket-layanan/index')->with('success', 'Paket Layanan berhasil ditambahkan');
    }

    public function edit_admin($id = null)
    {
        if ($id == null) {
            return redirect()->to('paket-layanan/index')->with('error', 'ID Paket Layanan tidak ditemukan');
        }

        $data['paket'] = $this->paketLayananModel->find($id);

        if (!$data['paket']) {
            return redirect()->to('admin/paket-layanan/index')->with('error', 'Paket Layanan tidak ditemukan');
        }

        return view('admin/paket-layanan/edit', $data);
    }

    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to('admin/paket-layanan/index')->with('error', 'ID Paket Layanan tidak ditemukan');
        }

        // Validasi input
        $rules = [
            'nama_paket' => 'required',
            'benefit' => 'required',
            'harga' => 'required|numeric|greater_than[0]',
        ];

        // Cek apakah ada file yang diupload
        $fileUploaded = $this->request->getFile('foto')->isValid();
        if ($fileUploaded) {
            $rules['foto'] = 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Siapkan data untuk update
        $data = [
            'nama' => $this->request->getPost('nama_paket'),
            'benefit' => $this->request->getPost('benefit'),
            'harga' => $this->request->getPost('harga'),
        ];

        // Jika ada file yang diupload
        if ($fileUploaded) {
            $file = $this->request->getFile('foto');
            $fileName = $file->getRandomName();
            $file->move('uploads/paket_layanan', $fileName);

            // Hapus file lama jika ada
            $paket = $this->paketLayananModel->find($id);
            if ($paket && file_exists($paket['foto'])) {
                unlink($paket['foto']);
            }

            $data['foto'] = 'uploads/paket_layanan/' . $fileName;
        }

        $this->paketLayananModel->update($id, $data);
        return redirect()->to('admin/paket-layanan/index')->with('success', 'Paket Layanan berhasil diperbarui');
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to('admin/paket-layanan/index')->with('error', 'ID Paket Layanan tidak ditemukan');
        }

        // Hapus file foto
        $paket = $this->paketLayananModel->find($id);
        if ($paket && file_exists($paket['foto'])) {
            unlink($paket['foto']);
        }

        $this->paketLayananModel->delete($id);
        return redirect()->to('admin/paket-layanan/index')->with('success', 'Paket Layanan berhasil dihapus');
    }
}