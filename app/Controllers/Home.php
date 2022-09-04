<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class Home extends BaseController
{
    protected $beritaModel;
    protected $helpers = ['tanggal_helper'];

    public function __construct()
    {
        $this->beritaModel    = new BeritaModel();
    }

    public function index()
    {
        // dd(session());
        helper(['tanggal_helper']);

        $data = [
            'title' => 'World Time',
            'global_berita' => $this->beritaModel->getGlobalBerita(),
            'berita_terbaru_kecelakaan' => $this->beritaModel->getBeritaTerbaruKecelakaan(),
            'berita_terbaru_ekonomi' => $this->beritaModel->getBeritaTerbaruEkonomi(),
            'berita_terbaru_politik' => $this->beritaModel->getBeritaTerbaruPolitik(),
            'berita_politik_terbaru' => $this->beritaModel->getBeritaPolitikTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_ekonomi' => $this->beritaModel->getBeritaEkonomiLimit5(),
            'berita_politik' => $this->beritaModel->getBeritaPolitikLimit2(),
            'berita_kecelakaan' => $this->beritaModel->getBeritaKecelakaanLimit2(),
        ];

        return view('/pages/index', $data);
    }

    public function tentang_kami()
    {
        $data = [
            'title' => 'Tentang Kami',
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/tentang_kami', $data);
    }

    public function ekonomi()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Berita Ekonomi',
            'berita_ekonomi' => $this->beritaModel->getBeritaEkonomi(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/ekonomi', $data);
    }

    public function politik()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Berita Politik',
            'berita_politik' => $this->beritaModel->getBeritaPolitik(),
            'berita_politik_terbaru' => $this->beritaModel->getBeritaPolitikTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/politik', $data);
    }

    public function kecelakaan()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Berita Kecelakaan',
            'berita_kecelakaan' => $this->beritaModel->getBeritaKecelakaan(),
            'berita_kecelakaan_terbaru' => $this->beritaModel->getBeritaKecelakaanTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/kecelakaan', $data);
    }

    public function olahraga()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Berita Olahraga',
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/olahraga', $data);
    }

    public function kontak()
    {
        $data = [
            'title' => 'Kontak',
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/kontak', $data);
    }

    public function pemberitahuan()
    {
        $data = [
            'title' => 'Pemberitahuan',
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/pemberitahuan', $data);
    }
}
