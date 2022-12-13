<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'tb_pembayaran';

    protected $allowedFields = ['transaksi_id', 'order_id', 'nama_pelanggan', 'email', 'nama_produk', 'jenis_langganan', 'total_pembayaran', 'tipe_pembayaran', 'status_pembayaran'];

    protected $createdField  = 'tanggal_pembayaran';

    public function getStatusPembayaran($order_id)
    {
        $sql = "SELECT * FROM tb_pembayaran WHERE order_id = '$order_id'";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function getDataPembayaranById($idPembayaran)
    {
        $sql = "SELECT * FROM tb_pembayaran WHERE id_pembayaran = '$idPembayaran'";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function getDataPembayaranByUsername($username)
    {
        $sql = "SELECT * FROM tb_pembayaran WHERE nama_pelanggan = '$username'";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }

    public function searchDataPembayaran($keyword)
    {
        return $this->table('tb_pembayaran')->like('nama_pelanggan', $keyword)->where('status_pembayaran', 'pending')->orWhere('status_pembayaran', 'expire');
    }

    public function delete_pembayaran($order_id)
    {
        $sql = "DELETE FROM tb_pembayaran WHERE order_id = '$order_id'";

        $this->db->query($sql);

        return;
    }

    public function delete_pembayaran_by_id($idPembayaran)
    {
        $sql = "DELETE FROM tb_pembayaran WHERE id_pembayaran = '$idPembayaran'";

        $this->db->query($sql);

        return;
    }

    public function getNotifikasiPembayaran()
    {
        $sql = "SELECT * FROM tb_pembayaran WHERE status_pembayaran = 'pending' ORDER BY id_pembayaran DESC";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }
}
