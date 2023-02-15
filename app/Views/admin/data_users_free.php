<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Users Free</h1>
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
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_users_free as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><img alt="image" src="/assets/images/profile_users/<?= $value['profile_img'] ?>" class="rounded-circle mr-3" width="30" height="30"><?= $value['username']; ?></td>
                                    <td class="text-center"><?= $value['email']; ?></td>
                                    <td class="text-center">
                                        <?php if ($value['jenis_akun_id'] == 1) {
                                            echo 'Free';
                                        } ?>
                                    </td>
                                    <td style="width: 15%;" class="text-center">
                                        <a href="/admin/hapus_users_free/<?= $value['id']; ?>" class="btn btn-danger btn-sm hapus-user-free"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <?php if (empty($data_users_free)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Data Users Free Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('users', 'pagination_users_free'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    const hapusUserFree = document.querySelectorAll(".hapus-user-free")

    for (let i = 0; i < hapusUserFree.length; i++) {
        hapusUserFree[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menghapus Akun User Tersebut ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        })
    }
</script>
<?= $this->endSection(); ?>