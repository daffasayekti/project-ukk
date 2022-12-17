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

use App\Models\LaporanModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Carbon\Carbon;

class Admin extends BaseController
{
    protected $beritaModel;
    protected $loginsModel;
    protected $usersModel;
    protected $akunModel;
    protected $invoiceModel;
    protected $komentarModel;
    protected $pembayaranModel;
    protected $laporanModel;
    protected $uri;
    protected $carbon;
    protected $jenisLanggananModel;
    protected $helpers = ['tanggal_helper', 'auth'];

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->loginsModel = new LoginsModel();
        $this->usersModel  = new UsersModel();
        $this->akunModel   = new AkunModel();
        $this->komentarModel = new KomentarModel();
        $this->invoiceModel = new InvoiceModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->laporanModel = new LaporanModel();
        $this->carbon = new Carbon();
        $this->jenisLanggananModel  = new JenisLanggananModel();
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
            'title' => 'Dashboard Admin',
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
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
            'title' => 'Moderasi Berita',
            'uri' => $this->uri,
            'data_berita_moderasi' => $this->beritaModel->where('status_berita', 0)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'keyword' => $keyword,
            'pager' => $this->beritaModel->pager,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
            'title' => 'Moderasi Laporan',
            'uri' => $this->uri,
            'data_laporan_moderasi' => $this->laporanModel->where('status_laporan', 0)->orderBy('id_laporan', 'DESC')->paginate(10, 'tb_laporan_masyarakat'),
            'currentPage' => $this->request->getVar('page_tb_laporan_masyarakat') ? $this->request->getVar('page_tb_laporan_masyarakat') : 1,
            'keyword' => $keyword,
            'pager' => $this->laporanModel->pager,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
        $data = [
            'title' => 'Detail Berita',
            'uri' => $this->uri,
            'detail_berita' => $this->beritaModel->getBeritaBySlug($slug),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
            'uri' => $this->uri,
            'data_berita' => $this->beritaModel->where('kategori_id', 1)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
            'uri' => $this->uri,
            'data_berita' => $this->beritaModel->where('kategori_id', 3)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
            'uri' => $this->uri,
            'data_berita' => $this->beritaModel->where('kategori_id', 2)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
            'title' => 'Data Berita Olahraga',
            'uri' => $this->uri,
            'data_berita' => $this->beritaModel->where('kategori_id', 4)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
            'title' => 'Data Users Free',
            'uri' => $this->uri,
            'data_users_free' => $this->akunModel->where('jenis_akun_id', 1)->orderBy('id', 'DESC')->paginate(10, 'users'),
            'currentPage' => $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1,
            'pager' => $this->akunModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
            'title' => 'Data Users Premium',
            'uri' => $this->uri,
            'data_users_premium' => $this->akunModel->where('jenis_akun_id', 2)->orderBy('id', 'DESC')->paginate(10, 'users'),
            'currentPage' => $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1,
            'pager' => $this->akunModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
            'title' => 'Data Admin',
            'uri' => $this->uri,
            'data_admin' => $this->akunModel->where('jenis_akun_id', 3)->orderBy('id', 'DESC')->paginate(10, 'users'),
            'currentPage' => $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1,
            'pager' => $this->akunModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/data_admin', $data);
    }

    public function hapus_admin($id)
    {
        $this->akunModel->delete_akun($id);

        session()->setFlashdata('success', 'Akun Berhasil Dihapus.');

        return redirect()->to('/admin/admin');
    }

    public function export_berita_kecelakaan()
    {
        $beritaKecelakaan = $this->beritaModel->getBeritaKecelakaanExport();

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
        header('Content-disposition: attachment;filename=data_berita_kecelakaan.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

    public function export_berita_ekonomi()
    {
        $beritaEkonomi = $this->beritaModel->getBeritaEkonomiExport();

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
        header('Content-disposition: attachment;filename=data_berita_ekonomi.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

    public function export_berita_politik()
    {
        $beritaPolitik = $this->beritaModel->getBeritaPolitikExport();

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
        header('Content-disposition: attachment;filename=data_berita_politik.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

    public function export_berita_olahraga()
    {
        $beritaOlahraga = $this->beritaModel->getBeritaOlahragaExport();

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
        header('Content-disposition: attachment;filename=data_berita_olahraga.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

    public function create_berita_kecelakaan()
    {
        $data = [
            'title' => 'Create Berita Kecelakaan',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/create_berita_kecelakaan', $data);
    }

    public function proses_create_kecelakaan()
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label'  => 'Judul Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'created_by'   => [
                'label'  => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar_berita'   => [
                'label'  => 'Gambar Berita',
                'rules'  => 'uploaded[gambar_berita]|max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,/image/png]',
                'errors' => [
                    'uploaded' => 'Pilih {field} terlebih dahulu!',
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in'  => 'Yang anda pilih bukan gambar!'
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
        ]);

        session()->setFlashdata('success', 'Data Berhasil Disimpan.');

        return redirect()->to('/admin/data_kecelakaan');
    }

    public function detail_kecelakaan($slug)
    {
        $detailKecelakaan = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Detail Berita Kecelakaan',
            'uri' => $this->uri,
            'detailKecelakaan' => $detailKecelakaan,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/detail_berita_kecelakaan', $data);
    }

    public function edit_berita_kecelakaan($slug)
    {
        $beritaKecelakaan = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Edit Berita Kecelakaan',
            'uri' => $this->uri,
            'beritaKecelakaan' => $beritaKecelakaan,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/edit_berita_kecelakaan', $data);
    }

    public function proses_edit_kecelakaan($id_berita)
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label'  => 'Judul Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'created_by'   => [
                'label'  => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar_berita'   => [
                'label'  => 'Gambar Berita',
                'rules'  => 'max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,/image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in'  => 'Yang anda pilih bukan gambar!'
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
            unlink('images/resource_berita/' . $this->request->getVar('gambarLamaBerita'));
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
        ];

        $where = ['id_berita' => $id_berita];

        $builder->set($data)
            ->where($where)
            ->update();

        session()->setFlashdata('success', 'Data Berhasil Diedit.');

        return redirect()->to('/admin/data_kecelakaan');
    }

    public function hapus_kecelakaan($slug)
    {
        $beritaKecelakaan = $this->beritaModel->getBeritaBySlug($slug);

        unlink('assets/images/resource_berita/' . $beritaKecelakaan['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/data_kecelakaan');
    }

    public function create_berita_politik()
    {
        $data = [
            'title' => 'Create Berita Politik',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/create_berita_politik', $data);
    }

    public function proses_create_politik()
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label'  => 'Judul Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'created_by'   => [
                'label'  => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar_berita'   => [
                'label'  => 'Gambar Berita',
                'rules'  => 'uploaded[gambar_berita]|max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,/image/png]',
                'errors' => [
                    'uploaded' => 'Pilih {field} terlebih dahulu!',
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in'  => 'Yang anda pilih bukan gambar!'
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
        ]);

        session()->setFlashdata('success', 'Data Berhasil Disimpan.');

        return redirect()->to('/admin/data_politik');
    }

    public function detail_politik($slug)
    {
        $detailPolitik = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Detail Berita Politik',
            'uri' => $this->uri,
            'detailPolitik' => $detailPolitik,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/detail_berita_politik', $data);
    }

    public function edit_berita_politik($slug)
    {
        $beritaPolitik = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Edit Berita Politik',
            'beritaPolitik' => $beritaPolitik,
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/edit_berita_politik', $data);
    }

    public function proses_edit_politik($id_berita)
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label'  => 'Judul Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'created_by'   => [
                'label'  => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar_berita'   => [
                'label'  => 'Gambar Berita',
                'rules'  => 'max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,/image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in'  => 'Yang anda pilih bukan gambar!'
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
            unlink('images/resource_berita/' . $this->request->getVar('gambarLamaBerita'));
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
        ];

        $where = ['id_berita' => $id_berita];

        $builder->set($data)
            ->where($where)
            ->update();

        session()->setFlashdata('success', 'Data Berhasil Diedit.');

        return redirect()->to('/admin/data_politik');
    }

    public function hapus_politik($slug)
    {
        $beritaPolitik = $this->beritaModel->getBeritaBySlug($slug);

        unlink('assets/images/resource_berita/' . $beritaPolitik['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/data_politik');
    }

    public function create_berita_ekonomi()
    {
        $data = [
            'title' => 'Create Berita Ekonomi',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/create_berita_ekonomi', $data);
    }

    public function proses_create_ekonomi()
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label'  => 'Judul Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'created_by'   => [
                'label'  => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar_berita'   => [
                'label'  => 'Gambar Berita',
                'rules'  => 'uploaded[gambar_berita]|max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,/image/png]',
                'errors' => [
                    'uploaded' => 'Pilih {field} terlebih dahulu!',
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in'  => 'Yang anda pilih bukan gambar!'
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
        ]);

        session()->setFlashdata('success', 'Data Berhasil Disimpan.');

        return redirect()->to('/admin/data_ekonomi');
    }

    public function detail_ekonomi($slug)
    {
        $detailEkonomi = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Detail Berita Ekonomi',
            'uri' => $this->uri,
            'detailEkonomi' => $detailEkonomi,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/detail_berita_ekonomi', $data);
    }

    public function edit_berita_ekonomi($slug)
    {
        $beritaEkonomi = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Edit Berita Ekonomi',
            'beritaEkonomi' => $beritaEkonomi,
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/edit_berita_ekonomi', $data);
    }

    public function proses_edit_ekonomi($id_berita)
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label'  => 'Judul Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'created_by'   => [
                'label'  => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar_berita'   => [
                'label'  => 'Gambar Berita',
                'rules'  => 'max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,/image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in'  => 'Yang anda pilih bukan gambar!'
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
            unlink('images/resource_berita/' . $this->request->getVar('gambarLamaBerita'));
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
        ];

        $where = ['id_berita' => $id_berita];

        $builder->set($data)
            ->where($where)
            ->update();

        session()->setFlashdata('success', 'Data Berhasil Diedit.');

        return redirect()->to('/admin/data_ekonomi');
    }

    public function hapus_ekonomi($slug)
    {
        $beritaEkonomi = $this->beritaModel->getBeritaBySlug($slug);

        unlink('assets/images/resource_berita/' . $beritaEkonomi['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/data_ekonomi');
    }

    public function create_berita_olahraga()
    {
        $data = [
            'title' => 'Create Berita Olahraga',
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/create_berita_olahraga', $data);
    }

    public function proses_create_olahraga()
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label'  => 'Judul Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'created_by'   => [
                'label'  => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar_berita'   => [
                'label'  => 'Gambar Berita',
                'rules'  => 'uploaded[gambar_berita]|max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,/image/png]',
                'errors' => [
                    'uploaded' => 'Pilih {field} terlebih dahulu!',
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in'  => 'Yang anda pilih bukan gambar!'
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
        ]);

        session()->setFlashdata('success', 'Data Berhasil Disimpan.');

        return redirect()->to('/admin/data_olahraga');
    }

    public function detail_olahraga($slug)
    {
        $detailOlahraga = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Detail Berita Olahraga',
            'uri' => $this->uri,
            'detailOlahraga' => $detailOlahraga,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/detail_berita_olahraga', $data);
    }

    public function edit_berita_olahraga($slug)
    {
        $beritaOlahraga = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Edit Berita Olahraga',
            'beritaOlahraga' => $beritaOlahraga,
            'uri' => $this->uri,
            'validation' => \Config\Services::validation(),
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/edit_berita_olahraga', $data);
    }

    public function proses_edit_olahraga($id_berita)
    {
        if (!$this->validate([
            'judul_berita'   => [
                'label'  => 'Judul Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'created_by'   => [
                'label'  => 'Penulis Berita',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar_berita'   => [
                'label'  => 'Gambar Berita',
                'rules'  => 'max_size[gambar_berita,1024]|is_image[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,/image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in'  => 'Yang anda pilih bukan gambar!'
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
            unlink('images/resource_berita/' . $this->request->getVar('gambarLamaBerita'));
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
        ];

        $where = ['id_berita' => $id_berita];

        $builder->set($data)
            ->where($where)
            ->update();

        session()->setFlashdata('success', 'Data Berhasil Diedit.');

        return redirect()->to('/admin/data_olahraga');
    }

    public function hapus_olahraga($slug)
    {
        $beritaOlahraga = $this->beritaModel->getBeritaBySlug($slug);

        unlink('assets/images/resource_berita/' . $beritaOlahraga['gambar_berita']);

        $this->beritaModel->delete_berita($slug);

        session()->setFlashdata('success', 'Data Berhasil Dihapus.');

        return redirect()->to('/admin/data_olahraga');
    }

    public function gagal_moderasi($slug)
    {
        $beritaGagalModerasi = $this->beritaModel->getBeritaBySlug($slug);

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
            'title' => 'Data Komentar',
            'uri' => $this->uri,
            'data_komentar' => $this->komentarModel->orderBy('id_komentar', 'DESC')->paginate(10, 'tb_komentar'),
            'pager' => $this->komentarModel->pager,
            'currentPage' => $this->request->getVar('page_tb_komentar') ? $this->request->getVar('page_tb_komentar') : 1,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/data_komentar', $data);
    }

    public function hapus_komentar($id_komentar)
    {
        $this->komentarModel->delete_komentar($id_komentar);

        session()->setFlashdata('success', 'Komentar Berhasil Dihapus.');

        return redirect()->to('/admin/data_komentar');
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
            'title' => 'Data Pembayaran',
            'uri' => $this->uri,
            'data_pembayaran' => $this->pembayaranModel->orderBy('id_pembayaran', 'DESC')->where('status_pembayaran', 'pending')->orWhere('status_pembayaran', 'expire')->paginate(10, 'tb_pembayaran'),
            'pager' => $this->pembayaranModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
        ];

        return view('/admin/data_pembayaran', $data);
    }

    public function hapus_data_pembayaran($order_id)
    {
        $this->pembayaranModel->delete_pembayaran($order_id);

        session()->setFlashdata('success', 'Data Pembayaran Berhasil Dihapus.');

        return redirect()->to('/admin/data_pembayaran');
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
        } else {
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
            'title' => 'Data Invoice',
            'uri' => $this->uri,
            'data_invoice' => $this->invoiceModel->orderBy('id_invoice', 'DESC')->paginate(10, 'tb_invoice'),
            'pager' => $this->invoiceModel->pager,
            'keyword' => $keyword,
            'notifikasi_berita' => $this->beritaModel->getNotifikasiBerita(),
            'notifikasi_pembayaran' => $this->pembayaranModel->getNotifikasiPembayaran(),
            'notifikasi_laporan' => $this->laporanModel->getNotifikasiLaporan(),
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
        ];

        return view('/pages/invoice', $data);
    }
}
