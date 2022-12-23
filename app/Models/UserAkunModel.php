<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAkunModel extends Model
{
    protected $table            = 'users';
    protected $allowedFields    = ['email', 'username', 'fullname', 'profile_img', 'jenis_akun_id', 'password_hash', 'active'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getUsersByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }
}
