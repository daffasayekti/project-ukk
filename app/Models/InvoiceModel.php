<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table            = 'tb_invoice';

    protected $allowedFields = ['transaksi_id', 'order_id', 'nama_pelanggan', 'email', 'nama_produk', 'jenis_langganan', 'total_pembayaran', 'tipe_pembayaran', 'status_pembayaran', 'id_pembayaran', 'tanggal_pembayaran'];

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

    public function getDataInvoiceExport($tanggal)
    {
        $sql = "SELECT * FROM tb_invoice WHERE tanggal_pembayaran = '$tanggal' ORDER BY id_invoice DESC";

        $execute = $this->db->query($sql);

        return $execute->getResultArray();
    }

    public function getRiwayatTransaksi()
    {
        $sql = $this->db->query("SELECT * FROM tb_invoice");
        $riwayat_transaksi = $sql->getNumRows();
        return $riwayat_transaksi;
    }

    public function getInvoiceByOrderId($order_id)
    {
        $sql = "SELECT * FROM tb_invoice WHERE order_id = '$order_id'";
        $execute = $this->db->query($sql);
        return $execute->getRowArray();
    }

    public function getTotalPendapatan()
    {
        $total_pendapatan = "SELECT SUM(total_pembayaran) AS total_pendapatan FROM tb_invoice";
        $execute = $this->db->query($total_pendapatan);
        return $execute->getRowArray();
    }
}
