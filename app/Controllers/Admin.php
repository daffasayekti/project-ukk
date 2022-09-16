<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class Admin extends BaseController
{
    protected $beritaModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard'
        ];
    }
}
