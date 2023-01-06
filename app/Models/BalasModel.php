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
}
