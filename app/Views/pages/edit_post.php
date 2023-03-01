<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="flash-news-banner">
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash News</span>
                <?php if ($data_laporan) : ?>
                    <marquee class="mb-0" direction="right">
                        <?= $data_laporan['isi_pesan']; ?>
                    </marquee>
                <?php endif; ?>
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
                        <h2 class="mt-3 text-center mb-5">
                            Kelola Postingan Berita
                        </h2>

                        <form action="" method="get" autocomplete="off" style="display:flex">
                            <div class="float-left mb-4">
                                <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" placeholder="Masukkan Judul Berita" autocomplete="off" style="margin-right: 100px;">
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary" style="height: 51px"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="float-right mb-5" style="margin-left: auto">
                                <a href="/home/tambah_data_berita" class="btn btn-success btn-sm "><i class="fas fa-plus mr-1"></i> Tambah Data Berita</a>
                            </div>
                        </form>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-md table-striped">
                                <tr class="text-center">
                                    <th scope="col">No.</th>
                                    <th scope="col">Judul Berita</th>
                                    <th scope="col">Kategori Berita</th>
                                    <th scope="col">Status Berita</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                <?php
                                $no = 1 + (10 * ($currentPage - 1));
                                foreach ($data_postku as $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $value['judul_berita']; ?></td>
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
                                            <?php if ($value['status_berita'] == 1) {
                                                echo 'Tayang';
                                            } elseif ($value['status_berita'] == 0) {
                                                echo 'Pending';
                                            } elseif ($value['status_berita'] == 2) {
                                                echo 'Ditolak';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($value['status_berita'] == 0) : ?>
                                                <a href="/home/edit_data_berita/<?= $value['slug']; ?>" class="btn btn-warning btn-sm ml-1"><i class="fas fa-pencil-alt text-white"></i></a>
                                                <a href="/home/hapus_berita/<?= $value['slug']; ?>" class="btn btn-danger btn-sm ml-1 hapus-berita-user-premium"><i class="fas fa-trash"></i></a>
                                            <?php elseif ($value['status_berita'] == 1) : ?>
                                                <a href="/home/edit_data_berita/<?= $value['slug']; ?>" class="btn btn-warning btn-sm ml-1"><i class="fas fa-pencil-alt text-white"></i></a>
                                                <a href="/home/hapus_berita/<?= $value['slug']; ?>" class="btn btn-danger btn-sm ml-1 hapus-berita-user-premium"><i class="fas fa-trash"></i></a>
                                            <?php elseif ($value['status_berita'] == 2) : ?>
                                                <a href="/home/hapus_berita/<?= $value['slug']; ?>" class="btn btn-danger btn-sm ml-1 hapus-berita-user-premium"><i class="fas fa-trash"></i></a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php if (empty($data_postku)) : ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    Anda Belum Pernah Menulis Berita!
                                </div>
                            <?php endif; ?>
                        </div>
                        <?= $pager->links('tb_berita', 'pagination_data_berita_premium'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const hapusBeritaUserPremium = document.querySelectorAll(".hapus-berita-user-premium")

    for (let i = 0; i < hapusBeritaUserPremium.length; i++) {
        hapusBeritaUserPremium[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menghapus Berita Tersebut ?",
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