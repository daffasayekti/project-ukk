<?php

namespace App\Controllers;

use App\Models\BeritaModel;

use App\Models\LoginsModel;

use App\Models\UsersModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $this->usersModel  = new UsersModel();
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
            'title' => 'Dashboard Admin',
            'data_users_login' => $this->loginsModel->where('success', 1)->orderBy('id', 'DESC')->paginate(10, 'auth_logins'),
            'pager' => $this->loginsModel->pager,
            'currentPage' => $this->request->getVar('page_auth_logins') ? $this->request->getVar('page_auth_logins') : 1,
            'keyword' => $keyword,
            'count_politik' => $this->beritaModel->countPolitik(),
            'count_olahraga' => $this->beritaModel->countOlahraga(),
            'count_kecelakaan' => $this->beritaModel->countKecelakaan(),
            'count_ekonomi' => $this->beritaModel->countEkonomi(),

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
            'data_berita_moderasi' => $this->beritaModel->where('status_berita', 0)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'keyword' => $keyword,
            'pager' => $this->beritaModel->pager,
        ];

        return view('/admin/moderasi_data', $data);
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
        return redirect()->to('/admin/moderasi_berita');
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
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->beritaModel->searchDataBeritaOlahraga($keyword);
        } else {
            $data_berita_olahraga = $this->beritaModel;
        }

        $data = [
            'title' => 'Data Berita Olahraga',
            'data_berita' => $this->beritaModel->where('kategori_id', 4)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
        ];

        return view('/admin/data_olahraga', $data);
    }

    public function user_free()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->beritaModel->searchDataBeritaEkonomi($keyword);
        } else {
            $data_berita_ekonomi = $this->beritaModel;
        }

        $data = [
            'title' => 'Data Users Free',
            'data_users_free' => $this->beritaModel->where('kategori_id', 2)->where('status_berita', 1)->orderBy('id_berita', 'DESC')->paginate(10, 'tb_berita'),
            'currentPage' => $this->request->getVar('page_tb_berita') ? $this->request->getVar('page_tb_berita') : 1,
            'pager' => $this->beritaModel->pager,
            'keyword' => $keyword,
        ];

        return view('/admin/data_users_free', $data);
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
            'validation' => \Config\Services::validation(),
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
            'detailKecelakaan' => $detailKecelakaan
        ];

        return view('/admin/detail_berita_kecelakaan', $data);
    }

    public function edit_berita_kecelakaan($slug)
    {
        $beritaKecelakaan = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Edit Berita Kecelakaan',
            'beritaKecelakaan' => $beritaKecelakaan,
            'validation' => \Config\Services::validation(),
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
            'validation' => \Config\Services::validation(),
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
            'detailPolitik' => $detailPolitik
        ];

        return view('/admin/detail_berita_politik', $data);
    }

    public function edit_berita_politik($slug)
    {
        $beritaPolitik = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Edit Berita Politik',
            'beritaPolitik' => $beritaPolitik,
            'validation' => \Config\Services::validation(),
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
            'validation' => \Config\Services::validation(),
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
            'detailEkonomi' => $detailEkonomi
        ];

        return view('/admin/detail_berita_ekonomi', $data);
    }

    public function edit_berita_ekonomi($slug)
    {
        $beritaEkonomi = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Edit Berita Ekonomi',
            'beritaEkonomi' => $beritaEkonomi,
            'validation' => \Config\Services::validation(),
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
            'validation' => \Config\Services::validation(),
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
            'detailOlahraga' => $detailOlahraga
        ];

        return view('/admin/detail_berita_olahraga', $data);
    }

    public function edit_berita_olahraga($slug)
    {
        $beritaOlahraga = $this->beritaModel->getBeritaBySlug($slug);

        $data = [
            'title' => 'Edit Berita Olahraga',
            'beritaOlahraga' => $beritaOlahraga,
            'validation' => \Config\Services::validation(),
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

        session()->setFlashdata('success', 'Data Gagal Dimoderasi.');

        return redirect()->to('/admin/moderasi_berita');
    }
}
