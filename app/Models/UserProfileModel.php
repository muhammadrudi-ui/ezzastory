<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfileModel extends Model
{
       protected $table = 'user_profile';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_id', 'nama_lengkap', 'no_telepon', 'instagram'];
}
