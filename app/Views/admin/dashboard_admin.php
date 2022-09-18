<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body" style="font-size: 16px;">
                                <?= $count_users; ?> Users
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Berita Politik</h4>
                            </div>
                            <div class="card-body" style="font-size: 16px;">
                                <?= $count_politik; ?> Berita
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-car-crash"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kecelakaan</h4>
                            </div>
                            <div class="card-body" style="font-size: 16px;">
                                <?= $count_kecelakaan; ?> Berita
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Berita Ekonomi</h4>
                            </div>
                            <div class="card-body" style="font-size: 16px;">
                                <?= $count_ekonomi; ?> Berita
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Users Login</h4>
                </div>
                <div class="card-header justify-content-end">
                    <form action="" method="get" autocomplete="off">
                        <div class="float-left">
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Email" autocomplete="off">
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
                                <th>Email</th>
                                <th>Waktu Login</th>
                            </tr>

                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_users_login as $value) :
                            ?>
                                <tr class="text-center">
                                    <td><?= $no++; ?>.</td>
                                    <td><?= $value['email']; ?></td>
                                    <td><?= tgl_indo_model_1(date($value['date'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?= $pager->links('auth_logins', 'pagination_users_login'); ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Berita Yang Belum Dimoderasi</h4>
                </div>
                <div class="card-header justify-content-end">
                    <form action="" method="get" autocomplete="off">
                        <div class="float-left">
                            <input type="text" name="keyword1" value="<?= $keyword1; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Judul Berita" autocomplete="off">
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
                                <th>Aksi</th>
                            </tr>

                            <?php
                            $no = 1 + (10 * ($currentPage1 - 1));
                            foreach ($data_berita_moderasi as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?>.</td>
                                    <td><?= $value['judul_berita']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($value['status_berita'] == 0) {
                                            echo '<span class="badge badge-danger">Belum Aktif</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-warning"><i class="fas fa-info-circle"></i></a>
                                        <a href="" class="btn btn-success ml-1"><i class="fas fa-check-circle"></i></a>
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