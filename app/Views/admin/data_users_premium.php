<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Users Premium</h1>
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
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Nama Users" autocomplete="off">
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Jenis Akun</th>
                                <th>Tanggal Expired</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_users_premium as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><img alt="image" src="/assets/images/profile_users/<?= $value['profile_img'] ?>" class="rounded-circle mr-3" width="30" height="30"><?= $value['username']; ?></td>
                                    <td class="text-center"><?= $value['email']; ?></td>
                                    <td class="text-center">
                                        <?php if ($value['jenis_akun_id'] == 2) {
                                            echo 'Premium';
                                        } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $date = strtotime($value['tanggal_expired']);
                                        $date_expired = date('Y-m-d', $date);
                                        $date_now = date('Y-m-d');
                                        ?>
                                        <?php if ($date_expired == $date_now || $date_expired < $date_now) : ?>
                                            <a class="badge badge-warning text-white">Expired</a>
                                        <?php else : ?>
                                            <?= tgl_indo_model_1(date($value['tanggal_expired'])); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($date_expired == $date_now || $date_expired < $date_now) : ?>
                                            <a href="/admin/hapus_users_premium/<?= $value['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Akun Tersebut ?');"><i class="fas fa-trash"></i></a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <?php if (empty($data_users_premium)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Data Users Premium Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('users', 'pagination_users_premium'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>