<?php

namespace App\Controllers;

use App\Models\BeritaModel;

use App\Models\KomentarModel;

use App\Models\JenisLanggananModel;

use App\Models\LaporanModel;

use App\Models\AkunModel;

use CodeIgniter\API\ResponseTrait;

use App\Models\BalasModel;

class Home extends BaseController
{
    use ResponseTrait;
    protected $uri;
    protected $beritaModel;
    protected $komentarModel;
    protected $jenisLanggananModel;
    protected $laporanModel;
    protected $balasModel;
    protected $akunModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->beritaModel    = new BeritaModel();
        $this->komentarModel  = new KomentarModel();
        $this->jenisLanggananModel  = new JenisLanggananModel();
        $this->laporanModel  = new LaporanModel();
        $this->balasModel = new BalasModel();
        $this->akunModel = new AkunModel();
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
            'data_laporan' => $this->laporanModel->getDataLaporan()
        ];

        return view('/pages/index', $data);
    }

    public function tentang_kami()
    {
        $data = [
            'title' => 'Tentang Kami',
            'uri' => $this->uri,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_laporan' => $this->laporanModel->getDataLaporan()
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
            'data_laporan' => $this->laporanModel->getDataLaporan()
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
            'data_laporan' => $this->laporanModel->getDataLaporan()
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
            'data_laporan' => $this->laporanModel->getDataLaporan()
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
            'data_laporan' => $this->laporanModel->getDataLaporan()
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

    public function laporkan()
    {
        $data = [
            'title' => 'Laporkan Kejadian Disekitarmu',
            'uri' => $this->uri,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_laporan' => $this->laporanModel->getDataLaporan()
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
            'data_laporan' => $this->laporanModel->getDataLaporan()
        ];

        return view('/pages/pilih_langganan', $data);
    }

    public function balas_ekonomi()
    {
        if ($this->request->isAJAX()) {
            $this->balasModel->save([
                'komentar_id' => $this->request->getVar('komentar_id'),
                'penulis_komentar' => $this->request->getVar('created_by'),
                'isi_balas_komentar' => $this->request->getVar('balas_komentar'),
                'profile_penulis' => user()->profile_img
            ]);
        }
    }

    public function get_balas_ekonomi($komentar_id)
    {
        if ($this->request->isAJAX()) {
            $balas_komentar = $this->balasModel->getBalasKomentarById($komentar_id);
            $datas = [];
            foreach ($balas_komentar as $value) {
                $value['tanggal_balas_komentar'] = tgl_indo_model_2($value['tanggal_balas_komentar']);
                $datas[] = $value;
            }
            return $this->respond($datas);
        }
    }

    public function edit_profile()
    {
        $data = [
            'title' => 'Edit Profile',
            'data_laporan' => $this->laporanModel->getDataLaporan(),
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/edit_profile', $data);
    }

    public function proses_edit_profile($id)
    {
        if (!$this->validate([
            'profile_img'   => [
                'label'  => 'Foto Profile',
                'rules'  => 'max_size[profile_img,1024]|is_image[profile_img]|mime_in[profile_img,image/jpg,image/jpeg,/image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in'  => 'Yang anda pilih bukan gambar!'
                ]
            ],
        ])) {
            return redirect()->to('/home/edit_profile')->withInput();
        }

        $file_gambar = $this->request->getFile('profile_img');

        $profile_lama = $this->request->getVar('profile_lama');

        if ($profile_lama == 'default.png') {
            $nama_gambar = $file_gambar->getRandomName();

            $file_gambar->move('assets/images/profile_users', $nama_gambar);
        } else {
            $nama_gambar = $file_gambar->getRandomName();

            $file_gambar->move('assets/images/profile_users', $nama_gambar);

            unlink('assets/images/profile_users/' . $this->request->getVar('profile_lama'));
        }

        $builder = $this->akunModel->table('users');

        $data = [
            'profile_img' => $nama_gambar,
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('nama_lengkap')
        ];

        $where = ['id' => $id];

        $builder->set($data)
            ->where($where)
            ->update();

        return redirect()->to('/');
    }
}
