<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisLanggananModel extends Model
{
    protected $table = 'jenis_langganan';

    protected $allowedFields = ['nama_langganan', 'jenis_langganan', 'harga_langganan', 'waktu_langganan'];

    public function getDataLanggananById($id)
    {
        $sql = "SELECT * FROM jenis_langganan WHERE id_langganan = '$id'";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function getDataLanggananByName($nama_produk)
    {
        $sql = "SELECT * FROM jenis_langganan WHERE nama_langganan = '$nama_produk'";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }
}
