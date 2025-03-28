<?php

namespace App\Models;

use CodeIgniter\Model;

class PortofolioModel extends Model
{
    protected $table = 'portofolio';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_mempelai', 'foto_utama', 'jenis_layanan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
