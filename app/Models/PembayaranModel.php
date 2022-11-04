<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'tb_pembayaran';

    protected $allowedFields = ['transaksi_id', 'order_id', 'total_pembayaran', 'tipe_pembayaran', 'status_pembayaran'];

    protected $createdField  = 'tanggal_pembayaran';
}
