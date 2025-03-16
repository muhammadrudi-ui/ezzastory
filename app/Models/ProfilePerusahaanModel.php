<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilePerusahaanModel extends Model
{
    protected $table = 'profile_perusahaan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'nama_perusahaan',
        'logo',
        'deskripsi',
        'slider_1',
        'slider_2',
        'slider_3',
        'keunggulan_1',
        'keunggulan_2',
        'keunggulan_3',
        'background_judul',
        'visi',
        'misi',
        'nama_owner',
        'foto_owner',
        'cta',
        'no_telp',
        'email',
        'instagram',
        'alamat'
    ];
    protected $useTimestamps = true;
}
