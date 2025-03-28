<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoPortofolioModel extends Model
{
    protected $table = 'foto_portofolio';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_portofolio', 'nama_file', 'created_at'];
    protected $useTimestamps = true;
}
