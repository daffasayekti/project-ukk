<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisLanggananModel extends Model
{
    protected $table = 'jenis_langganan';

    protected $allowedFields = ['jenis_langganan', 'harga_langganan'];
}
