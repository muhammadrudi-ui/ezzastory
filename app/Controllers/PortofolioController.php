<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfilePerusahaanModel;
use App\Models\PortofolioModel;
use App\Models\FotoPortofolioModel;
use CodeIgniter\HTTP\ResponseInterface;

class PortofolioController extends BaseController
{
    protected $portofolioModel;
    protected $fotoPortofolioModel;
    protected $profileModel;

    public function __construct()
    {
        $this->portofolioModel = new PortofolioModel();
        $this->fotoPortofolioModel = new FotoPortofolioModel();
        $this->profileModel = new ProfilePerusahaanModel();
    }

    // Portofolio untuk User
    public function index()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        $kategori = ['Wedding', 'Engagement', 'Pre-Wedding', 'Wisuda', 'Event Lainnya'];

        foreach ($kategori as $jenis) {
            $key = strtolower(str_replace(['-', ' '], '', $jenis));

            $data[$key] = $this->portofolioModel
                ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
                ->join('foto_portofolio', 'foto_portofolio.id_portofolio = portofolio.id', 'left')
                ->where('jenis_layanan', $jenis)
                ->where('foto_portofolio.id', function ($builder) {
                    return $builder->selectMax('id')
                                  ->from('foto_portofolio')
                                  ->where('foto_portofolio.id_portofolio = portofolio.id');
                })
                ->orderBy('portofolio.created_at', 'DESC')
                ->limit(3)
                ->find();
        }

        return view('user/portofolio/index', $data);
    }

    // Halaman Kategori Portofolio User
    public function kategori($jenis_layanan)
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        $data['portofolio'] = $this->portofolioModel
            ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
            ->join('foto_portofolio', 'foto_portofolio.id_portofolio = portofolio.id', 'left')
            ->where('jenis_layanan', $jenis_layanan)
            ->where('foto_portofolio.id', function ($builder) {
                return $builder->selectMax('id')
                              ->from('foto_portofolio')
                              ->where('foto_portofolio.id_portofolio = portofolio.id');
            })
            ->orderBy('portofolio.created_at', 'DESC')
            ->findAll();

        $data['jenis_layanan'] = $jenis_layanan;

        return view('user/portofolio/kategori', $data);
    }

    // Portofolio Detail User
    public function detail($id)
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        $data['portofolio'] = $this->portofolioModel->find($id);
        $data['fotos'] = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();

        return view('user/portofolio/detail', $data);
    }

    // Portofolio untuk Visitor
    public function index_visitor()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        $kategori = ['Wedding', 'Engagement', 'Pre-Wedding', 'Wisuda', 'Event Lainnya'];

        foreach ($kategori as $jenis) {
            $key = strtolower(str_replace(['-', ' '], '', $jenis));

            $data[$key] = $this->portofolioModel
                ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
                ->join('foto_portofolio', 'foto_portofolio.id_portofolio = portofolio.id', 'left')
                ->where('jenis_layanan', $jenis)
                ->where('foto_portofolio.id', function ($builder) {
                    return $builder->selectMax('id')
                                  ->from('foto_portofolio')
                                  ->where('foto_portofolio.id_portofolio = portofolio.id');
                })
                ->orderBy('portofolio.created_at', 'DESC')
                ->limit(3)
                ->find();
        }

        return view('visitor/portofolio/index', $data);
    }


    // Kategori Portofolio untuk Visitor
    public function kategori_visitor($jenis_layanan)
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        $data['portofolio'] = $this->portofolioModel
            ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
            ->join('foto_portofolio', 'foto_portofolio.id_portofolio = portofolio.id', 'left')
            ->where('jenis_layanan', $jenis_layanan)
            ->where('foto_portofolio.id', function ($builder) {
                return $builder->selectMax('id')
                              ->from('foto_portofolio')
                              ->where('foto_portofolio.id_portofolio = portofolio.id');
            })
            ->orderBy('portofolio.created_at', 'DESC')
            ->findAll();

        $data['jenis_layanan'] = $jenis_layanan;

        return view('visitor/portofolio/kategori', $data);

    }


    // Detail Portodolio untuk Visitor
    public function detail_visitor($id)
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        $data['portofolio'] = $this->portofolioModel->find($id);
        $data['fotos'] = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();

        return view('visitor/portofolio/detail', $data);
    }


    // Index Portodolio untuk Admin
    public function index_admin()
    {
        $perPage = 5;
        $search = $this->request->getGet('search');

        $builder = $this->portofolioModel
            ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
            ->join('foto_portofolio', 'foto_portofolio.id_portofolio = portofolio.id', 'left')
            ->where('foto_portofolio.id', function ($builder) {
                return $builder->selectMax('id')
                              ->from('foto_portofolio')
                              ->where('foto_portofolio.id_portofolio = portofolio.id');
            });

        if ($search) {
            $builder->groupStart()
                ->like('portofolio.nama_mempelai', $search)
                ->orLike('portofolio.jenis_layanan', $search)
                ->groupEnd();
        }

        $data['portofolio'] = $builder->paginate($perPage);
        $data['pager'] = $this->portofolioModel->pager;
        $data['search'] = $search;

        return view('admin/portofolio/index', $data);
    }


    // Add Form Portofolio untuk Admin
    public function add_admin()
    {
        return view('admin/portofolio/add');
    }


    // Add Data Portofolio untuk Admin
    public function store()
    {
        $rules = [
            'nama_mempelai' => 'required',
            'jenis_layanan' => 'required',
            'foto' => 'uploaded[foto]|max_size[foto,1048]|is_image[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data portofolio
        $portofolioData = [
            'nama_mempelai' => $this->request->getPost('nama_mempelai'),
            'jenis_layanan' => $this->request->getPost('jenis_layanan'),
        ];

        $portofolioId = $this->portofolioModel->insert($portofolioData, true);

        // Proses upload foto
        $files = $this->request->getFileMultiple('foto');
        $uploadPath = WRITEPATH . '../public/uploads/portofolio/';

        // Buat direktori jika belum ada
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        foreach ($files as $index => $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                $fotoData = [
                    'id_portofolio' => $portofolioId,
                    'nama_file' => 'uploads/portofolio/' . $newName
                ];

                $fotoId = $this->fotoPortofolioModel->insert($fotoData);

                // Set foto pertama sebagai foto utama
                if ($index === 0) {
                    $this->portofolioModel->update($portofolioId, ['foto_utama' => $fotoId]);
                }
            }
        }

        return redirect()->to('admin/portofolio/index')->with('success', 'Portofolio berhasil ditambahkan!');
    }


    // Edit Data View Portofolio untuk Admin
    public function edit_admin($id)
    {
        $portofolio = $this->portofolioModel->find($id);

        if (!$portofolio) {
            return redirect()->to('admin/portofolio/index')->with('error', 'Data portofolio tidak ditemukan.');
        }

        $foto_portofolio = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();

        return view('admin/portofolio/edit', [
            'portofolio' => $portofolio,
            'foto_portofolio' => $foto_portofolio
        ]);
    }


    // Edit Data Portofolio untuk Admin
    public function update($id)
    {
        $rules = [
            'nama_mempelai' => 'required',
            'jenis_layanan' => 'required',
            'foto.*' => 'max_size[foto,1048]|is_image[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Foto yang ada sebelumnya di DB
        $existingPhotos = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();

        // Foto yang akan dihapus
        $deletedFotos = $this->request->getPost('deleted_foto') ? explode(",", $this->request->getPost('deleted_foto')) : [];

        // Hitung jumlah foto baru yang valid
        $newPhotos = 0;
        $files = $this->request->getFileMultiple('foto');
        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newPhotos++;
            }
        }

        // Validasi minimal 1 foto tersisa
        $remainingPhotos = count($existingPhotos) - count($deletedFotos);
        if (($remainingPhotos + $newPhotos) < 1) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Portofolio harus memiliki minimal 1 foto. Tidak boleh menghapus semua foto tanpa menambahkan yang baru.');
        }

        // Update portofolio
        $this->portofolioModel->update($id, [
            'nama_mempelai' => $this->request->getPost('nama_mempelai'),
            'jenis_layanan' => $this->request->getPost('jenis_layanan'),
        ]);

        // Hapus foto
        foreach ($deletedFotos as $fotoId) {
            $foto = $this->fotoPortofolioModel->find($fotoId);
            if ($foto) {
                $filePath = FCPATH . $foto['nama_file'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $this->fotoPortofolioModel->delete($fotoId);
            }
        }

        // Upload foto baru
        $uploadPath = FCPATH . 'uploads/portofolio/';
        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                $this->fotoPortofolioModel->insert([
                    'id_portofolio' => $id,
                    'nama_file' => 'uploads/portofolio/' . $newName
                ]);
            }
        }

        return redirect()->to('admin/portofolio/index')->with('success', 'Portofolio berhasil diperbarui!');
    }

    // Delete Data Portofolio untuk Admin
    public function delete($id = null)
    {
        if (!$id) {
            return redirect()->to('admin/portofolio/index')->with('error', 'ID Portofolio tidak ditemukan');
        }

        $portofolio = $this->portofolioModel->find($id);
        if (!$portofolio) {
            return redirect()->to('admin/portofolio/index')->with('error', 'Portofolio tidak ditemukan');
        }

        // Hapus semua foto terkait
        $fotos = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();

        foreach ($fotos as $foto) {
            $filePath = FCPATH . $foto['nama_file'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus data dari database
        $this->fotoPortofolioModel->where('id_portofolio', $id)->delete();
        $this->portofolioModel->delete($id);

        return redirect()->to('admin/portofolio/index')->with('success', 'Portofolio berhasil dihapus beserta semua fotonya');
    }
}
