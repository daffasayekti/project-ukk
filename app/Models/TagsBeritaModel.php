<?php

namespace App\Models;

use CodeIgniter\Model;

class TagsBeritaModel extends Model
{
    protected $table = 'tags_berita';
    protected $allowedFields = ['berita_id', 'tags_id'];

    public function getTagsByTagId($id_tags)
    {
        $sql = "SELECT * FROM tags_berita WHERE tags_id = '$id_tags'";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getTagsById($berita_id)
    {
        $sql = "SELECT * FROM tags_berita WHERE berita_id = '$berita_id'";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function hapus_tags($id_tags)
    {
        $sql = "DELETE FROM tags_berita WHERE id_tags_berita = '$id_tags'";

        $this->db->query($sql);

        return;
    }

    public function delete_tags($id_berita)
    {
        $sql = "DELETE FROM tags_berita WHERE berita_id = '$id_berita'";

        $this->db->query($sql);

        return;
    }
}
