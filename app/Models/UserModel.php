<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'email', 'password', 'role'];
    protected $useTimestamps = true;

    public function getUserWithProfile($userId)
    {
        return $this->select('users.*, user_profile.nama_lengkap, user_profile.no_telepon, user_profile.instagram')
            ->join('user_profile', 'user_profile.user_id = users.id', 'left')
            ->where('users.id', $userId)
            ->first();
    }
}
