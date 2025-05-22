<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfilePerusahaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function __construct()
    {
        $this->profileModel = new ProfilePerusahaanModel();
    }
    public function index()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        return view('user/tentang-kami', $data);
    }

    public function index_visitor()
    {
        $data['profile_perusahaan'] = $this->profileModel->findAll();
        return view('visitor/tentang-kami', $data);
    }

    public function index_admin()
    {
        $search = $this->request->getGet('search');

        if ($search) {
            $this->profileModel->groupStart()
                ->like('nama_perusahaan', $search)
                ->orLike('deskripsi', $search)
                ->orLike('keunggulan_1', $search)
                ->orLike('keunggulan_2', $search)
                ->orLike('keunggulan_3', $search)
                ->orLike('visi', $search)
                ->orLike('misi', $search)
                ->orLike('nama_owner', $search)
                ->orLike('cta', $search)
                ->orLike('no_telp', $search)
                ->orLike('email', $search)
                ->orLike('instagram', $search)
                ->orLike('alamat', $search)
                ->groupEnd();
        }


        $data['profileModel'] = $this->profileModel->findAll();
        $data['search'] = $search;

        return view('admin/profile-perusahaan/index', $data);
    }

    public function add_admin()
    {
        return view('admin/profile-perusahaan/add');
    }

    public function store()
    {
        $rules = [
            'nama_perusahaan' => 'required',
            'deskripsi' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'nama_owner' => 'required',
            'no_telp' => 'required',
            'email' => 'required|valid_email',
            'alamat' => 'required',
            'logo' => 'uploaded[logo]|max_size[logo,1024]|is_image[logo]',
            'slider_1' => 'uploaded[slider_1]|max_size[slider_1,1024]|is_image[slider_1]',
            'slider_2' => 'uploaded[slider_2]|max_size[slider_2,1024]|is_image[slider_2]',
            'slider_3' => 'uploaded[slider_3]|max_size[slider_3,1024]|is_image[slider_3]',
            'background_judul' => 'uploaded[background_judul]|max_size[background_judul,1024]|is_image[background_judul]',
            'foto_owner' => 'uploaded[foto_owner]|max_size[foto_owner,1024]|is_image[foto_owner]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Upload file
        $logo = $this->request->getFile('logo');
        $logoName = $logo->getRandomName();
        $logo->move('uploads/profile_perusahaan', $logoName);

        $slider1 = $this->request->getFile('slider_1');
        $slider1Name = $slider1->getRandomName();
        $slider1->move('uploads/profile_perusahaan', $slider1Name);

        $slider2 = $this->request->getFile('slider_2');
        $slider2Name = $slider2->getRandomName();
        $slider2->move('uploads/profile_perusahaan', $slider2Name);

        $slider3 = $this->request->getFile('slider_3');
        $slider3Name = $slider3->getRandomName();
        $slider3->move('uploads/profile_perusahaan', $slider3Name);

        $background = $this->request->getFile('background_judul');
        $backgroundName = $background->getRandomName();
        $background->move('uploads/profile_perusahaan', $backgroundName);

        $fowner = $this->request->getFile('foto_owner');
        $fownerName = $fowner->getRandomName();
        $fowner->move('uploads/profile_perusahaan', $fownerName);


        // Simpan data
        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'logo' => 'uploads/profile_perusahaan/' . $logoName,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'slider_1' => 'uploads/profile_perusahaan/' . $slider1Name,
            'slider_2' => 'uploads/profile_perusahaan/' . $slider2Name,
            'slider_3' => 'uploads/profile_perusahaan/' . $slider3Name,
            'keunggulan_1' => $this->request->getPost('keunggulan_1'),
            'keunggulan_2' => $this->request->getPost('keunggulan_2'),
            'keunggulan_3' => $this->request->getPost('keunggulan_3'),
            'background_judul' => 'uploads/profile_perusahaan/' . $backgroundName,
            'visi' => $this->request->getPost('visi'),
            'misi' => $this->request->getPost('misi'),
            'nama_owner' => $this->request->getPost('nama_owner'),
            'foto_owner' => 'uploads/profile_perusahaan/' . $fownerName,
            'cta' => $this->request->getPost('cta'),
            'no_telp' => preg_replace('/[^0-9]/', '', $this->request->getPost('no_telp')),
            'email' => $this->request->getPost('email'),
            'instagram' => $this->request->getPost('instagram'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $this->profileModel->insert($data);
        return redirect()->to('admin/profile-perusahaan/index')->with('message', 'Profile perusahaan berhasil ditambahkan');
    }

    public function edit_admin($id = null)
    {
        if ($id == null) {
            return redirect()->to('admin/profile-perusahaan/index')->with('error', 'ID Profile Perusahaan tidak ditemukan');
        }

        $data['profile'] = $this->profileModel->find($id);

        if (!$data['profile']) {
            return redirect()->to('admin/profile-perusahaan/index')->with('error', 'Data Profile Perusahaan tidak ditemukan');
        }

        return view('admin/profile-perusahaan/edit', $data);
    }

    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to('admin/profile-perusahaan/index')->with('error', 'ID Profile Perusahaan tidak ditemukan');
        }

        // Validasi input
        $rules = [
            'nama_perusahaan' => 'required',
            'deskripsi' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'nama_owner' => 'required',
            'no_telp' => 'required',
            'email' => 'required|valid_email',
            'alamat' => 'required',
        ];

        // Validasi untuk hanya file
        $fileFields = ['logo', 'slider_1', 'slider_2', 'slider_3', 'background_judul', 'foto_owner'];
        foreach ($fileFields as $field) {
            $file = $this->request->getFile($field);
            if ($file && $file->isValid()) {
                $rules[$field] = 'uploaded[' . $field . ']|max_size[' . $field . ',1024]|is_image[' . $field . ']';
            }
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data untuk update
        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'keunggulan_1' => $this->request->getPost('keunggulan_1'),
            'keunggulan_2' => $this->request->getPost('keunggulan_2'),
            'keunggulan_3' => $this->request->getPost('keunggulan_3'),
            'visi' => $this->request->getPost('visi'),
            'misi' => $this->request->getPost('misi'),
            'nama_owner' => $this->request->getPost('nama_owner'),
            'cta' => $this->request->getPost('cta'),
            'no_telp' => preg_replace('/[^0-9]/', '', $this->request->getPost('no_telp')),
            'email' => $this->request->getPost('email'),
            'instagram' => $this->request->getPost('instagram'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        // Ambil data lama
        $profile = $this->profileModel->find($id);

        // Jika ada file yang diupload, simpan dan hapus file lama
        foreach ($fileFields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move('uploads/profile_perusahaan', $fileName);

                // Hapus file lama jika ada
                if ($profile && isset($profile[$field]) && file_exists($profile[$field])) {
                    unlink($profile[$field]);
                }

                $data[$field] = 'uploads/profile_perusahaan/' . $fileName;
            } else {
                if ($profile && isset($profile[$field])) {
                    $data[$field] = $profile[$field];
                }
            }
        }

        $this->profileModel->update($id, $data);
        return redirect()->to('admin/profile-perusahaan/index')->with('success', 'Data Profile Perusahaan berhasil diperbarui');
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to('admin/profile-perusahaan/index')->with('error', 'ID Profile Perusahaan tidak ditemukan');
        }

        $profile = $this->profileModel->find($id);

        if ($profile) {
            $imageFields = ['logo', 'slider_1', 'slider_2', 'slider_3', 'background_judul', 'foto_owner'];

            foreach ($imageFields as $field) {
                if (!empty($profile[$field]) && file_exists($profile[$field])) {
                    unlink($profile[$field]);
                }
            }

            $this->profileModel->delete($id);

            return redirect()->to('admin/profile-perusahaan/index')->with('success', 'Profile Perusahaan berhasil dihapus');
        }

        return redirect()->to('admin/profile-perusahaan/index')->with('error', 'Data Profile Perusahaan tidak ditemukan');
    }

}
