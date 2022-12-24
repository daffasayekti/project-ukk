<?php

namespace App\Models;

use CodeIgniter\Model;

class BalasModel extends Model
{
    protected $table            = 'tb_balas_komentar';
    protected $allowedFields    = ['komentar_id', 'created_by', 'isi_komentar'];
    protected $createdField  = 'tanggal_komentar';
}
