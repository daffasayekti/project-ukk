<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'tb_laporan_masyarakat';
    protected $allowedFields = ['nama_pengirim', 'isi_pesan', 'no_whatsapp'];
    protected $createdField  = 'tanggal_laporan';
}
