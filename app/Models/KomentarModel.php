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
        $sql = "SELECT tb_komentar.*, tb_balas_komentar.*, users.* FROM tb_komentar LEFT JOIN tb_balas_komentar ON tb_komentar.id_komentar = tb_balas_komentar.komentar_id INNER JOIN users ON tb_komentar.created_by = users.username WHERE berita_id = '$id_berita' ORDER BY id_komentar DESC";

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
