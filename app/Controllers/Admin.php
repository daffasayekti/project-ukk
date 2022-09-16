<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\LoginModel;

class Admin extends BaseController
{
    protected $beritaModel;
    protected $loginModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->loginModel = new LoginModel();
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'data_users_login' => $this->loginModel->getLoginUsers(),
        ];

        // dd($data['data_users_login']);

        return view('/admin/data_siswa', $data);
    }
}
