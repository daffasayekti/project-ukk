<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Moderasi Berita</h1>
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
                        <table class="table table-bordered table-md" id="table">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Judul Berita</th>
                                <th>Status Berita</th>
                                <th>Kategori Berita</th>
                                <th>Aksi</th>
                            </tr>

                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_berita_moderasi as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?>.</td>
                                    <td><?= $value['judul_berita']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($value['status_berita'] == 0) {
                                            echo 'Belum Aktif';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($value['kategori_id'] == 1) {
                                            echo 'Kecelakaan';
                                        } else if ($value['kategori_id'] == 2) {
                                            echo 'Ekonomi';
                                        } else if ($value['kategori_id'] == 3) {
                                            echo 'Politik';
                                        } else if ($value['kategori_id'] == 4) {
                                            echo 'Olahraga';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/detail_berita_moderasi/<?= $value['slug']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-info-circle"></i></a>
                                        <a href="/admin/proses_moderasi/<?= $value['id_berita']; ?>" class="btn btn-success ml-1 btn-sm"><i class="fas fa-check-circle"></i></a>
                                        <a href="/admin/gagal_moderasi/<?= $value['slug']; ?>" class="btn btn-danger ml-1 btn-sm"><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?= $pager->links('tb_berita', 'pagination_data_moderasi'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>