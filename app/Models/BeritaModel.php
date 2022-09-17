<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'tb_berita';

    protected $allowedFields = ['judul_berita', 'slug', 'created_by', 'kategori_id', 'isi_berita', 'gambar_berita', 'banyak_dilihat', 'status_berita'];

    protected $createdField  = 'tanggal_buat';
    protected $updatedField  = 'tanggal_update';

    public function getBeritaKecelakaanBySlug($slug)
    {
        $sql = "SELECT tb_kecelakaan.id_berita, tb_kecelakaan.judul_berita, tb_kecelakaan.slug, tb_kecelakaan.created_by, tb_kecelakaan.penulis_berita, tb_kecelakaan.isi_berita, tb_kecelakaan.gambar_berita, tb_kecelakaan.created_at, tb_kecelakaan.updated_at, kategori_berita.kategori_berita FROM tb_kecelakaan INNER JOIN kategori_berita ON kategori_berita.id_kategori = tb_kecelakaan.kategori_id WHERE slug = '$slug'";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function getBeritaKecelakaanByUsername($username)
    {
        $sql = "SELECT tb_kecelakaan.id_berita, tb_kecelakaan.judul_berita, tb_kecelakaan.slug, tb_kecelakaan.created_by, tb_kecelakaan.penulis_berita, tb_kecelakaan.isi_berita, tb_kecelakaan.gambar_berita, tb_kecelakaan.created_at, tb_kecelakaan.updated_at, kategori_berita.kategori_berita FROM tb_kecelakaan INNER JOIN kategori_berita ON kategori_berita.id_kategori = tb_kecelakaan.kategori_id WHERE created_by = '$username' order by id_berita desc ";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaLaluLintasByKategori($kategoriBerita)
    {
        $sql = "SELECT tb_kecelakaan.id_berita, tb_kecelakaan.judul_berita, tb_kecelakaan.slug, tb_kecelakaan.created_by, tb_kecelakaan.penulis_berita, tb_kecelakaan.isi_berita, tb_kecelakaan.gambar_berita, tb_kecelakaan.created_at, tb_kecelakaan.updated_at, kategori_berita.kategori_berita FROM tb_kecelakaan INNER JOIN kategori_berita ON kategori_berita.id_kategori = tb_kecelakaan.kategori_id WHERE kategori_berita = '$kategoriBerita' order by id_berita desc";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaTerbaruKecelakaan()
    {
        $sql = "SELECT * FROM tb_berita WHERE kategori_id = '1'AND status_berita = '1' ORDER BY id_berita DESC LIMIT 1";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function getBeritaTerbaruEkonomi()
    {
        $sql = "SELECT * FROM tb_berita WHERE kategori_id = '2' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 1";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function getBeritaEkonomiTerbaru()
    {
        $sql = "SELECT * FROM tb_berita WHERE kategori_id = '2' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 3";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaTerbaruPolitik()
    {
        $sql = "SELECT * FROM tb_berita WHERE kategori_id = '3' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 1";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function getBeritaPolitikTerbaru()
    {
        $sql = "SELECT * FROM tb_berita WHERE kategori_id = '3' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 3";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaKecelakaanLimit2()
    {
        $sql = "SELECT * FROM tb_berita WHERE kategori_id = '1' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 2";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaEkonomiLimit5()
    {
        $sql = "SELECT * FROM tb_berita WHERE kategori_id = '2' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 5";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaPolitikLimit2()
    {
        $sql = "SELECT * FROM tb_berita WHERE kategori_id = '3' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 2";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaKecelakaanTerbaru()
    {
        $sql = "SELECT * FROM tb_berita WHERE kategori_id = '1' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 3";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaKecelakaan()
    {
        $sql = "SELECT tb_berita.*, kategori_berita.nama_kategori FROM tb_berita INNER JOIN kategori_berita ON tb_berita.kategori_id = kategori_berita.id_kategori WHERE nama_kategori = 'Kecelakaan' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 6";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaEkonomi()
    {
        $sql = "SELECT tb_berita.*, kategori_berita.nama_kategori FROM tb_berita INNER JOIN kategori_berita ON tb_berita.kategori_id = kategori_berita.id_kategori WHERE nama_kategori = 'Ekonomi' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 6";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getBeritaPolitik()
    {
        $sql = "SELECT tb_berita.*, kategori_berita.nama_kategori FROM tb_berita INNER JOIN kategori_berita ON tb_berita.kategori_id = kategori_berita.id_kategori WHERE nama_kategori = 'Politik' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 6";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getGlobalBerita()
    {
        $sql = "SELECT tb_berita.*, kategori_berita.nama_kategori FROM tb_berita INNER JOIN kategori_berita ON tb_berita.kategori_id = kategori_berita.id_kategori WHERE nama_kategori = 'Kecelakaan' AND status_berita = '1' ORDER BY id_berita DESC LIMIT 1";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function delete_berita($slug)
    {
        $sql = "DELETE FROM tb_kecelakaan WHERE slug = '$slug'";

        $this->db->query($sql);

        return;
    }

    public function countPolitik()
    {
        $query = $this->db->query("SELECT * FROM tb_berita WHERE kategori_id = 3 AND status_berita = 1");
        $countUsers = $query->getNumRows();
        return $countUsers;
    }

    public function countKecelakaan()
    {
        $query = $this->db->query("SELECT * FROM tb_berita WHERE kategori_id = 1 AND status_berita = 1");
        $countUsers = $query->getNumRows();
        return $countUsers;
    }

    public function countEkonomi()
    {
        $query = $this->db->query("SELECT * FROM tb_berita WHERE kategori_id = 2 AND status_berita = 1");
        $countUsers = $query->getNumRows();
        return $countUsers;
    }
}
