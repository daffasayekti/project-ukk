<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'users';
    protected $fillable = ['email', 'username', 'fullname', 'profile_img', 'jenis_akun_id'];

    public function searchDataUsersFree($keyword)
    {
        return $this->table('users')->like('username', $keyword)->where('jenis_akun_id', 1);
    }

    public function searchDataUsersPremium($keyword)
    {
        return $this->table('users')->like('username', $keyword)->where('jenis_akun_id', 2);
    }

    public function getDataAdmin()
    {
        $sql = "SELECT users.*, auth_groups_users.* FROM users INNER JOIN auth_groups_users ON users.id = auth_groups_users.user_id";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function delete_akun($id)
    {
        $sql = "DELETE FROM users WHERE id = '$id'";

        $this->db->query($sql);

        return;
    }
}
