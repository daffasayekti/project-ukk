<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Invoice</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <button class="btn btn-info btn-sm px-3" data-target="#export-data" data-toggle="modal" style="border-radius: 30px;">Export Data</button>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header justify-content-end">
                    <form action="" method="get" autocomplete="off">
                        <div class="float-left">
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Nama Pemesan" autocomplete="off">
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
                                <th>Order ID</th>
                                <th>Nama Pemesan</th>
                                <th>Nama Produk</th>
                                <th>Status Pembayaran</th>
                                <th>Total Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            foreach ($data_invoice as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $value['order_id']; ?></td>
                                    <td class="text-center"><?= $value['nama_pelanggan']; ?></td>
                                    <td class="text-center">Layanan <?= $value['nama_produk']; ?></td>
                                    <td class="text-center"><?= $value['status_pembayaran']; ?></td>
                                    <td class="text-center">Rp. <?= number_format($value['total_pembayaran'], 0, ",", "."); ?></td>
                                    <td class="text-center">
                                        <a href="/admin/detail_invoice/<?= $value['id_pembayaran']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-save"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <?php if (empty($data_invoice)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Data Invoice Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('tb_invoice', 'pagination_data_invoice'); ?>
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
                <h5 class="modal-title">Export Data Invoice</h5>
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
            document.getElementById('form-download').action = '/admin/export_excel_data_invoice';
        } else if (tipeFile === 'pdf') {
            document.getElementById('ekstensi').innerHTML = '.pdf';
            document.getElementById('download').innerHTML = 'Download PDF';
            document.getElementById('form-download').action = '/admin/export_pdf_data_invoice';
        } else {
            document.getElementById('ekstensi').innerHTML = '-';
            document.getElementById('download').innerHTML = 'Download';
            document.getElementById('form-download').action = '';
        }
    })
</script>
<?= $this->endSection(); ?>