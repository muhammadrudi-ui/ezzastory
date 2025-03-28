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

    public function __construct()
    {
        $this->portofolioModel = new PortofolioModel();
        $this->fotoPortofolioModel = new FotoPortofolioModel();
        $this->profileModel = new ProfilePerusahaanModel();
    }

    public function index()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        $data['wedding'] = $this->portofolioModel->where('jenis_layanan', 'Wedding')->limit(3)->find();
        $data['engagement'] = $this->portofolioModel->where('jenis_layanan', 'Engagement')->limit(3)->find();
        $data['prewedding'] = $this->portofolioModel->where('jenis_layanan', 'Pre-Wedding')->limit(3)->find();
        $data['wisuda'] = $this->portofolioModel->where('jenis_layanan', 'Wisuda')->limit(3)->find();
        $data['event'] = $this->portofolioModel->where('jenis_layanan', 'Event Lainnya')->limit(3)->find();

        return view('portofolio', $data);
    }

    public function kategori($jenis_layanan)
    {
        $data['portofolio'] = $this->portofolioModel->where('jenis_layanan', $jenis_layanan)->findAll();
        return view('portofolio-kategori', $data);
    }

    public function detail($id)
    {
        $data['portofolio'] = $this->portofolioModel->find($id);
        $data['fotos'] = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();
        return view('portofolio-detail', $data);
    }

    public function view_admin()
    {
        $perPage = 5;
        $search = $this->request->getGet('search');

        $this->portofolioModel
            ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
            ->join('(SELECT id_portofolio, nama_file FROM foto_portofolio WHERE id IN (SELECT MAX(id) FROM foto_portofolio GROUP BY id_portofolio)) AS foto_portofolio', 'foto_portofolio.id_portofolio = portofolio.id', 'left');

        if ($search) {
            $this->portofolioModel
                ->groupStart()
                ->like('portofolio.nama_mempelai', $search)
                ->orLike('portofolio.jenis_layanan', $search)
                ->groupEnd();
        }

        $data['portofolio'] = $this->portofolioModel->paginate($perPage);
        $data['pager'] = $this->portofolioModel->pager;
        $data['search'] = $search;

        return view('admin/portofolio-view', $data);
    }

    public function add_admin()
    {
        return view('admin/portofolio-add');
    }

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

        // Simpan ke tabel portofolio
        $portofolioData = [
            'nama_mempelai' => $this->request->getPost('nama_mempelai'),
            'jenis_layanan' => $this->request->getPost('jenis_layanan'),
        ];

        $portofolioId = $this->portofolioModel->insert($portofolioData, true);

        // Proses Upload Foto
        $files = $this->request->getFileMultiple('foto');
        $fotoUtamaId = null;

        if (!empty($files) && count($files) > 0) {
            foreach ($files as $index => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/portofolio', $newName);

                    // Simpan foto ke tabel foto_portofolio
                    $fotoId = $this->fotoPortofolioModel->insert([
                        'id_portofolio' => $portofolioId,
                        'nama_file' => $newName
                    ], true);

                    // Set foto pertama sebagai foto utama
                    if ($index == 0) {
                        $fotoUtamaId = $fotoId;
                    }
                }
            }
        }

        // Simpan foto utama di tabel portofolio
        if ($fotoUtamaId) {
            $this->portofolioModel->update($portofolioId, ['foto_utama' => $fotoUtamaId]);
        }

        return redirect()->to('/portofolio-view')->with('message', 'Portofolio berhasil ditambahkan!');
    }

    public function edit_admin($id)
    {
        // Ambil data portofolio berdasarkan ID
        $portofolio = $this->portofolioModel->find($id);

        if (!$portofolio) {
            return redirect()->to('/portofolio-view')->with('error', 'Data portofolio tidak ditemukan.');
        }

        // Ambil semua foto yang terkait dengan portofolio ini
        $foto_portofolio = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();

        // Kirim data ke view
        return view('admin/portofolio-edit', [
            'portofolio' => $portofolio,
            'foto_portofolio' => $foto_portofolio // <-- Kirim foto ke view
        ]);
    }

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

        // Update data portofolio
        $this->portofolioModel->update($id, [
            'nama_mempelai' => $this->request->getPost('nama_mempelai'),
            'jenis_layanan' => $this->request->getPost('jenis_layanan'),
        ]);

        // Hapus foto yang dipilih untuk dihapus
        $deletedFotos = explode(",", $this->request->getPost('deleted_foto'));
        if (!empty($deletedFotos)) {
            foreach ($deletedFotos as $fotoId) {
                $foto = $this->fotoPortofolioModel->find($fotoId);
                if ($foto) {
                    if (file_exists('uploads/portofolio/' . $foto['nama_file'])) {
                        unlink('uploads/portofolio/' . $foto['nama_file']); // Hapus file dari server
                    }
                    $this->fotoPortofolioModel->delete($fotoId); // Hapus dari database
                }
            }
        }

        // Proses upload gambar baru
        $files = $this->request->getFileMultiple('foto');
        if (!empty($files) && count($files) > 0) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/portofolio', $newName);

                    $this->fotoPortofolioModel->insert([
                        'id_portofolio' => $id,
                        'nama_file' => $newName
                    ]);
                }
            }
        }

        return redirect()->to('/portofolio-view')->with('message', 'Portofolio berhasil diperbarui!');
    }


    public function delete($id)
    {
        // Cek apakah data ada di database
        $portofolio = $this->portofolioModel->find($id);

        if (!$portofolio) {
            return redirect()->to(base_url('portofolio-view'))->with('error', 'Data tidak ditemukan');
        }

        // Hapus data dari tabel foto_portofolio terlebih dahulu
        $this->fotoPortofolioModel->where('id_portofolio', $id)->delete();

        // Hapus data dari tabel portofolio
        $this->portofolioModel->delete($id);

        return redirect()->to(base_url('portofolio-view'))->with('success', 'Data berhasil dihapus');
    }


}
