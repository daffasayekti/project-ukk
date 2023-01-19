<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="/admin/create_data_admin" class="badge badge-primary">Add Admin</a></div>
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
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Nama Admin" autocomplete="off">
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
                            </tr>
                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_admin as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><img alt="image" src="/assets/images/profile_users/<?= $value['profile_img'] ?>" class="rounded-circle mr-3" width="30" height="30"><?= $value['username']; ?></td>
                                    <td class="text-center"><?= $value['email']; ?></td>
                                    <td class="text-center">Admin</td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <?php if (empty($data_admin)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Data Admin Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('users', 'pagination_data_admin'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>