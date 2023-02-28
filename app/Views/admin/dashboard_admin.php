<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Admin</h1>
        </div>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <?= session()->getFlashData('success'); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Riwayat Transaksi</h4>
                            </div>
                            <div class="card-body" style="font-size: 14px;">
                                <?= $riwayat_transaksi; ?> Transaksi
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pelanggan Aktif</h4>
                            </div>
                            <div class="card-body" style="font-size: 14px;">
                                <?= $count_users_premium; ?> Orang
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pendapatan</h4>
                            </div>
                            <div class="card-body" style="font-size: 14px;">
                                <?php
                                $total_saldo = 0;
                                foreach ($total_pendapatan as $value) {
                                    $total_saldo = $value;
                                ?>
                                    <?= "Rp. " . number_format($total_saldo, 0, ",", "."); ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-4 mt-3">
                        <canvas id="myChart1"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4 mt-3">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>

            <script>
                var ctx = document.getElementById("myChart1").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Admin", "Users Free", "Users Premium"],
                        datasets: [{
                            label: 'Data Pengguna',
                            data: [<?= $count_data_admin ?>, <?= $count_users_free; ?>, <?= $count_users_premium; ?>],
                            backgroundColor: [
                                'rgba(36, 176, 9, 1)',
                                'rgba(18, 9, 176, 1)',
                                'rgba(223, 199, 15, 1)',
                            ],
                            borderColor: [
                                'rgba(36, 176, 9, 1)',
                                'rgba(18, 9, 176, 1)',
                                'rgba(223, 199, 15, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                    }
                });

                var ctx = document.getElementById("myChart2").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Olahraga", "Politik", "Kecelakaan", "Ekonomi"],
                        datasets: [{
                            label: 'Data Berita',
                            data: [<?= $count_olahraga ?>, <?= $count_politik ?>, <?= $count_kecelakaan ?>, <?= $count_ekonomi ?>],
                            backgroundColor: [
                                'rgba(18, 9, 176, 1)',
                                'rgba(223, 199, 15, 1)',
                                'rgba(248, 0, 0, 0.8)',
                                'rgba(36, 176, 9, 1)',
                            ],
                            borderColor: [
                                'rgba(18, 9, 176, 1)',
                                'rgba(223, 199, 15, 1)',
                                'rgba(248, 0, 0, 0.8)',
                                'rgba(36, 176, 9, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                    }
                });
            </script>

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
                                    <td><?= $no++; ?></td>
                                    <td><?= $value['email']; ?></td>
                                    <td><?= tgl_indo_model_1(date($value['date'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?= $pager->links('auth_logins', 'pagination_users_login'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>