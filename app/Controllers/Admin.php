<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\LoginsModel;
use App\Models\UsersModel;


class Admin extends BaseController
{
    protected $beritaModel;
    protected $loginsModel;
    protected $usersModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->loginsModel = new LoginsModel();
        $this->usersModel = new UsersModel();
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'data_users_login' => $this->loginsModel->getLoginUsers(),
            'count_users' => $this->usersModel->countUsers(),
            'count_politik' => $this->beritaModel->countPolitik(),
            'count_kecelakaan' => $this->beritaModel->countKecelakaan(),
            'count_ekonomi' => $this->beritaModel->countEkonomi()
        ];

        return view('/admin/dashboard_admin', $data);
    }
}
