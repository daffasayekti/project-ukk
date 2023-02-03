<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Masyarakat</h1>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class=" alert alert-success alert-dismissible show fade">
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
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Judul Laporan" autocomplete="off">
                        </div>
                        <div class="float-right ml-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm table-striped">
                        <table class="table table-bordered table-md" id="table">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Isi Laporan</th>
                                <th>Nama Pengirim</th>
                                <th>Tanggal Laporan</th>
                                <th>Aksi</th>
                            </tr>

                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_laporan as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $value['isi_pesan']; ?></td>
                                    <td class="text-center">
                                        <?= $value['nama_pengirim']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= tgl_indo_model_2(date($value['tanggal_laporan'])); ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/hapus_laporan/<?= $value['id_laporan']; ?>" class="btn btn-danger ml-1 btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Laporan Tersebut ?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <?php if (empty($data_laporan)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Data Laporan Masyarakat Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('tb_laporan_masyarakat', 'pagination_data_laporan'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>