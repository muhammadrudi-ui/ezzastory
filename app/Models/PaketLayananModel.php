<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketLayananModel extends Model
{
    protected $table = 'paket_layanan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'foto', 'benefit', 'harga', 'jenis_layanan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
