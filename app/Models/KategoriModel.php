<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori_berita';
    protected $allowedFields = ['nama_kategori'];

    public function delete_kategori($id_kategori)
    {
        $sql = "DELETE FROM kategori_berita WHERE id_kategori = '$id_kategori'";

        $this->db->query($sql);

        return;
    }
}
