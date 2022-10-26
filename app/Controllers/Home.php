<?php

namespace App\Controllers;

use App\Models\BeritaModel;

use App\Models\KomentarModel;

class Home extends BaseController
{
    protected $beritaModel;
    protected $komentarModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->beritaModel    = new BeritaModel();
        $this->komentarModel  = new KomentarModel();
    }

    public function index()
    {
        helper(['tanggal_helper']);
        helper(['auth']);

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
            'berita_ekonomi_trending' => $this->beritaModel->getBeritaEkonomiTrending(),
        ];

        return view('/pages/ekonomi', $data);
    }

    public function detail_berita_ekonomi($slug)
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Detail Berita Ekonomi',
            'detailEkonomi' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_ekonomi_trending' => $this->beritaModel->getBeritaEkonomiTrending()
        ];

        $builder = $this->beritaModel->table('tb_berita');

        $dataBerita = $data['detailEkonomi']['banyak_dilihat'];
        $totalView  = $dataBerita + 1;
        $dataUpdate = ['banyak_dilihat' => $totalView];

        $where = ['id_berita' => $data['detailEkonomi']['id_berita']];

        $builder->set($dataUpdate)
            ->where($where)
            ->update();

        return view('/pages/detail_berita_ekonomi', $data);
    }

    public function komentar_ekonomi($id_berita)
    {
        $this->komentarModel->save([
            'berita_id'       => $id_berita,
            'created_by'      => $this->request->getVar('created_by'),
            'isi_komentar'    => $this->request->getVar('isi_komentar'),
        ]);

        return redirect()->to('/home/detail_berita_ekonomi/' . $this->request->getVar('slug'));
    }

    public function politik()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Berita Politik',
            'berita_politik' => $this->beritaModel->getBeritaPolitik(),
            'berita_politik_terbaru' => $this->beritaModel->getBeritaPolitikTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_politik_trending' => $this->beritaModel->getBeritaPolitikTrending(),
        ];

        return view('/pages/politik', $data);
    }

    public function detail_berita_politik($slug)
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Detail Berita Politik',
            'detailPolitik' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'berita_politik_terbaru' => $this->beritaModel->getBeritaPolitikTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_politik_trending' => $this->beritaModel->getBeritaPolitikTrending(),
        ];

        $builder = $this->beritaModel->table('tb_berita');

        $dataBerita = $data['detailPolitik']['banyak_dilihat'];
        $totalView  = $dataBerita + 1;
        $dataUpdate = ['banyak_dilihat' => $totalView];

        $where = ['id_berita' => $data['detailPolitik']['id_berita']];

        $builder->set($dataUpdate)
            ->where($where)
            ->update();

        return view('/pages/detail_berita_politik', $data);
    }

    public function komentar_politik($id_berita)
    {
        $this->komentarModel->save([
            'berita_id'       => $id_berita,
            'created_by'      => $this->request->getVar('created_by'),
            'isi_komentar'    => $this->request->getVar('isi_komentar'),
        ]);

        return redirect()->to('/home/detail_berita_politik/' . $this->request->getVar('slug'));
    }

    public function kecelakaan()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Berita Kecelakaan',
            'berita_kecelakaan' => $this->beritaModel->getBeritaKecelakaan(),
            'berita_kecelakaan_terbaru' => $this->beritaModel->getBeritaKecelakaanTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_kecelakaan_trending' => $this->beritaModel->getBeritaKecelakaanTrending(),
        ];

        return view('/pages/kecelakaan', $data);
    }

    public function detail_berita_kecelakaan($slug)
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Detail Berita Kecelakaan',
            'detailKecelakaan' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'berita_kecelakaan_terbaru' => $this->beritaModel->getBeritaKecelakaanTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_kecelakaan_trending' => $this->beritaModel->getBeritaKecelakaanTrending(),
        ];

        $builder = $this->beritaModel->table('tb_berita');

        $dataBerita = $data['detailKecelakaan']['banyak_dilihat'];
        $totalView  = $dataBerita + 1;
        $dataUpdate = ['banyak_dilihat' => $totalView];

        $where = ['id_berita' => $data['detailKecelakaan']['id_berita']];

        $builder->set($dataUpdate)
            ->where($where)
            ->update();

        return view('/pages/detail_berita_kecelakaan', $data);
    }

    public function komentar_kecelakaan($id_berita)
    {
        $this->komentarModel->save([
            'berita_id'       => $id_berita,
            'created_by'      => $this->request->getVar('created_by'),
            'isi_komentar'    => $this->request->getVar('isi_komentar'),
        ]);

        return redirect()->to('/home/detail_berita_kecelakaan/' . $this->request->getVar('slug'));
    }

    public function olahraga()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Berita Olahraga',
            'berita_olahraga' => $this->beritaModel->getBeritaOlahraga(),
            'berita_olahraga_terbaru' => $this->beritaModel->getBeritaOlahragaTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_olahraga_trending' => $this->beritaModel->getBeritaOlahragaTerbaru(),
        ];

        return view('/pages/olahraga', $data);
    }

    public function detail_berita_olahraga($slug)
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Detail Berita Olahraga',
            'detailOlahraga' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'berita_olahraga_terbaru' => $this->beritaModel->getBeritaOlahragaTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_olahraga_trending' => $this->beritaModel->getBeritaOlahragaTerbaru(),
        ];

        $builder = $this->beritaModel->table('tb_berita');

        $dataBerita = $data['detailOlahraga']['banyak_dilihat'];
        $totalView  = $dataBerita + 1;
        $dataUpdate = ['banyak_dilihat' => $totalView];

        $where = ['id_berita' => $data['detailOlahraga']['id_berita']];

        $builder->set($dataUpdate)
            ->where($where)
            ->update();

        return view('/pages/detail_berita_olahraga', $data);
    }

    public function komentar_olahraga($id_berita)
    {
        $this->komentarModel->save([
            'berita_id'       => $id_berita,
            'created_by'      => $this->request->getVar('created_by'),
            'isi_komentar'    => $this->request->getVar('isi_komentar'),
        ]);

        return redirect()->to('/home/detail_berita_olahraga/' . $this->request->getVar('slug'));
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
