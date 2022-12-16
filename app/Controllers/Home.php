<?php

namespace App\Controllers;

use App\Models\BeritaModel;

use App\Models\KomentarModel;

use App\Models\JenisLanggananModel;

use App\Models\LaporanModel;

use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    protected $uri;
    protected $beritaModel;
    protected $komentarModel;
    protected $jenisLanggananModel;
    protected $laporanModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->beritaModel    = new BeritaModel();
        $this->komentarModel  = new KomentarModel();
        $this->jenisLanggananModel  = new JenisLanggananModel();
        $this->laporanModel  = new LaporanModel();
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
    }

    public function index()
    {
        helper(['tanggal_helper']);
        helper(['auth']);

        $data = [
            'title' => 'World Time',
            'uri' => $this->uri,
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
            'uri' => $this->uri,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/tentang_kami', $data);
    }

    public function ekonomi()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Berita Ekonomi',
            'uri' => $this->uri,
            'berita_ekonomi' => $this->beritaModel->getBeritaEkonomi(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_ekonomi_trending' => $this->beritaModel->getBeritaEkonomiTrending(),
        ];

        return view('/pages/ekonomi', $data);
    }

    public function detail_berita_ekonomi($slug)
    {
        helper(['tanggal_helper']);

        $id = $this->beritaModel->getBeritaBySlugAndAuthor($slug);

        $data = [
            'title' => 'Detail Berita Ekonomi',
            'uri' => $this->uri,
            'detailEkonomi' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'komentarEkonomi' => $this->komentarModel->getKomentarByBeritaId($id['id_berita']),
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

    public function komentar_ekonomi()
    {
        if ($this->request->isAJAX()) {
            $this->komentarModel->save([
                'berita_id'       => $this->request->getVar('id_berita'),
                'created_by'      => $this->request->getVar('created_by'),
                'isi_komentar'    => $this->request->getVar('isi_komentar'),
            ]);
        }
    }

    public function get_komentar_ekonomi($id_berita)
    {
        if ($this->request->isAJAX()) {
            $komentar = $this->komentarModel->getKomentarByBeritaId($id_berita);

            $datas = [];
            foreach ($komentar as $kom) {
                $kom['tanggal_komentar'] = tgl_indo_model_2($kom['tanggal_komentar']);
                $datas[] = $kom;
            }
            return $this->respond($datas);
        }
    }

    public function komentar_politik1()
    {
        if ($this->request->isAJAX()) {
            $this->komentarModel->save([
                'berita_id'       => $this->request->getVar('id_berita'),
                'created_by'      => $this->request->getVar('created_by'),
                'isi_komentar'    => $this->request->getVar('isi_komentar'),
            ]);
        }
    }

    public function get_komentar_politik($id_berita)
    {
        if ($this->request->isAJAX()) {
            $komentar = $this->komentarModel->getKomentarByBeritaId($id_berita);

            $datas = [];
            foreach ($komentar as $kom) {
                $kom['tanggal_komentar'] = tgl_indo_model_2($kom['tanggal_komentar']);
                $datas[] = $kom;
            }
            return $this->respond($datas);
        }
    }

    public function komentar_kecelakaan1()
    {
        if ($this->request->isAJAX()) {
            $this->komentarModel->save([
                'berita_id'       => $this->request->getVar('id_berita'),
                'created_by'      => $this->request->getVar('created_by'),
                'isi_komentar'    => $this->request->getVar('isi_komentar'),
            ]);
        }
    }

    public function get_komentar_kecelakaan($id_berita)
    {
        if ($this->request->isAJAX()) {
            $komentar = $this->komentarModel->getKomentarByBeritaId($id_berita);

            $datas = [];
            foreach ($komentar as $kom) {
                $kom['tanggal_komentar'] = tgl_indo_model_2($kom['tanggal_komentar']);
                $datas[] = $kom;
            }
            return $this->respond($datas);
        }
    }

    public function komentar_olahraga1()
    {
        if ($this->request->isAJAX()) {
            $this->komentarModel->save([
                'berita_id'       => $this->request->getVar('id_berita'),
                'created_by'      => $this->request->getVar('created_by'),
                'isi_komentar'    => $this->request->getVar('isi_komentar'),
            ]);
        }
    }

    public function get_komentar_olahraga($id_berita)
    {
        if ($this->request->isAJAX()) {
            $komentar = $this->komentarModel->getKomentarByBeritaId($id_berita);

            $datas = [];
            foreach ($komentar as $kom) {
                $kom['tanggal_komentar'] = tgl_indo_model_2($kom['tanggal_komentar']);
                $datas[] = $kom;
            }
            return $this->respond($datas);
        }
    }

    public function politik()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'Berita Politik',
            'uri' => $this->uri,
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

        $id = $this->beritaModel->getBeritaBySlugAndAuthor($slug);

        $data = [
            'title' => 'Detail Berita Politik',
            'uri' => $this->uri,
            'detailPolitik' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'komentarPolitik' => $this->komentarModel->getKomentarByBeritaId($id['id_berita']),
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
            'uri' => $this->uri,
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

        $id = $this->beritaModel->getBeritaBySlugAndAuthor($slug);

        $data = [
            'title' => 'Detail Berita Kecelakaan',
            'uri' => $this->uri,
            'detailKecelakaan' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'komentarKecelakaan' => $this->komentarModel->getKomentarByBeritaId($id['id_berita']),
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
            'uri' => $this->uri,
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

        $id = $this->beritaModel->getBeritaBySlugAndAuthor($slug);

        $data = [
            'title' => 'Detail Berita Olahraga',
            'uri' => $this->uri,
            'detailOlahraga' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'komentarOlahraga' => $this->komentarModel->getKomentarByBeritaId($id['id_berita']),
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
            'uri' => $this->uri,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/kontak', $data);
    }

    public function laporkan()
    {
        $data = [
            'title' => 'Laporkan Kejadian Disekitarmu',
            'uri' => $this->uri,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/laporkan', $data);
    }

    public function proses_laporkan()
    {
        $this->laporanModel->save([
            'nama_pengirim' => $this->request->getVar('nama_lengkap'),
            'no_whatsapp' => $this->request->getVar('nomer_whatsapp'),
            'isi_pesan' => $this->request->getVar('pesan'),
        ]);

        session()->setFlashdata('success', 'Laporanmu Berhasil Dikirim');

        return redirect()->to('/home/laporkan');
    }

    public function pilih_langganan()
    {
        $data = [
            'title' => 'Pilih Langganan',
            'uri' => $this->uri,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_langganan' => $this->jenisLanggananModel->findAll(),
        ];

        return view('/pages/pilih_langganan', $data);
    }
}
