<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'auth_logins';

    public function countUsers()
    {
        $query = $this->db->query("SELECT * FROM users");
        $countUsers = $query->getNumRows();
        return $countUsers;
    }
}
