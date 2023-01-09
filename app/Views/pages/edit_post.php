<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="flash-news-banner">
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash News</span>
                <marquee class="mb-0" direction="right">
                    <?= $data_laporan['isi_pesan']; ?>
                </marquee>
            </div>
            <div class="d-flex">
                <span class="mr-3 text-danger">
                    <?= tgl_indo_sekarang(date("Y-m-d")); ?>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card" data-aos="fade-up">
                    <div class="card-body">
                        <h1 class="mt-3 text-center mb-5">
                            Edit Post Berita
                        </h1>

                        <div class="table-responsive">
                            <table class="table table-bordered table-md table-striped">
                                <tr class="text-center">
                                    <th scope="col">No.</th>
                                    <th scope="col">Judul Berita</th>
                                    <th scope="col">Penulis Berita</th>
                                    <th scope="col">Kategori Berita</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                <?php
                                $no = 1 + (10 * ($currentPage - 1));
                                foreach ($data_postku as $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $value['judul_berita']; ?></td>
                                        <td class="text-center"><?= $value['created_by']; ?></td>
                                        <td class="text-center">
                                            <?php if ($value['kategori_id'] == 1) {
                                                echo 'Kecelakaan';
                                            } elseif ($value['kategori_id'] == 2) {
                                                echo 'Ekonomi';
                                            } elseif ($value['kategori_id'] == 3) {
                                                echo 'Politik';
                                            } elseif ($value['kategori_id'] == 4) {
                                                echo 'Olahraga';
                                            } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="/home/tambah_data_berita" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a>
                                            <a href="/home/edit_data_berita/<?= $value['slug']; ?>" class="btn btn-warning btn-sm ml-1"><i class="fas fa-pencil-alt text-white"></i></a>
                                            <a href="/home/hapus_berita/<?= $value['slug']; ?>" class="btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <?= $pager->links('tb_berita', 'pagination_data_berita_premium'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>