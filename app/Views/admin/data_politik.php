<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Berita Politik</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="/admin/create_berita_politik" class="badge badge-primary py-lg-2" style="box-shadow:0 2px 6px #6777ef">Add Post</a></div>
                <div class="breadcrumb-item">
                    <button class="btn btn-info btn-sm px-3" data-target="#export-data" data-toggle="modal" style="border-radius: 30px;">Export Data</button>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>Success!</b> <?= session()->getFlashData('success'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="section-body">
            <div class="card">
                <div class="card-header justify-content-end">
                    <form action="" method="get" autocomplete="off">
                        <div class="float-left">
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Judul Berita" autocomplete="off">
                        </div>
                        <div class="float-right ml-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm table-striped">
                        <table class="table table-bordered table-md">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Judul Berita</th>
                                <th>Penulis Berita</th>
                                <th>Kategori Berita</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_berita as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $value['judul_berita']; ?></td>
                                    <td class="text-center"><?= $value['created_by']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($value['kategori_id'] == 3) {
                                            echo 'Politik';
                                        }
                                        ?>
                                    </td>
                                    <td style="width: 15%;" class="text-center">
                                        <a href="/admin/detail_politik/<?= $value['slug']; ?>" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="/admin/edit_berita_politik/<?= $value['slug']; ?>" class="btn btn-warning btn-sm ml-1"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="/admin/hapus_politik/<?= $value['slug']; ?>" class="btn btn-danger btn-sm ml-1 hapus-politik"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php if (empty($data_berita)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Data Berita Politik Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('tb_berita', 'pagination_data_politik'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="export-data">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Data Politik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="form-download">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Export</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-file-download"></i>
                                </div>
                            </div>
                            <select class="custom-select" name="tipe-file" id="tipe-file">
                                <option selected>-- Pilih Tipe File --</option>
                                <option value="excel">File Excel</option>
                                <option value="pdf">File PDF</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama File</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama-file" id="nama-file" required autocomplete="off">
                            <div class="input-group-prepend">
                                <div class="input-group-text" id="ekstensi">
                                    -
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="download">Download</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('tipe-file').addEventListener('change', function() {
        var tipeFile = document.getElementById('tipe-file').value;

        if (tipeFile === 'excel') {
            document.getElementById('ekstensi').innerHTML = '.xlsx';
            document.getElementById('download').innerHTML = 'Download Excel';
            document.getElementById('form-download').action = '/admin/export_excel_berita_politik';
        } else if (tipeFile === 'pdf') {
            document.getElementById('ekstensi').innerHTML = '.pdf';
            document.getElementById('download').innerHTML = 'Download PDF';
            document.getElementById('form-download').action = '/admin/export_pdf_berita_politik';
        } else {
            document.getElementById('ekstensi').innerHTML = '-';
            document.getElementById('download').innerHTML = 'Download';
            document.getElementById('form-download').action = '';
        }
    })
</script>

<script>
    const hapusPolitik = document.querySelectorAll(".hapus-politik")

    for (let i = 0; i < hapusPolitik.length; i++) {
        hapusPolitik[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menghapus Berita Politik Tersebut ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        })
    }
</script>
<?= $this->endSection(); ?>