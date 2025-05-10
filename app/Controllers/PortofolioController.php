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

        $kategori = ['Wedding', 'Engagement', 'Pre-Wedding', 'Wisuda', 'Event Lainnya'];

        foreach ($kategori as $jenis) {
            // Ubah nama kategori menjadi key array dengan huruf kecil
            $key = strtolower(str_replace(['-', ' '], '', $jenis));


            // Ambil portofolio berdasarkan jenis layanan
            $builder = $this->portofolioModel
                ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
                ->join(
                    '(SELECT id_portofolio, nama_file FROM foto_portofolio WHERE id IN (SELECT MAX(id) FROM foto_portofolio GROUP BY id_portofolio)) AS foto_portofolio',
                    'foto_portofolio.id_portofolio = portofolio.id',
                    'left'
                )
                ->where('jenis_layanan', $jenis)
                ->orderBy('created_at', 'DESC')
                ->limit(3);

            $data[$key] = $builder->find();
        }

        return view('user/portofolio/index', $data);
    }

    public function kategori($jenis_layanan)
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        $data['portofolio'] = $this->portofolioModel
            ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
            ->join(
                '(SELECT id_portofolio, nama_file FROM foto_portofolio WHERE id IN (SELECT MAX(id) FROM foto_portofolio GROUP BY id_portofolio)) AS foto_portofolio',
                'foto_portofolio.id_portofolio = portofolio.id',
                'left'
            )
            ->where('jenis_layanan', $jenis_layanan)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data['jenis_layanan'] = $jenis_layanan;

        return view('user/portofolio/kategori', $data);
    }

    public function detail($id)
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        $data['portofolio'] = $this->portofolioModel->find($id);
        $data['fotos'] = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();
        return view('user/portofolio/detail', $data);
    }

    public function index_visitor()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        $kategori = ['Wedding', 'Engagement', 'Pre-Wedding', 'Wisuda', 'Event Lainnya'];

        foreach ($kategori as $jenis) {
            // Ubah nama kategori menjadi key array dengan huruf kecil
            $key = strtolower(str_replace(['-', ' '], '', $jenis));


            // Ambil portofolio berdasarkan jenis layanan
            $builder = $this->portofolioModel
                ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
                ->join(
                    '(SELECT id_portofolio, nama_file FROM foto_portofolio WHERE id IN (SELECT MAX(id) FROM foto_portofolio GROUP BY id_portofolio)) AS foto_portofolio',
                    'foto_portofolio.id_portofolio = portofolio.id',
                    'left'
                )
                ->where('jenis_layanan', $jenis)
                ->orderBy('created_at', 'DESC')
                ->limit(3);

            $data[$key] = $builder->find();
        }

        return view('visitor/portofolio/index', $data);
    }

    public function kategori_visitor($jenis_layanan)
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        $data['portofolio'] = $this->portofolioModel
            ->select('portofolio.*, foto_portofolio.nama_file AS foto_utama')
            ->join(
                '(SELECT id_portofolio, nama_file FROM foto_portofolio WHERE id IN (SELECT MAX(id) FROM foto_portofolio GROUP BY id_portofolio)) AS foto_portofolio',
                'foto_portofolio.id_portofolio = portofolio.id',
                'left'
            )
            ->where('jenis_layanan', $jenis_layanan)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data['jenis_layanan'] = $jenis_layanan;

        return view('visitor/portofolio/kategori', $data);
    }

    public function detail_visitor($id)
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();

        $data['portofolio'] = $this->portofolioModel->find($id);
        $data['fotos'] = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();
        return view('visitor/portofolio/detail', $data);
    }

    public function index_admin()
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

        return view('admin/portofolio/index', $data);
    }

    public function add_admin()
    {
        return view('admin/portofolio/add');
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

        // Path untuk upload foto
        $uploadPath = 'uploads/portofolio/';

        // Proses Upload Foto
        $files = $this->request->getFileMultiple('foto');
        $fotoUtamaId = null;

        if (!empty($files) && count($files) > 0) {
            foreach ($files as $index => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $filePath = $uploadPath . $newName;  // Menyimpan path lengkap

                    // Simpan file di dalam folder uploads/portofolio
                    $file->move($uploadPath, $newName);

                    // Simpan path lengkap file ke dalam database
                    $fotoId = $this->fotoPortofolioModel->insert([
                        'id_portofolio' => $portofolioId,
                        'nama_file' => $filePath  // Simpan path lengkap
                    ], true);

                    if ($index == 0) {
                        $fotoUtamaId = $fotoId;
                    }
                }
            }
        }

        if ($fotoUtamaId) {
            $this->portofolioModel->update($portofolioId, ['foto_utama' => $fotoUtamaId]);
        }

        return redirect()->to('admin/portofolio/index')->with('success', 'Portofolio berhasil ditambahkan!');
    }


    public function edit_admin($id)
    {
        $portofolio = $this->portofolioModel->find($id);

        if (!$portofolio) {
            return redirect()->to('admin/portofolio/index')->with('error', 'Data portofolio tidak ditemukan.');
        }

        // Ambil semua foto yang terkait dengan portofolio ini
        $foto_portofolio = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();

        return view('admin/portofolio/edit', [
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

        // Update informasi portofolio
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
                    $filePath = 'uploads/portofolio/' . $foto['nama_file'];
                    if (file_exists($filePath)) {
                        unlink($filePath); // Hapus file foto
                    }
                    $this->fotoPortofolioModel->delete($fotoId); // Hapus data foto dari database
                }
            }
        }

        // Proses upload gambar baru
        $files = $this->request->getFileMultiple('foto');
        if (!empty($files) && count($files) > 0) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    // Tentukan nama file baru
                    $newName = $file->getRandomName();

                    // Pindahkan file ke folder uploads/portofolio
                    $file->move('uploads/portofolio', $newName);

                    // Simpan nama file dan path ke database
                    $this->fotoPortofolioModel->insert([
                        'id_portofolio' => $id,
                        'nama_file' => 'uploads/portofolio/' . $newName
                    ]);
                }
            }
        }

        return redirect()->to('admin/portofolio/index')->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to('admin/portofolio/index')->with('error', 'ID Portofolio tidak ditemukan');
        }

        // Ambil data portofolio
        $portofolio = $this->portofolioModel->find($id);
        if (!$portofolio) {
            return redirect()->to('admin/portofolio/index')->with('error', 'Portofolio tidak ditemukan');
        }

        // Ambil semua foto yang terkait dengan portofolio
        $fotos = $this->fotoPortofolioModel->where('id_portofolio', $id)->findAll();

        // Hapus foto-foto terkait dari folder
        foreach ($fotos as $foto) {
            // Coba beberapa kemungkinan path untuk foto
            $possiblePaths = [
                FCPATH . 'uploads/portofolio/' . $foto['nama_file'],
                ROOTPATH . 'public/uploads/portofolio/' . $foto['nama_file'],
                './uploads/portofolio/' . $foto['nama_file'],
                '../uploads/portofolio/' . $foto['nama_file'],
                '/uploads/portofolio/' . $foto['nama_file'],
                $foto['nama_file'], // Jika nama file sudah berisi path lengkap
            ];

            $deleted = false;
            foreach ($possiblePaths as $path) {
                log_message('info', 'Mencoba menghapus file: ' . $path);
                if (file_exists($path)) {
                    try {
                        if (unlink($path)) {
                            log_message('info', 'Berhasil menghapus file: ' . $path);
                            $deleted = true;
                            break;
                        } else {
                            log_message('error', 'Gagal menghapus file: ' . $path . ' (unlink return false)');
                        }
                    } catch (\Exception $e) {
                        log_message('error', 'Exception saat menghapus file: ' . $path . ' - ' . $e->getMessage());
                    }
                } else {
                    log_message('info', 'File tidak ditemukan: ' . $path);
                }
            }

            if (!$deleted) {
                log_message('warning', 'Tidak dapat menghapus file untuk foto ID: ' . $foto['id'] . ' dengan nama file: ' . $foto['nama_file']);
            }
        }

        // Hapus foto utama jika ada
        if (!empty($portofolio['foto_utama'])) {
            $mainPhotoPaths = [
                FCPATH . 'uploads/portofolio/' . $portofolio['foto_utama'],
                ROOTPATH . 'public/uploads/portofolio/' . $portofolio['foto_utama'],
                './uploads/portofolio/' . $portofolio['foto_utama'],
                '../uploads/portofolio/' . $portofolio['foto_utama'],
                '/uploads/portofolio/' . $portofolio['foto_utama'],
                $portofolio['foto_utama'], // Jika nama file sudah berisi path lengkap
            ];

            $mainPhotoDeleted = false;
            foreach ($mainPhotoPaths as $path) {
                log_message('info', 'Mencoba menghapus foto utama: ' . $path);
                if (file_exists($path)) {
                    try {
                        if (unlink($path)) {
                            log_message('info', 'Berhasil menghapus foto utama: ' . $path);
                            $mainPhotoDeleted = true;
                            break;
                        } else {
                            log_message('error', 'Gagal menghapus foto utama: ' . $path . ' (unlink return false)');
                        }
                    } catch (\Exception $e) {
                        log_message('error', 'Exception saat menghapus foto utama: ' . $path . ' - ' . $e->getMessage());
                    }
                } else {
                    log_message('info', 'Foto utama tidak ditemukan: ' . $path);
                }
            }

            if (!$mainPhotoDeleted) {
                log_message('warning', 'Tidak dapat menghapus foto utama: ' . $portofolio['foto_utama']);
            }
        }

        // Hapus data dari database
        try {
            $this->fotoPortofolioModel->where('id_portofolio', $id)->delete();
            log_message('info', 'Berhasil menghapus data foto dari database untuk portofolio ID: ' . $id);

            $this->portofolioModel->delete($id);
            log_message('info', 'Berhasil menghapus data portofolio dari database dengan ID: ' . $id);

            return redirect()->to('admin/portofolio/index')->with('success', 'Portofolio berhasil dihapus beserta semua fotonya');
        } catch (\Exception $e) {
            log_message('error', 'Error saat menghapus dari database: ' . $e->getMessage());
            return redirect()->to('admin/portofolio/index')->with('error', 'Terjadi kesalahan saat menghapus portofolio');
        }
    }
}
