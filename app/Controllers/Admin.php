<?php

namespace App\Controllers;

use App\Models\BeritaModel;

use App\Models\LoginsModel;

use App\Models\UsersModel;

use App\Models\AkunModel;

use App\Models\KomentarModel;

use App\Models\PembayaranModel;

use App\Models\JenisLanggananModel;

use App\Models\InvoiceModel;

use App\Models\TaglineModel;

use App\Models\LaporanModel;

use App\Models\UserAkunModel;

use App\Models\KategoriModel;

use App\Models\AuthPermissionsModel;

use App\Models\BalasModel;

use App\Models\TagsBeritaModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Reader\Xls\MD5;

use Dompdf\Dompdf;

use CodeIgniter\API\ResponseTrait;

class Admin extends BaseController
{
    use ResponseTrait;
    protected $beritaModel;
    protected $loginsModel;
    protected $usersModel;
    protected $akunModel;
    protected $kategoriModel;
    protected $invoiceModel;
    protected $komentarModel;
    protected $pembayaranModel;
    protected $laporanModel;
    protected $uri;
    protected $taglineModel;
    protected $carbon;
    protected $jenisLanggananModel;
    protected $userModel;
    protected $authModel;
    protected $balasModel;
    protected $tagsBeritaModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->kategoriModel = new KategoriModel();
        $this->loginsModel = new LoginsModel();
        $this->usersModel  = new UsersModel();
        $this->akunModel   = new AkunModel();
        $this->taglineModel = new TaglineModel();
        $this->komentarModel = new KomentarModel();
        $this->invoiceModel = new InvoiceModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->laporanModel = new LaporanModel();
        $this->userModel = new UserAkunModel();
        $this->carbon = new Carbon();
        $this->balasModel = new BalasModel();
        $this->authModel = new AuthPermissionsModel();
        $this->jenisLanggananModel  = new JenisLanggananModel();
        $this->tagsBeritaModel = new TagsBeritaModel();
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
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
            'title' => 'My Admin | Dashboard Admin',
            'data_users_login' => $this->loginsModel->where('success', 1)->orderBy('id', 'DESC')->paginate(10, 'auth_logins'),
            'pager' => $this->loginsModel->pager,
            'currentPage' => $this->request->getVar('page_auth_logins') ? $this->request->getVar('page_auth_logins') : 1,
            'keyword' => $keyword,
            'uri' => $this->uri,
            'count_politik' => $this->beritaModel->countPolitik(),
            'count_olahraga' => $this->beritaModel->countOlahraga(),
            'count_kecelakaan' => $this->beritaModel->countKecelakaan(),
            'count_ekonomi' => $this->beritaModel->countEkonomi(),
            'count_data_admin' => $this->akunModel->getCountDataAdmin(),
            'count_users_free' => $this->akunModel->getCountUsersFree(),
            'count_users_premium' => $this->akunModel->getCountUsersPremium(),
            'riwayat_transaksi' => $this->invoiceModel->getRiwayatTransaksi(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'total_pendapatan' => $this->invoiceModel->getTotalPendapatan(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/dashboard_admin', $data);
    }

    public function moderasi_berita()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->beritaModel->searchDataBerita($keyword);
        } else {
            $data_berita_moderasi = $this->beritaModel;
        }

        $data = [
            'title' => 'My Admin | Moderasi Berita',
            'uri' => $this->uri,
            'data_berita_moderasi' => $this->beritaModel->where('status_berita', 0)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'keyword' => $keyword,
            'pager' => $this->beritaModel->pager,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/moderasi_data', $data);
    }

    public function moderasi_laporan()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->laporanModel->searchDataLaporan($keyword);
        } else {
            $data_moderasi_laporan = $this->laporanModel;
        }

        $data = [
            'title' => 'My Admin | Moderasi Laporan',
            'uri' => $this->uri,
            'data_laporan_moderasi' => $this->laporanModel->where('status_laporan', 0)->orderBy('id_laporan', 'DESC')->paginate(10, 'tb_laporan_masyarakat'),
            'currentPage' => $this->request->getVar('page_tb_laporan_masyarakat') ? $this->request->getVar('page_tb_laporan_masyarakat') : 1,
            'keyword' => $keyword,
            'pager' => $this->laporanModel->pager,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/moderasi_laporan', $data);
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

        session()->setFlashdata('success', 'Data Berita Berhasil Disetujui');

        return redirect()->to('/admin/moderasi_berita');
    }

    public function proses_moderasi_laporan($id_laporan)
    {
        $builder = $this->laporanModel->table('tb_laporan_masyarakat');

        $data = [
            'status_laporan' => 1,
        ];

        $where = ['id_laporan' => $id_laporan];

        $builder->set($data)
            ->where($where)
            ->update();

        session()->setFlashdata('success', 'Data Laporan Berhasil Disetujui');

        return redirect()->to('/admin/moderasi_laporan');
    }

    public function detail_berita_moderasi($slug)
    {
        $beritaModerasi = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => $beritaModerasi['judul_berita'],
            'uri' => $this->uri,
            'detail_berita' => $this->beritaModel->getBeritaBySlug($slug),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($beritaModerasi['id_berita'], $beritaModerasi['kategori_id']),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
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
            'title' => 'My Admin | Data Berita Kecelakaan',
            'uri' => $this->uri,
            'data_berita' => $this->beritaModel->where('kategori_id', 1)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
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
            'title' => 'My Admin | Data Berita Politik',
            'uri' => $this->uri,
            'data_berita' => $this->beritaModel->where('kategori_id', 3)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
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
            'title' => 'My Admin | Data Berita Ekonomi',
            'uri' => $this->uri,
            'data_berita' => $this->beritaModel->where('kategori_id', 2)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_ekonomi', $data);
    }

    public function data_olahraga()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->beritaModel->searchDataBeritaOlahraga($keyword);
        } else {
            $data_berita_olahraga = $this->beritaModel;
        }

        $data = [
            'title' => 'My Admin | Data Berita Olahraga',
            'uri' => $this->uri,
            'data_berita' => $this->beritaModel->where('kategori_id', 4)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_olahraga', $data);
    }

    public function user_free()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->akunModel->searchDataUsersFree($keyword);
        } else {
            $data_users_free = $this->akunModel;
        }

        $data = [
            'title' => 'My Admin | Data Users Free',
            'uri' => $this->uri,
            'data_users_free' => $this->akunModel->where('jenis_akun_id', 1)->orderBy('id', 'DESC')->paginate(10, 'users'),
            'currentPage' => $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1,
            'pager' => $this->akunModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_users_free', $data);
    }

    public function hapus_users_free($id)
    {
        $this->akunModel->delete_akun($id);

        session()->setFlashdata('success', 'Akun Berhasil Dihapus.');

        return redirect()->to('/admin/users_free');
    }

    public function user_premium()
    {
        helper(['tanggal_helper']);

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->akunModel->searchDataUsersPremium($keyword);
        } else {
            $data_users_premium = $this->akunModel;
        }

        $data = [
            'title' => 'My Admin | Data Users Premium',
            'uri' => $this->uri,
            'data_users_premium' => $this->akunModel->where('jenis_akun_id', 2)->orderBy('id', 'DESC')->paginate(10, 'users'),
            'currentPage' => $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1,
            'pager' => $this->akunModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_users_premium', $data);
    }

    public function admin()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->akunModel->searchDataAdmin($keyword);
        } else {
            $data_admin = $this->akunModel;
        }

        $data = [
            'title' => 'My Admin | Data Admin',
            'uri' => $this->uri,
            'data_admin' => $this->akunModel->where('jenis_akun_id', 3)->orderBy('id', 'DESC')->paginate(10, 'users'),
            'currentPage' => $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1,
            'pager' => $this->akunModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_admin', $data);
    }

    public function hapus_admin($id)
    {
        $this->akunModel->delete_akun($id);

        session()->setFlashdata('success', 'Akun Berhasil Dihapus.');

        return redirect()->to('/admin/admin');
    }

    public function export_excel_berita_kecelakaan()
    {
        $beritaKecelakaan = $this->beritaModel->getBeritaKecelakaanExport($this->request->getVar('tanggal'));

        if (empty($beritaKecelakaan)) {
            echo '<script>
                alert("Data Berita Kecelakaan Tidak Tersedia!");
                window.location.href = "/admin/data_kecelakaan";
            </script';
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Judul Berita');
            $sheet->setCellValue('C1', 'Penulis Berita');
            $sheet->setCellValue('D1', 'Kategori Berita');
            $sheet->setCellValue('E1', 'Gambar Berita');
            $sheet->setCellValue('F1', 'Jumlah View');
            $sheet->setCellValue('G1', 'Created At');

            $column = 2;
            foreach ($beritaKecelakaan as $value) {
                $sheet->setCellValue('A' . $column, ($column - 1));
                $sheet->setCellValue('B' . $column, $value['judul_berita']);
                $sheet->setCellValue('C' . $column, $value['created_by']);
                $sheet->setCellValue('D' . $column, $value['nama_kategori']);
                $sheet->setCellValue('E' . $column, $value['gambar_berita']);
                $sheet->setCellValue('F' . $column, $value['banyak_dilihat']);
                $sheet->setCellValue('G' . $column, $value['tanggal_buat']);
                $column++;
            };

            $sheet->getStyle('A1:G1')->getFont()->setBold(true);
            $styleArray1 = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                    'inside' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ]
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $styleArray2 = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];

            $sheet->getStyle('A1:G' . ($column - 1))->applyFromArray($styleArray1);
            $sheet->getStyle('B2:B' . ($column - 1))->applyFromArray($styleArray2);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-disposition: attachment;filename=' . $this->request->getVar('nama-file') . '.xlsx');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        }
    }

    public function export_excel_berita_ekonomi()
    {
        $beritaEkonomi = $this->beritaModel->getBeritaEkonomiExport($this->request->getVar('tanggal'));

        if (empty($beritaEkonomi)) {
            echo '<script>
                alert("Data Berita Ekonomi Tidak Tersedia!");
                window.location.href = "/admin/data_ekonomi";
            </script';
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Judul Berita');
            $sheet->setCellValue('C1', 'Penulis Berita');
            $sheet->setCellValue('D1', 'Kategori Berita');
            $sheet->setCellValue('E1', 'Gambar Berita');
            $sheet->setCellValue('F1', 'Jumlah View');
            $sheet->setCellValue('G1', 'Created At');

            $column = 2;
            foreach ($beritaEkonomi as $value) {
                $sheet->setCellValue('A' . $column, ($column - 1));
                $sheet->setCellValue('B' . $column, $value['judul_berita']);
                $sheet->setCellValue('C' . $column, $value['created_by']);
                $sheet->setCellValue('D' . $column, $value['nama_kategori']);
                $sheet->setCellValue('E' . $column, $value['gambar_berita']);
                $sheet->setCellValue('F' . $column, $value['banyak_dilihat']);
                $sheet->setCellValue('G' . $column, $value['tanggal_buat']);
                $column++;
            };

            $sheet->getStyle('A1:G1')->getFont()->setBold(true);
            $styleArray1 = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                    'inside' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ]
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $styleArray2 = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];

            $sheet->getStyle('A1:G' . ($column - 1))->applyFromArray($styleArray1);
            $sheet->getStyle('B2:B' . ($column - 1))->applyFromArray($styleArray2);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-disposition: attachment;filename=' . $this->request->getVar('nama-file') . '.xlsx');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        }
    }

    public function export_excel_berita_politik()
    {
        $beritaPolitik = $this->beritaModel->getBeritaPolitikExport($this->request->getVar('tanggal'));

        if (empty($beritaPolitik)) {
            echo '<script>
                alert("Data Berita Politik Tidak Tersedia!");
                window.location.href = "/admin/data_politik";
            </script';
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Judul Berita');
            $sheet->setCellValue('C1', 'Penulis Berita');
            $sheet->setCellValue('D1', 'Kategori Berita');
            $sheet->setCellValue('E1', 'Gambar Berita');
            $sheet->setCellValue('F1', 'Jumlah View');
            $sheet->setCellValue('G1', 'Created At');

            $column = 2;
            foreach ($beritaPolitik as $value) {
                $sheet->setCellValue('A' . $column, ($column - 1));
                $sheet->setCellValue('B' . $column, $value['judul_berita']);
                $sheet->setCellValue('C' . $column, $value['created_by']);
                $sheet->setCellValue('D' . $column, $value['nama_kategori']);
                $sheet->setCellValue('E' . $column, $value['gambar_berita']);
                $sheet->setCellValue('F' . $column, $value['banyak_dilihat']);
                $sheet->setCellValue('G' . $column, $value['tanggal_buat']);
                $column++;
            };

            $sheet->getStyle('A1:G1')->getFont()->setBold(true);
            $styleArray1 = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                    'inside' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ]
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $styleArray2 = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];

            $sheet->getStyle('A1:G' . ($column - 1))->applyFromArray($styleArray1);
            $sheet->getStyle('B2:B' . ($column - 1))->applyFromArray($styleArray2);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-disposition: attachment;filename=' . $this->request->getVar('nama-file') . '.xlsx');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        }
    }

    public function export_excel_berita_olahraga()
    {
        $beritaOlahraga = $this->beritaModel->getBeritaOlahragaExport($this->request->getVar('tanggal'));

        if (empty($beritaOlahraga)) {
            echo '<script>
                alert("Data Berita Olahraga Tidak Tersedia!");
                window.location.href = "/admin/data_olahraga";
            </script';
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Judul Berita');
            $sheet->setCellValue('C1', 'Penulis Berita');
            $sheet->setCellValue('D1', 'Kategori Berita');
            $sheet->setCellValue('E1', 'Gambar Berita');
            $sheet->setCellValue('F1', 'Jumlah View');
            $sheet->setCellValue('G1', 'Created At');

            $column = 2;
            foreach ($beritaOlahraga as $value) {
                $sheet->setCellValue('A' . $column, ($column - 1));
                $sheet->setCellValue('B' . $column, $value['judul_berita']);
                $sheet->setCellValue('C' . $column, $value['created_by']);
                $sheet->setCellValue('D' . $column, $value['nama_kategori']);
                $sheet->setCellValue('E' . $column, $value['gambar_berita']);
                $sheet->setCellValue('F' . $column, $value['banyak_dilihat']);
                $sheet->setCellValue('G' . $column, $value['tanggal_buat']);
                $column++;
            };

            $sheet->getStyle('A1:G1')->getFont()->setBold(true);
            $styleArray1 = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                    'inside' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ]
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $styleArray2 = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];

            $sheet->getStyle('A1:G' . ($column - 1))->applyFromArray($styleArray1);
            $sheet->getStyle('B2:B' . ($column - 1))->applyFromArray($styleArray2);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-disposition: attachment;filename=' . $this->request->getVar('nama-file') . '.xlsx');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        }
    }

    public function export_excel_data_invoice()
    {
        $dataInvoice = $this->invoiceModel->getDataInvoiceExport($this->request->getVar('tanggal'));

        if (empty($dataInvoice)) {
            echo '<script>
                alert("Data Invoice Tidak Tersedia!");
                window.location.href = "/admin/data_invoice";
            </script';
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Order ID');
            $sheet->setCellValue('C1', 'Nama Pemesan');
            $sheet->setCellValue('D1', 'Nama Produk');
            $sheet->setCellValue('E1', 'Status Pembayaran');
            $sheet->setCellValue('F1', 'Total Pembayaran');

            $column = 2;
            foreach ($dataInvoice as $value) {
                $sheet->setCellValue('A' . $column, ($column - 1));
                $sheet->setCellValue('B' . $column, $value['order_id']);
                $sheet->setCellValue('C' . $column, $value['nama_pelanggan']);
                $sheet->setCellValue('D' . $column, 'Layanan ' . $value['nama_produk']);
                $sheet->setCellValue('E' . $column, $value['status_pembayaran']);
                $sheet->setCellValue('F' . $column, 'Rp. ' . number_format($value['total_pembayaran'], 0, ",", "."));
                $column++;
            };

            $sheet->getStyle('A1:F1')->getFont()->setBold(true);

            $styleArray1 = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                    'inside' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ]
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];


            $sheet->getStyle('A1:F' . ($column - 1))->applyFromArray($styleArray1);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-disposition: attachment;filename=' . $this->request->getVar('nama-file') . '.xlsx');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        }
    }

    public function create_berita_kecelakaan()
    {
        $data = [
            'title' => 'My Admin | Create Berita Kecelakaan',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/create_berita_kecelakaan', $data);
    }

    public function proses_create_kecelakaan()
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
            return redirect()->to('/admin/create_berita_kecelakaan')->withInput();
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
            'tanggal_buat'    => date('Y-m-d')
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

        return redirect()->to('/admin/data_kecelakaan');
    }

    public function getTagline($kategri_id)
    {
        if ($this->request->isAJAX()) {
            $dataTagline = $this->taglineModel->getTaglineByKategoriId($kategri_id);

            return $this->respond($dataTagline);
        }
    }

    public function detail_kecelakaan($slug)
    {
        $detailKecelakaan = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => $detailKecelakaan['judul_berita'],
            'uri' => $this->uri,
            'detailKecelakaan' => $detailKecelakaan,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($detailKecelakaan['id_berita'], $detailKecelakaan['kategori_id']),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/detail_berita_kecelakaan', $data);
    }

    public function edit_berita_kecelakaan($slug)
    {
        $beritaKecelakaan = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'My Admin | Edit Berita Kecelakaan',
            'uri' => $this->uri,
            'beritaKecelakaan' => $beritaKecelakaan,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($beritaKecelakaan['id_berita'], $beritaKecelakaan['kategori_id']),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/edit_berita_kecelakaan', $data);
    }

    public function proses_edit_kecelakaan($id_berita)
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
            return redirect()->to('/admin/edit_berita_kecelakaan/' . $this->request->getVar('slug'))->withInput();
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

        return redirect()->to('/admin/data_kecelakaan');
    }

    public function hapus_kecelakaan($slug)
    {
        $beritaKecelakaan = $this->beritaModel->getBeritaBySlug($slug);

        $data_tags_berita = $this->tagsBeritaModel->getTagsById($beritaKecelakaan['id_berita']);

        foreach ($data_tags_berita as $value) {
            if ($beritaKecelakaan['id_berita'] == $value['berita_id']) {
                $this->tagsBeritaModel->hapus_tags($value['id_tags_berita']);
            }
        }

        unlink('assets/images/resource_berita/' . $beritaKecelakaan['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/data_kecelakaan');
    }

    public function create_berita_politik()
    {
        $data = [
            'title' => 'My Admin | Create Berita Politik',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/create_berita_politik', $data);
    }

    public function proses_create_politik()
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
            return redirect()->to('/admin/create_berita_politik')->withInput();
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

        return redirect()->to('/admin/data_politik');
    }

    public function detail_politik($slug)
    {
        $detailPolitik = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => $detailPolitik['judul_berita'],
            'uri' => $this->uri,
            'detailPolitik' => $detailPolitik,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($detailPolitik['id_berita'], $detailPolitik['kategori_id']),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/detail_berita_politik', $data);
    }

    public function edit_berita_politik($slug)
    {
        $beritaPolitik = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'My Admin | Edit Berita Politik',
            'beritaPolitik' => $beritaPolitik,
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($beritaPolitik['id_berita'], $beritaPolitik['kategori_id']),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/edit_berita_politik', $data);
    }

    public function proses_edit_politik($id_berita)
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
                'label'  => 'Gambar Berita',
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
            return redirect()->to('/admin/edit_berita_politik/' . $this->request->getVar('slug'))->withInput();
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

        return redirect()->to('/admin/data_politik');
    }

    public function hapus_politik($slug)
    {
        $beritaPolitik = $this->beritaModel->getBeritaBySlug($slug);

        $data_tags_berita = $this->tagsBeritaModel->getTagsById($beritaPolitik['id_berita']);

        foreach ($data_tags_berita as $value) {
            if ($beritaPolitik['id_berita'] == $value['berita_id']) {
                $this->tagsBeritaModel->hapus_tags($value['id_tags_berita']);
            }
        }

        unlink('assets/images/resource_berita/' . $beritaPolitik['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/data_politik');
    }

    public function create_berita_ekonomi()
    {
        $data = [
            'title' => 'My Admin | Create Berita Ekonomi',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/create_berita_ekonomi', $data);
    }

    public function proses_create_ekonomi()
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
            return redirect()->to('/admin/create_berita_ekonomi')->withInput();
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

        return redirect()->to('/admin/data_ekonomi');
    }

    public function detail_ekonomi($slug)
    {
        $detailEkonomi = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => $detailEkonomi['judul_berita'],
            'uri' => $this->uri,
            'detailEkonomi' => $detailEkonomi,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($detailEkonomi['id_berita'], $detailEkonomi['kategori_id']),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/detail_berita_ekonomi', $data);
    }

    public function edit_berita_ekonomi($slug)
    {
        $beritaEkonomi = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'My Admin | Edit Berita Ekonomi',
            'beritaEkonomi' => $beritaEkonomi,
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($beritaEkonomi['id_berita'], $beritaEkonomi['kategori_id']),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/edit_berita_ekonomi', $data);
    }

    public function proses_edit_ekonomi($id_berita)
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
                'label'  => 'Gambar Berita',
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
            return redirect()->to('/admin/edit_berita_ekonomi/' . $this->request->getVar('slug'))->withInput();
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

        return redirect()->to('/admin/data_ekonomi');
    }

    public function hapus_ekonomi($slug)
    {
        $beritaEkonomi = $this->beritaModel->getBeritaBySlug($slug);

        $data_tags_berita = $this->tagsBeritaModel->getTagsById($beritaEkonomi['id_berita']);

        foreach ($data_tags_berita as $value) {
            if ($beritaEkonomi['id_berita'] == $value['berita_id']) {
                $this->tagsBeritaModel->hapus_tags($value['id_tags_berita']);
            }
        }

        unlink('assets/images/resource_berita/' . $beritaEkonomi['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/data_ekonomi');
    }

    public function create_berita_olahraga()
    {
        $data = [
            'title' => 'My Admin | Create Berita Olahraga',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/create_berita_olahraga', $data);
    }

    public function proses_create_olahraga()
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
            return redirect()->to('/admin/create_berita_olahraga')->withInput();
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

        return redirect()->to('/admin/data_olahraga');
    }

    public function detail_olahraga($slug)
    {
        $detailOlahraga = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => $detailOlahraga['judul_berita'],
            'uri' => $this->uri,
            'detailOlahraga' => $detailOlahraga,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($detailOlahraga['id_berita'], $detailOlahraga['kategori_id']),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/detail_berita_olahraga', $data);
    }

    public function edit_berita_olahraga($slug)
    {
        $beritaOlahraga = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'My Admin | Edit Berita Olahraga',
            'beritaOlahraga' => $beritaOlahraga,
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'data_tagline' => $this->taglineModel->getTaglineByIdBerita($beritaOlahraga['id_berita'], $beritaOlahraga['kategori_id']),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/edit_berita_olahraga', $data);
    }

    public function proses_edit_olahraga($id_berita)
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
                'label'  => 'Gambar Berita',
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
            return redirect()->to('/admin/edit_berita_olahraga/' . $this->request->getVar('slug'))->withInput();
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

        return redirect()->to('/admin/data_olahraga');
    }

    public function hapus_olahraga($slug)
    {
        $beritaOlahraga = $this->beritaModel->getBeritaBySlug($slug);

        $data_tags_berita = $this->tagsBeritaModel->getTagsById($beritaOlahraga['id_berita']);

        foreach ($data_tags_berita as $value) {
            if ($beritaOlahraga['id_berita'] == $value['berita_id']) {
                $this->tagsBeritaModel->hapus_tags($value['id_tags_berita']);
            }
        }

        unlink('assets/images/resource_berita/' . $beritaOlahraga['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/data_olahraga');
    }

    public function gagal_moderasi($slug)
    {
        $beritaGagalModerasi = $this->beritaModel->getBeritaBySlug($slug);

        $data_tags_berita = $this->tagsBeritaModel->getTagsById($beritaGagalModerasi['id_berita']);

        foreach ($data_tags_berita as $value) {
            if ($beritaGagalModerasi['id_berita'] == $value['berita_id']) {
                $this->tagsBeritaModel->hapus_tags($value['id_tags_berita']);
            }
        }

        unlink('assets/images/resource_berita/' . $beritaGagalModerasi['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berita Gagal Dimoderasi.');

        return redirect()->to('/admin/moderasi_berita');
    }

    public function gagal_moderasi_laporan($id_laporan)
    {
        $this->laporanModel->delete_laporan($id_laporan);

        session()->setFlashdata('success', 'Data Laporan Gagal Dimoderasi.');

        return redirect()->to('/admin/moderasi_laporan');
    }

    public function data_komentar()
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'My Admin | Data Komentar',
            'uri' => $this->uri,
            'data_komentar' => $this->komentarModel->orderBy('id_komentar', 'DESC')->paginate(10, 'tb_komentar'),
            'pager' => $this->komentarModel->pager,
            'currentPage' => $this->request->getVar('page_tb_komentar') ? $this->request->getVar('page_tb_komentar') : 1,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_komentar', $data);
    }

    public function detail_balas_komentar($id_komentar)
    {
        helper(['tanggal_helper']);

        $data = [
            'title' => 'My Admin | Data Balas Komentar',
            'uri' => $this->uri,
            'balasKomentar' => $this->balasModel->getBalasKomentarByKomentarId($id_komentar),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/detail_komentar', $data);
    }

    public function hapus_balas_komentar($id_komentar)
    {
        $this->balasModel->delete_balas($id_komentar);

        session()->setFlashdata('success', 'Balas Komentar Berhasil Dihapus.');

        return redirect()->to('/admin/data_komentar');
    }

    public function hapus_komentar($id_komentar)
    {
        $balas_komentar = $this->balasModel->getBalasKomentarByKomentarId($id_komentar);

        if ($balas_komentar) {
            foreach ($balas_komentar as $value) {
                $this->balasModel->delete_balas_komentar($value['komentar_id']);
            }

            $this->komentarModel->delete_komentar($id_komentar);

            session()->setFlashdata('success', 'Komentar Berhasil Dihapus.');

            return redirect()->to('/admin/data_komentar');
        } else {
            $this->komentarModel->delete_komentar($id_komentar);

            session()->setFlashdata('success', 'Komentar Berhasil Dihapus.');

            return redirect()->to('/admin/data_komentar');
        }
    }

    public function data_pembayaran()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->pembayaranModel->searchDataPembayaran($keyword);
        } else {
            $data_pembayaran = $this->pembayaranModel;
        }

        $data = [
            'title' => 'My Admin | Data Pembayaran',
            'uri' => $this->uri,
            'data_pembayaran' => $this->pembayaranModel->orderBy('id_pembayaran', 'DESC')->where('status_pembayaran', 'pending')->paginate(10, 'tb_pembayaran'),
            'pager' => $this->pembayaranModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_pembayaran', $data);
    }

    public function check_status_pembayaran($order_id)
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-vg0qvnm9Az97NxyMgEVIB6OR';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $status = \Midtrans\Transaction::status($order_id);

        if ($status->transaction_status == 'settlement') {
            $data_pembayaran = $this->pembayaranModel->getStatusPembayaran($order_id);

            $data_langganan = $this->jenisLanggananModel->getDataLanggananByName($data_pembayaran['nama_produk']);

            $builderPembayaran = $this->pembayaranModel->table('tb_pembayaran');

            $where_order_id = ['order_id' => $order_id];

            $dataUpdatePembayaran = [
                'status_pembayaran' => $status->transaction_status
            ];

            $builderPembayaran->set($dataUpdatePembayaran)
                ->where($where_order_id)
                ->update();

            $this->invoiceModel->save([
                'id_pembayaran' => $data_pembayaran['id_pembayaran'],
                'transaksi_id' => $data_pembayaran['transaksi_id'],
                'order_id' => $data_pembayaran['order_id'],
                'nama_pelanggan' => $data_pembayaran['nama_pelanggan'],
                'email' => $data_pembayaran['email'],
                'nama_produk' => $data_pembayaran['nama_produk'],
                'jenis_langganan' => $data_pembayaran['jenis_langganan'],
                'total_pembayaran' => $data_pembayaran['total_pembayaran'],
                'tipe_pembayaran' => $data_pembayaran['tipe_pembayaran'],
                'status_pembayaran' => $status->transaction_status,
                'tanggal_pembayaran' => $data_pembayaran['tanggal_pembayaran']
            ]);

            $this->pembayaranModel->delete_pembayaran_by_id($data_pembayaran['id_pembayaran']);

            $data_users = $this->akunModel->getUsersByEmail($data_pembayaran['email']);

            $builderUsers = $this->akunModel->table('users');

            $where_id = ['id' => $data_users['id']];

            $dataUpdateUsers = [
                'jenis_akun_id' => 2,
                'tanggal_expired' => Carbon::parse($data_pembayaran['tanggal_pembayaran'])->addDays($data_langganan['waktu_langganan']),
            ];

            $builderUsers->set($dataUpdateUsers)
                ->where($where_id)
                ->update();

            session()->setFlashdata('success', 'Status Pembayaran Berhasil Diubah.');

            return redirect()->to('/admin/data_pembayaran');
        } else if ($status->transaction_status == 'expire') {
            $this->pembayaranModel->delete_pembayaran($order_id);

            session()->setFlashdata('success', 'Token Pembayaran Telah Expired');

            return redirect()->to('/admin/data_pembayaran');
        } else {
            session()->setFlashdata('success', 'User Belum Melakukan Pembayaran');

            return redirect()->to('/admin/data_pembayaran');
        }
    }

    public function data_invoice()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->invoiceModel->searchDataInvoice($keyword);
        } else {
            $data_invoice = $this->invoiceModel;
        }

        $data = [
            'title' => 'My Admin | Data Invoice',
            'uri' => $this->uri,
            'data_invoice' => $this->invoiceModel->orderBy('id_invoice', 'DESC')->paginate(10, 'tb_invoice'),
            'pager' => $this->invoiceModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_invoice', $data);
    }

    public function detail_invoice($id_pembayaran)
    {
        helper(['tanggal_helper']);

        $data = [
            'data_invoice' => $this->invoiceModel->getInvoiceByPembayaranId($id_pembayaran),
            'uri' => $this->uri,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/pages/invoice_admin', $data);
    }

    public function create_data_admin()
    {
        $data = [
            'title' => 'My Admin | Create Data Admin',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/create_data_admin', $data);
    }

    public function proses_create_admin()
    {
        if (!$this->validate([
            'email'   => [
                'label'  => 'Email',
                'rules'  => 'required|is_unique[users.email]|valid_email',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'is_unique' => '{field} Anda Sudah Terdaftar!',
                    'valid_email' => 'Format {field} Anda Salah!',
                ]
            ],
            'username'   => [
                'label'  => 'Username',
                'rules'  => 'required|is_unique[users.username]|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'is_unique' => '{field} Anda Sudah Terdaftar!',
                    'min_length' => '{field} Minimal 5 Karakter!',
                    'max_length' => '{field} Maksimal 20 Karakter!',
                ]
            ],
            'fullname'   => [
                'label'  => 'Nama Lengkap',
                'rules'  => 'required|is_unique[users.fullname]|min_length[10]|max_length[50]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'is_unique' => '{field} Anda Sudah Terdaftar!',
                    'min_length' => '{field} Minimal 10 Karakter!',
                    'max_length' => '{field} Maksimal 50 Karakter!',
                ]
            ],
            'password_hash'   => [
                'label'  => 'Password',
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'min_length' => '{field} Minimal 8 Karakter!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/create_data_admin')->withInput();
        };

        $option = [
            'cost' => 10
        ];

        $this->userModel->save([
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'password_hash' => password_hash($this->request->getVar('password_hash'), PASSWORD_DEFAULT, $option),
            'jenis_akun_id' => 3,
            'active' => 1,
        ]);

        $users = $this->userModel->getUsersByEmail($this->request->getVar('email'));

        $this->authModel->save([
            'group_id' => 1,
            'user_id' => $users['id']
        ]);

        session()->setFlashdata('success', 'Data Admin Berhasil Disimpan.');

        return redirect()->to('/admin/admin');
    }

    public function hapus_users_premium($id)
    {
        $builder = $this->akunModel->table('users');

        $where = ['id' => $id];

        $data = [
            'jenis_akun_id' => 1,
            'tanggal_expired' => NULL
        ];

        $builder->set($data)
            ->where($where)
            ->update();

        return redirect()->to('/admin/user_free');
    }

    public function export_pdf_data_invoice()
    {
        $data_invoice = $this->invoiceModel->getDataInvoiceExport($this->request->getVar('tanggal'));

        if (empty($data_invoice)) {
            echo '<script>
                alert("Data Invoice Tidak Tersedia!");
                window.location.href = "/admin/data_invoice";
            </script';
        } else {
            $filename = $this->request->getVar('nama-file');
            $dompdf = new Dompdf();
            $dompdf->loadHtml(view('/pages/export_invoice', [
                'data_invoice' => $data_invoice,
                'periode' => tgl_indo_model_2(date($this->request->getVar('tanggal')))
            ]));
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream($filename);
        }
    }

    public function export_pdf_berita_kecelakaan()
    {
        $beritaKecelakaan = $this->beritaModel->getBeritaKecelakaanExport($this->request->getVar('tanggal'));

        if (empty($beritaKecelakaan)) {
            echo '<script>
                alert("Data Berita Kecelakaan Tidak Tersedia!");
                window.location.href = "/admin/data_kecelakaan";
            </script';
        } else {
            $filename = $this->request->getVar('nama-file');
            $dompdf = new Dompdf();
            $dompdf->loadHtml(view('/pages/export_kecelakaan', [
                'beritaKecelakaan' => $beritaKecelakaan,
                'periode' => tgl_indo_model_2(date($this->request->getVar('tanggal')))
            ]));
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream($filename);
        }
    }

    public function export_pdf_berita_ekonomi()
    {
        $beritaEkonomi = $this->beritaModel->getBeritaEkonomiExport($this->request->getVar('tanggal'));

        if (empty($beritaEkonomi)) {
            echo '<script>
                alert("Data Berita Ekonomi Tidak Tersedia!");
                window.location.href = "/admin/data_ekonomi";
            </script';
        } else {
            $filename = $this->request->getVar('nama-file');
            $dompdf = new Dompdf();
            $dompdf->loadHtml(view('/pages/export_ekonomi', [
                'beritaEkonomi' => $beritaEkonomi,
                'periode' => tgl_indo_model_2(date($this->request->getVar('tanggal')))
            ]));
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream($filename);
        }
    }

    public function export_pdf_berita_politik()
    {
        $beritaPolitik = $this->beritaModel->getBeritaPolitikExport($this->request->getVar('tanggal'));

        if (empty($beritaPolitik)) {
            echo '<script>
                alert("Data Berita Politik Tidak Tersedia!");
                window.location.href = "/admin/data_politik";
            </script';
        } else {
            $filename = $this->request->getVar('nama-file');
            $dompdf = new Dompdf();
            $dompdf->loadHtml(view('/pages/export_politik', [
                'beritaPolitik' => $beritaPolitik,
                'periode' => tgl_indo_model_2(date($this->request->getVar('tanggal')))
            ]));
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream($filename);
        }
    }

    public function export_pdf_berita_olahraga()
    {
        $beritaOlahraga = $this->beritaModel->getBeritaOlahragaExport($this->request->getVar('tanggal'));

        if (empty($beritaOlahraga)) {
            echo '<script>
                alert("Data Berita Olahraga Tidak Tersedia!");
                window.location.href = "/admin/data_olahraga";
            </script';
        } else {
            $filename = $this->request->getVar('nama-file');
            $dompdf = new Dompdf();
            $dompdf->loadHtml(view('/pages/export_olahraga', [
                'beritaOlahraga' => $beritaOlahraga,
                'periode' => tgl_indo_model_2(date($this->request->getVar('tanggal')))
            ]));
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream($filename);
        }
    }

    public function cetak_pdf($order_id)
    {
        $data_invoice = $this->invoiceModel->getInvoiceByOrderId($order_id);

        $filename = 'Laporan Invoice Order-ID #' . $order_id;
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('/pages/export_invoice1', [
            'data_invoice' => $data_invoice,
        ]));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }

    public function kategori_berita()
    {
        $data = [
            'title' => 'My Admin | Kategori Berita',
            'uri' => $this->uri,
            'data_kategori' => $this->kategoriModel->paginate(10, 'kategori_berita'),
            'currentPage' => $this->request->getVar('page_kategori_berita') ? $this->request->getVar('page_kategori_berita') : 1,
            'pager' => $this->kategoriModel->pager,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_kategori', $data);
    }

    public function hapus_kategori($id_kategori)
    {
        $this->kategoriModel->delete_kategori($id_kategori);

        session()->setFlashdata('success', 'Kategori Berita Berhasil Dihapus.');

        return redirect()->to('/admin/kategori_berita');
    }

    public function jenis_langganan()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->jenisLanggananModel->searchDataLangganan($keyword);
        } else {
            $data_langganan = $this->jenisLanggananModel;
        }

        $data = [
            'title' => 'My Admin | Jenis Langganan',
            'uri' => $this->uri,
            'data_jenis_langganan' => $this->jenisLanggananModel->paginate(10, 'jenis_langganan'),
            'currentPage' => $this->request->getVar('page_jenis_langganan') ? $this->request->getVar('page_jenis_langganan') : 1,
            'pager' => $this->jenisLanggananModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_jenis_langganan', $data);
    }

    public function create_jenis_langganan()
    {
        $data = [
            'title' => 'My Admin | Create Jenis Langganan',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/create_jenis_langganan', $data);
    }

    public function proses_create_jenis_langganan()
    {
        if (!$this->validate([
            'nama_langganan'   => [
                'label' => 'Nama Langganan',
                'rules'  => 'required|is_unique[jenis_langganan.nama_langganan]|max_length[8]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'is_unique' => '{field} Tersebut Sudah Digunakan!',
                    'max_length' => '{field} Maksimal 8 Karakter!'
                ]
            ],
            'jenis_langganan'   => [
                'label' => 'Jenis Langganan',
                'rules'  => 'required|max_length[30]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'max_length' => '{field} Maksimal 30 Karakter!'
                ]
            ],
            'waktu_langganan'   => [
                'label' => 'Waktu Langganan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                ]
            ],
            'harga_langganan'   => [
                'label' => 'Harga Langganan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/create_jenis_langganan')->withInput();
        }

        $waktuLangganan = explode('Hari', $this->request->getVar('waktu_langganan'));

        $this->jenisLanggananModel->save([
            'nama_langganan'   => $this->request->getVar('nama_langganan'),
            'jenis_langganan'  => $this->request->getVar('jenis_langganan'),
            'waktu_langganan'  => $waktuLangganan[0],
            'harga_langganan'  => $this->request->getVar('harga_langganan'),
        ]);

        session()->setFlashdata('success', 'Data Berhasil Disimpan.');

        return redirect()->to('/admin/jenis_langganan');
    }

    public function hapus_jenis_langganan($id_langganan)
    {
        $this->jenisLanggananModel->delete_jenis_langganan($id_langganan);

        session()->setFlashdata('success', 'Jenis Langganan Berhasil Dihapus.');

        return redirect()->to('/admin/jenis_langganan');
    }

    public function edit_jenis_langganan($id_langganan)
    {
        $data = [
            'title' => 'My Admin | Edit Jenis Langganan',
            'jenisLangganan' => $this->jenisLanggananModel->getDataLanggananById($id_langganan),
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/edit_jenis_langganan', $data);
    }

    public function proses_edit_jenis_langganan($id_langganan)
    {
        if (!$this->validate([
            'nama_langganan'   => [
                'label' => 'Nama Langganan',
                'rules'  => 'required|max_length[8]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'max_length' => '{field} Maksimal 8 Karakter!'
                ]
            ],
            'jenis_langganan'   => [
                'label' => 'Jenis Langganan',
                'rules'  => 'required|max_length[30]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'max_length' => '{field} Maksimal 30 Karakter!'
                ]
            ],
            'waktu_langganan'   => [
                'label' => 'Waktu Langganan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                ]
            ],
            'harga_langganan'   => [
                'label' => 'Harga Langganan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/edit_jenis_langganan/' . $id_langganan)->withInput();
        }

        $waktuLangganan = explode('Hari', $this->request->getVar('waktu_langganan'));

        $builder = $this->jenisLanggananModel->table('jenis_langganan');

        $data = [
            'nama_langganan'   => $this->request->getVar('nama_langganan'),
            'jenis_langganan'  => $this->request->getVar('jenis_langganan'),
            'waktu_langganan'  => $waktuLangganan[0],
            'harga_langganan'  => $this->request->getVar('harga_langganan'),
        ];

        $where = ['id_langganan' => $id_langganan];

        $builder->set($data)
            ->where($where)
            ->update();

        session()->setFlashdata('success', 'Data Berhasil Diedit.');

        return redirect()->to('/admin/jenis_langganan');
    }

    public function laporan_masyarakat()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->laporanModel->searchDataLaporan($keyword);
        } else {
            $data_laporan = $this->laporanModel;
        }

        $data = [
            'title' => 'My Admin | Laporan Masyarakat',
            'uri' => $this->uri,
            'data_laporan' => $this->laporanModel->where('status_laporan', 1)->orderBy('id_laporan', 'DESC')->paginate(10, 'tb_laporan_masyarakat'),
            'currentPage' => $this->request->getVar('page_tb_laporan_masyarakat') ? $this->request->getVar('page_tb_laporan_masyarakat') : 1,
            'pager' => $this->laporanModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_laporan', $data);
    }

    public function hapus_laporan($id_laporan)
    {
        $this->laporanModel->delete_laporan($id_laporan);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/laporan_masyarakat');
    }

    public function tagline()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->taglineModel->searchDataTagline($keyword);
        } else {
            $data_tagline = $this->taglineModel;
        }

        $data = [
            'title' => 'My Admin | Tagline Berita',
            'uri' => $this->uri,
            'data_tagline' => $this->taglineModel->orderBy('id_tags', 'DESC')->paginate(10, 'tags'),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'currentPage' => $this->request->getVar('page_tags') ? $this->request->getVar('page_tags') : 1,
            'pager' => $this->taglineModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/data_tagline', $data);
    }

    public function create_tagline()
    {
        $data = [
            'title' => 'My Admin | Create Tagline Berita',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/create_tagline_berita', $data);
    }

    public function proses_create_tagline_berita()
    {
        if (!$this->validate([
            'nama_tags'   => [
                'label' => 'Nama Tagline',
                'rules'  => 'required|is_unique[tags.nama_tags]|max_length[50]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'is_unique' => '{field} Tersebut Sudah Digunakan!',
                    'max_length' => '{field} Maksimal 50 Karakter!'
                ]
            ],
        ])) {
            return redirect()->to('/admin/create_tagline')->withInput();
        }

        $this->taglineModel->save([
            'nama_tags'   => $this->request->getVar('nama_tags'),
            'kategori_id'  => $this->request->getVar('kategori_id'),
        ]);

        session()->setFlashdata('success', 'Data Berhasil Disimpan.');

        return redirect()->to('/admin/tagline');
    }

    public function edit_tagline($id_tags)
    {
        $data = [
            'title' => 'My Admin | Edit Tagline Berita',
            'data_tagline' => $this->taglineModel->getTaglineById($id_tags),
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'kategoriBerita' => $this->kategoriModel->findAll(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
            'notifikasi_akun_premium' => $this->akunModel->getUsersPremium(date('Y-m-d H:i:s'))
        ];

        return view('/admin/edit_tagline_berita', $data);
    }

    public function proses_edit_tagline_berita($id_tags)
    {
        if (!$this->validate([
            'nama_tags'   => [
                'label' => 'Nama Tagline',
                'rules'  => 'required|max_length[20]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!',
                    'max_length' => '{field} Maksimal 20 Karakter!'
                ]
            ],
        ])) {
            return redirect()->to('/admin/edit_tagline/' . $id_tags)->withInput();
        }

        $builder = $this->taglineModel->table('tags');

        $data = [
            'nama_tags'   => $this->request->getVar('nama_tags'),
            'kategori_id' => $this->request->getVar('kategori_id'),
        ];

        $where = ['id_tags' => $id_tags];

        $builder->set($data)
            ->where($where)
            ->update();

        session()->setFlashdata('success', 'Data Berhasil Diedit.');

        return redirect()->to('/admin/tagline');
    }

    public function hapus_tagline($id_tags)
    {
        $data_tags_berita = $this->tagsBeritaModel->getTagsByTagId($id_tags);

        foreach ($data_tags_berita as $value) {
            if ($value['tags_id'] == $id_tags) {
                $this->tagsBeritaModel->hapus_tags($value['id_tags_berita']);
            }
        }

        $this->taglineModel->delete_tagline($id_tags);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/tagline');
    }
}
