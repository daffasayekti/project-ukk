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

    public function getDataPembayaranByUsername($username)
    {
        $sql = "SELECT * FROM tb_pembayaran WHERE nama_pelanggan = '$username'";

        $execute = $this->db->query($sql);

        return $execute->getRowArray();
    }
}
