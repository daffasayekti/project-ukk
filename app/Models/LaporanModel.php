<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'tb_laporan_masyarakat';
    protected $allowedFields = ['nama_pengirim', 'isi_pesan', 'status_laporan', 'no_whatsapp'];
    protected $createdField  = 'tanggal_laporan';

    public function getNotifikasiLaporan()
    {
        $sql = "SELECT * FROM tb_laporan_masyarakat WHERE status_laporan = '0' ORDER BY id_laporan DESC";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getDataLaporan()
    {
        $sql = "SELECT * FROM tb_laporan_masyarakat WHERE status_laporan = '1' ORDER BY id_laporan DESC LIMIT 1";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function searchDataLaporan($keyword)
    {
        return $this->table('tb_laporan_masyarakat')->like('isi_pesan', $keyword);
    }

    public function delete_laporan($id_laporan)
    {
        $sql = "DELETE FROM tb_laporan_masyarakat WHERE id_laporan = '$id_laporan'";

        $this->db->query($sql);

        return;
    }
}
