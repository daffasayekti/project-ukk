<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table            = 'tb_invoice';

    protected $allowedFields = ['transaksi_id', 'order_id', 'nama_pelanggan', 'email', 'nama_produk', 'jenis_langganan', 'total_pembayaran', 'tipe_pembayaran', 'status_pembayaran', 'id_pembayaran'];

    protected $createdField  = 'tanggal_pembayaran';

    public function getInvoiceByPembayaranId($idPembayaran)
    {
        $sql = "SELECT * FROM tb_invoice WHERE id_pembayaran = '$idPembayaran'";
        $execute = $this->db->query($sql);
        return $execute->getRowArray();
    }

    public function searchDataInvoice($keyword)
    {
        return $this->table('tb_invoice')->like('nama_pelanggan', $keyword);
    }
}
