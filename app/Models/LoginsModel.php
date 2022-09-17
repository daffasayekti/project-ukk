<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginsModel extends Model
{
    protected $table = 'auth_logins';

    public function getLoginUsers()
    {
        $sql = "SELECT * FROM auth_logins WHERE success = 1 ORDER BY id DESC LIMIT 30";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }
}
