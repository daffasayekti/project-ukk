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
                                <?= $count_users; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Berita Politik</h4>
                            </div>
                            <div class="card-body" style="font-size: 16px;">
                                <?= $count_politik; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kecelakaan</h4>
                            </div>
                            <div class="card-body" style="font-size: 16px;">
                                <?= $count_kecelakaan; ?>
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
                                <?= $count_ekonomi; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Users Login</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm table-striped">
                        <table class="table table-bordered table-md" id="table">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Email</th>
                                <th>Waktu Login</th>
                            </tr>

                            <?php
                            $no = 1;
                            foreach ($data_users_login as $value) :
                            ?>
                                <tr class="text-center">
                                    <td><?= $no++; ?></td>
                                    <td><?= $value['email']; ?></td>
                                    <td><?= $value['date']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>