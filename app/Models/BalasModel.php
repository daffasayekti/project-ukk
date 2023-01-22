<?php

namespace App\Models;

use CodeIgniter\Model;

class BalasModel extends Model
{
    protected $table            = 'tb_balas_komentar';
    protected $allowedFields    = ['komentar_id', 'penulis_komentar', 'isi_balas_komentar', 'profile_penulis'];
    protected $createdField  = 'tanggal_balas_komentar';

    public function getBalasKomentarById($komentar_id)
    {
        $sql = "SELECT * FROM tb_balas_komentar WHERE komentar_id = '$komentar_id' ORDER BY id DESC";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBalasKomentarByKomentarId($id_komentar)
    {
        $sql = "SELECT * FROM tb_balas_komentar WHERE komentar_id = '$id_komentar' ORDER BY id DESC";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function delete_balas_komentar($id_komentar)
    {
        $sql = "DELETE FROM tb_balas_komentar WHERE komentar_id = '$id_komentar'";

        $this->db->query($sql);

        return;
    }
}
