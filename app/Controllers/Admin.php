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
        $keyword1 = $this->request->getVar('keyword1');

        if ($keyword) {
            $this->loginsModel->searchDataUsers($keyword);
        } else {
            $data_users_login = $this->loginsModel;
        }

        if ($keyword1) {
            $this->beritaModel->searchDataBerita($keyword1);
        } else {
            $data_berita_moderasi = $this->beritaModel;
        }

        $data = [
            'title' => 'Dashboard',
            'data_users_login' => $this->loginsModel->where('success', 1)->orderBy('id', 'DESC')->paginate(10, 'auth_logins'),
            'pager' => $this->loginsModel->pager,
            'pager1' => $this->beritaModel->pager,
            'currentPage' => $this->request->getVar('page_auth_logins') ? $this->request->getVar('page_auth_logins') : 1,
            'currentPage1' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'count_users' => $this->usersModel->countUsers(),
            'keyword' => $keyword,
            'keyword1' => $keyword1,
            'count_politik' => $this->beritaModel->countPolitik(),
            'count_kecelakaan' => $this->beritaModel->countKecelakaan(),
            'count_ekonomi' => $this->beritaModel->countEkonomi(),
            'data_berita_moderasi' => $this->beritaModel->where('status_berita', 0)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita')
        ];

        return view('/admin/dashboard_admin', $data);
    }

    public function proses_moderasi($id_berita)
    {
        $builder = $this->beritaModel->table('tb_berita');

        $data = [
            'status_berita' => 1,
        ];

        $where = ['id_berita' => $id_berita];

        $builder->set($data)
            ->where($where)
            ->update();

        session()->setFlashdata('success', 'Sukses!, Data Berita Berhasil Disetujui');
        return redirect()->to('/admin/dashboard');
    }

    public function detail_berita_moderasi($slug)
    {
        $data = [
            'title' => 'Detail Berita',
            'detail_berita' => $this->beritaModel->getBeritaBySlug($slug),
        ];

        return view('/admin/detail_berita_moderasi', $data);
    }

    public function data_kecelakaan()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->beritaModel->searchDataBeritaKecelakaan($keyword);
        } else {
            $data_berita_kecelakaan = $this->beritaModel;
        }

        $data = [
            'title' => 'Data Berita Kecelakaan',
            'data_berita' => $this->beritaModel->where('kategori_id', 1)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
        ];

        return view('/admin/data_kecelakaan', $data);
    }

    public function data_politik()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->beritaModel->searchDataBeritaPolitik($keyword);
        } else {
            $data_berita_Politik = $this->beritaModel;
        }

        $data = [
            'title' => 'Data Berita Politik',
            'data_berita' => $this->beritaModel->where('kategori_id', 3)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
        ];

        return view('/admin/data_politik', $data);
    }

    public function data_ekonomi()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->beritaModel->searchDataBeritaEkonomi($keyword);
        } else {
            $data_berita_ekonomi = $this->beritaModel;
        }

        $data = [
            'title' => 'Data Berita Ekonomi',
            'data_berita' => $this->beritaModel->where('kategori_id', 2)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
        ];

        return view('/admin/data_ekonomi', $data);
    }

    public function data_olahraga()
    {
    }
}
