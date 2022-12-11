<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['email', 'username', 'fullname', 'profile_img', 'jenis_akun_id', 'tanggal_expired'];

    public function searchDataUsersFree($keyword)
    {
        return $this->table('users')->like('username', $keyword)->where('jenis_akun_id', 1);
    }

    public function searchDataUsersPremium($keyword)
    {
        return $this->table('users')->like('username', $keyword)->where('jenis_akun_id', 2);
    }

    public function searchDataAdmin($keyword)
    {
        return $this->table('users')->like('username', $keyword)->where('jenis_akun_id', 3);
    }

    public function getDataAdmin()
    {
        $sql = "SELECT users.*, auth_groups_users.* FROM users INNER JOIN auth_groups_users ON users.id = auth_groups_users.user_id WHERE group_id = '1'";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getCountDataAdmin()
    {
        $sql = $this->db->query("SELECT * FROM auth_groups_users WHERE group_id = '1'");
        $countAdmin = $sql->getNumRows();
        return $countAdmin;
    }

    public function getCountUsersFree()
    {
        $sql = $this->db->query("SELECT * FROM users WHERE jenis_akun_id = 1");
        $countUsersFree = $sql->getNumRows();
        return $countUsersFree;
    }

    public function getCountUsersPremium()
    {
        $sql = $this->db->query("SELECT * FROM users WHERE jenis_akun_id = 2");
        $countUsersPremium = $sql->getNumRows();
        return $countUsersPremium;
    }

    public function delete_akun($id)
    {
        $sql = "DELETE FROM users WHERE id = '$id'";

        $this->db->query($sql);

        return;
    }
}
