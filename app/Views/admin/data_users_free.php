<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Users Free</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="/ekonomi/create" class="badge badge-primary">Add Post</a></div>
                <div class="breadcrumb-item"><a href="/ekonomi/export" class="badge badge-info">Export Excel</a></div>
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
                            foreach ($data_users_free as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $value['judul_berita']; ?></td>
                                    <td class="text-center"><?= $value['created_by']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($value['kategori_id'] == 2) {
                                            echo 'Ekonomi';
                                        }
                                        ?>
                                    </td>
                                    <td style="width: 15%;" class="text-center">
                                        <a href="/ekonomi/detail/<?= $value['slug']; ?>" class="btn btn-success"><i class="fas fa-info-circle"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?= $pager->links('tb_berita', 'pagination_data_ekonomi'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>