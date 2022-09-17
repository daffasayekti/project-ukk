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
        helper(['tanggal_helper']);

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->loginsModel->searchDataUsers($keyword);
        } else {
            $data_users_login = $this->loginsModel;
        }

        $data = [
            'title' => 'Dashboard',
            'data_users_login' => $this->loginsModel->where('success', 1)->orderBy('id', 'DESC')->paginate(10, 'auth_logins'),
            'pager' => $this->loginsModel->pager,
            'currentPage' => $this->request->getVar('page_auth_logins') ? $this->request->getVar('page_auth_logins') : 1,
            'count_users' => $this->usersModel->countUsers(),
            'keyword' => $keyword,
            'count_politik' => $this->beritaModel->countPolitik(),
            'count_kecelakaan' => $this->beritaModel->countKecelakaan(),
            'count_ekonomi' => $this->beritaModel->countEkonomi()
        ];

        return view('/admin/dashboard_admin', $data);
    }
}
