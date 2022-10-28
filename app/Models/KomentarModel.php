<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table = 'tb_komentar';

    protected $allowedFields = ['berita_id', 'created_by', 'isi_komentar'];

    protected $createdField  = 'tanggal_komentar';

    public function getKomentarByBeritaId($id_berita)
    {
        $sql = "SELECT tb_komentar.*, users.* FROM tb_komentar INNER JOIN users ON tb_komentar.created_by = users.username WHERE berita_id = '$id_berita'";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function delete_komentar($id_komentar)
    {
        $sql = "DELETE FROM tb_komentar WHERE id_komentar = '$id_komentar'";

        $this->db->query($sql);

        return;
    }
}
