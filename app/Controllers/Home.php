<?php

namespace App\Controllers;

use App\Models\BeritaModel;

use App\Models\KomentarModel;

use App\Models\JenisLanggananModel;

use App\Models\LaporanModel;

use App\Models\AkunModel;

use App\Models\KategoriModel;

use CodeIgniter\API\ResponseTrait;

use App\Models\BalasModel;

use App\Models\TaglineModel;

use App\Models\TagsBeritaModel;

use App\Models\InvoiceModel;

use App\Models\PembayaranModel;

class Home extends BaseController
{
    use ResponseTrait;
    protected $uri;
    protected $beritaModel;
    protected $komentarModel;
    protected $kategoriModel;
    protected $jenisLanggananModel;
    protected $taglineModel;
    protected $laporanModel;
    protected $balasModel;
    protected $akunModel;
    protected $tagsBeritaModel;
    protected $pembayaranModel;
    protected $invoiceModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->beritaModel    = new BeritaModel();
        $this->komentarModel  = new KomentarModel();
        $this->kategoriModel = new KategoriModel();
        $this->jenisLanggananModel  = new JenisLanggananModel();
        $this->tagsBeritaModel  = new TagsBeritaModel();
        $this->tagsBeritaModel  = new TagsBeritaModel();
        $this->taglineModel  = new TaglineModel();
        $this->invoiceModel  = new InvoiceModel();
        $this->laporanModel  = new LaporanModel();
        $this->balasModel = new BalasModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->akunModel = new AkunModel();
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
    }

    public function index()
    {
        helper(['tanggal_helper']);
        helper(['auth']);

        $data = [
            'title' => 'World Time | Beranda',
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
            'title' => 'World Time | Tentang Kami',
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
            'title' => 'World Time | Berita Ekonomi',
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
            'title' => $id['judul_berita'],
            'uri' => $this->uri,
            'detailEkonomi' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'komentarEkonomi' => $this->komentarModel->getKomentarByBeritaId($id['id_berita']),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'berita_ekonomi_trending' => $this->beritaModel->getBeritaEkonomiTrending(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($id['id_berita'], $id['kategori_id']),
            'balasKomentar' => $this->balasModel,
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
            'title' => 'World Time | Berita Politik',
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
            'title' => $id['judul_berita'],
            'uri' => $this->uri,
            'detailPolitik' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'komentarPolitik' => $this->komentarModel->getKomentarByBeritaId($id['id_berita']),
            'berita_politik_terbaru' => $this->beritaModel->getBeritaPolitikTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($id['id_berita'], $id['kategori_id']),
            'berita_politik_trending' => $this->beritaModel->getBeritaPolitikTrending(),
            'balasKomentar' => $this->balasModel,
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
            'title' => 'World Time | Berita Kecelakaan',
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
            'title' => $id['judul_berita'],
            'uri' => $this->uri,
            'detailKecelakaan' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'komentarKecelakaan' => $this->komentarModel->getKomentarByBeritaId($id['id_berita']),
            'berita_kecelakaan_terbaru' => $this->beritaModel->getBeritaKecelakaanTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($id['id_berita'], $id['kategori_id']),
            'berita_kecelakaan_trending' => $this->beritaModel->getBeritaKecelakaanTrending(),
            'balasKomentar' => $this->balasModel,
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
            'title' => 'World Time | Berita Olahraga',
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
            'title' => $id['judul_berita'],
            'uri' => $this->uri,
            'detailOlahraga' => $this->beritaModel->getBeritaBySlugAndAuthor($slug),
            'komentarOlahraga' => $this->komentarModel->getKomentarByBeritaId($id['id_berita']),
            'berita_olahraga_terbaru' => $this->beritaModel->getBeritaOlahragaTerbaru(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($id['id_berita'], $id['kategori_id']),
            'berita_olahraga_trending' => $this->beritaModel->getBeritaOlahragaTerbaru(),
            'balasKomentar' => $this->balasModel,
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
            'title' => 'World Time | Laporkan Kejadian Disekitarmu',
            'uri' => $this->uri,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_laporan' => $this->laporanModel->getDataLaporan()
        ];

        return view('../../vendor/wapigateway/laporkan', $data);
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
            'title' => 'World Time | Pilih Langganan',
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
            'title' => 'World Time | Edit Profile',
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
            'email'   => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'valid_email' => 'Format {field} Anda Salah!',
                ]
            ],
            'profile_img'   => [
                'label'  => 'Foto Profile',
                'rules'  => 'max_size[profile_img,1024]|is_image[profile_img]|mime_in[profile_img,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar Terlalu Besar!',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar!',
                    'mime_in'  => 'Yang Anda Pilih Bukan Gambar!'
                ]
            ],
            'fullname'   => [
                'label'  => 'Nama Lengkap',
                'rules'  => 'required|min_length[10]|max_length[50]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'min_length' => '{field} Minimal 10 Karakter!',
                    'max_length' => '{field} Maksimal 50 Karakter!',
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

    public function edit_post()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->beritaModel->searchDataBerita($keyword);
        } else {
            $data_berita = $this->beritaModel;
        }

        $data = [
            'title' => 'World Time | Kelola Postingan Berita',
            'data_laporan' => $this->laporanModel->getDataLaporan(),
            'uri' => $this->uri,
            'data_postku' => $this->beritaModel->where('created_by', user()->username)->where('status_berita', 1)->orWhere('status_berita', 0)->orWhere('status_berita', 2)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/edit_post', $data);
    }

    public function hapus_berita($slug)
    {
        $data_berita = $this->beritaModel->getBeritaBySlug($slug);

        $data_tags_berita = $this->tagsBeritaModel->getTagsById($data_berita['id_berita']);

        foreach ($data_tags_berita as $value) {
            if ($data_berita['id_berita'] == $value['berita_id']) {
                $this->tagsBeritaModel->hapus_tags($value['id_tags_berita']);
            }
        }

        unlink('assets/images/resource_berita/' . $data_berita['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/home/edit_post');
    }

    public function tambah_data_berita()
    {
        $data = [
            'title' => 'World Time | Create Data Berita',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'data_laporan' => $this->laporanModel->getDataLaporan(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/create_data_berita', $data);
    }

    public function getTagline($kategri_id)
    {
        if ($this->request->isAJAX()) {
            $dataTagline = $this->taglineModel->getTaglineByKategoriId($kategri_id);

            return $this->respond($dataTagline);
        }
    }

    public function proses_create_berita()
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label' => 'Judul Berita',
                'rules'  => 'required|is_unique[tb_berita.judul_berita]|min_length[50]|max_length[100]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'is_unique' => '{field} Tersebut Sudah Digunakan!',
                    'min_length' => '{field} Minimal 50 Karakter!',
                    'max_length' => '{field} Maksimal 100 Karakter!'
                ]
            ],
            'created_by'   => [
                'label' => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!'
                ]
            ],
            'gambar_berita'   => [
                'label' => 'Gambar',
                'rules'  => 'uploaded[gambar_berita]|max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih {field} Terlebih Dahulu!',
                    'max_size' => 'Ukuran Gambar Terlalu Besar!',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar!',
                    'mime_in'  => 'Yang Anda Pilih Bukan Gambar!'
                ]
            ],
            'isi_berita' => [
                'label' => 'Isi Berita',
                'rules' => 'required|min_length[100]|max_length[10000]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'min_length' => '{field} Minimal 100 Karakter!',
                    'max_length' => '{field} Maksimal 10.000 Karakter!'
                ]
            ],
        ])) {
            return redirect()->to('/home/tambah_data_berita')->withInput();
        }

        $fileGambar = $this->request->getFile('gambar_berita');

        $namaGambar = $fileGambar->getRandomName();

        $fileGambar->move('assets/images/resource_berita', $namaGambar);

        $slug = url_title($this->request->getVar('judul_berita'), '-', true);

        $this->beritaModel->save([
            'judul_berita'    => $this->request->getVar('judul_berita'),
            'slug'            => $slug,
            'created_by'      => $this->request->getVar('created_by'),
            'isi_berita'      => $this->request->getVar('isi_berita'),
            'kategori_id'     => intval($this->request->getVar('kategori_id')),
            'gambar_berita'   => $namaGambar,
            'tanggal_buat' => date('Y-m-d')
        ]);

        $data_berita = $this->beritaModel->getBeritaByJudul($this->request->getVar('judul_berita'));

        foreach ($this->request->getVar('tagline[]') as $tags) {
            $data_tags = $this->taglineModel->getTaglineByName($tags);

            if (empty($data_tags)) {
                $this->taglineModel->save([
                    'nama_tags' => $tags,
                    'kategori_id' => $data_berita['kategori_id'],
                    'banyak_digunakan' => 1
                ]);
            }


            foreach ($data_tags as $datatag) {
                $builder = $this->taglineModel->table('tags');

                $data = [
                    'banyak_digunakan' => $datatag['banyak_digunakan'] + 1,
                ];

                $where = ['id_tags' => $datatag['id_tags']];

                $builder->set($data)
                    ->where($where)
                    ->update();
            }
        }

        foreach ($this->request->getVar('tagline[]') as $tags) {
            $data_tags_berita = $this->taglineModel->getTaglineByName($tags);

            foreach ($data_tags_berita as $data_tag) {
                $this->tagsBeritaModel->save([
                    'berita_id' => $data_berita['id_berita'],
                    'tags_id' => $data_tag['id_tags']
                ]);
            }
        }

        session()->setFlashdata('success', 'Data Berhasil Disimpan.');

        return redirect()->to('/home/edit_post');
    }

    public function edit_data_berita($slug)
    {
        $beritaEkonomi = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'World Time | Edit Data Berita',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'data_laporan' => $this->laporanModel->getDataLaporan(),
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($beritaEkonomi['id_berita'], $beritaEkonomi['kategori_id']),
            'data_berita' => $this->beritaModel->getBeritaBySlug($slug),
        ];

        return view('/pages/edit_data_berita', $data);
    }

    public function proses_edit_berita($id_berita)
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label' => 'Judul Berita',
                'rules'  => 'required|min_length[50]|max_length[100]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'min_length' => '{field} Minimal 50 Karakter!',
                    'max_length' => '{field} Maksimal 100 Karakter!'
                ]
            ],
            'created_by'   => [
                'label'  => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!'
                ]
            ],
            'gambar_berita'   => [
                'label'  => 'Gambar',
                'rules'  => 'max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar Terlalu Besar!',
                    'is_image' => 'Yang Anda Pilih Bukan Gambar!',
                    'mime_in'  => 'Yang Anda Pilih Bukan Gambar!'
                ]
            ],
            'isi_berita' => [
                'label' => 'Isi Berita',
                'rules' => 'required|min_length[100]|max_length[10000]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'min_length' => '{field} Minimal 100 Karakter!',
                    'max_length' => '{field} Maksimal 10.000 Karakter!'
                ]
            ],
        ])) {
            return redirect()->to('/home/edit_data_berita/' . $this->request->getVar('slug'))->withInput();
        }

        $fileGambar = $this->request->getFile('gambar_berita');

        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLamaBerita');
        } else {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('assets/images/resource_berita/', $namaGambar);
            unlink('assets/images/resource_berita/' . $this->request->getVar('gambarLamaBerita'));
        }

        $builder = $this->beritaModel->table('tb_berita');

        $slug = url_title($this->request->getVar('judul_berita'), '-', true);

        $data = [
            'judul_berita'    => $this->request->getVar('judul_berita'),
            'slug'            => $slug,
            'created_by'      => $this->request->getVar('created_by'),
            'isi_berita'      => $this->request->getVar('isi_berita'),
            'kategori_id' => $this->request->getVar('kategori_id'),
            'gambar_berita'   => $namaGambar,
            'tanggal_update' => date('Y-m-d')
        ];

        $where = ['id_berita' => $id_berita];

        $builder->set($data)
            ->where($where)
            ->update();

        $data_berita = $this->beritaModel->getBeritaByJudul($this->request->getVar('judul_berita'));

        foreach ($this->request->getVar('tagline[]') as $tags) {
            $data_tags = $this->taglineModel->getTaglineByName($tags);

            if (empty($data_tags)) {
                $this->taglineModel->save([
                    'nama_tags' => $tags,
                    'kategori_id' => $data_berita['kategori_id'],
                    'banyak_digunakan' => 1
                ]);
            }
        }

        $this->tagsBeritaModel->delete_tags($data_berita['id_berita']);

        foreach ($this->request->getVar('tagline[]') as $tags) {
            $data_tags_berita = $this->taglineModel->getTaglineByName($tags);
            foreach ($data_tags_berita as $data_tag) {
                $this->tagsBeritaModel->save([
                    'berita_id' => $data_berita['id_berita'],
                    'tags_id' => $data_tag['id_tags']
                ]);
            }
        }

        session()->setFlashdata('success', 'Data Berhasil Diedit.');

        return redirect()->to('/home/edit_post');
    }

    public function history_pembayaran()
    {
        $data = [
            'title' => 'World Time | History Pembayaran',
            'data_pembayaran' => $this->invoiceModel->where('nama_pelanggan', user()->username)->orderBy('id_invoice', 'DESC')->paginate(10, 'tb_invoice'),
            'data_laporan' => $this->laporanModel->getDataLaporan(),
            'pager' => $this->invoiceModel->pager,
            'uri' => $this->uri,
            'berita_ekonomi_terbaru' => $this->beritaModel->getBeritaEkonomiTerbaru(),
        ];

        return view('/pages/history_pembayaran', $data);
    }
}
