<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginsModel extends Model
{
    protected $table = 'auth_logins';

    public function searchDataUsers($keyword)
    {
        return $this->table('auth_logins')->like('email', $keyword);
    }
}
