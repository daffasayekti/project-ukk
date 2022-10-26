<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table = 'tb_komentar';

    protected $allowedFields = ['berita_id', 'created_by', 'isi_komentar'];

    protected $createdField  = 'tanggal_komentar';
}
