<?php

namespace App\Models;

use CodeIgniter\Model;

class TaglineModel extends Model
{
    protected $table = 'tags';

    protected $allowedFields = ['nama_tags', 'kategori_id', 'banyak_digunakan'];

    public function searchDataTagline($keyword)
    {
        return $this->table('tags')->like('nama_tags', $keyword);
    }

    public function getTaglineById($id_tags)
    {
        $sql = "SELECT * FROM tags WHERE id_tags = '$id_tags'";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function getTaglineByIdBerita($id_berita, $kategori_id)
    {
        $sql = "SELECT tags.*, tags_berita.* FROM tags INNER JOIN tags_berita ON tags.id_tags = tags_berita.tags_id WHERE kategori_id = '$kategori_id' AND berita_id = '$id_berita'";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getTaglineByName($tags)
    {
        $sql = "SELECT * FROM tags WHERE nama_tags = '$tags'";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getTaglineByKategoriId($kategori_id)
    {
        $sql = "SELECT * FROM tags WHERE kategori_id = '$kategori_id'";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function delete_tagline($id_tags)
    {
        $sql = "DELETE FROM tags WHERE id_tags = '$id_tags'";

        $this->db->query($sql);

        return;
    }
}
