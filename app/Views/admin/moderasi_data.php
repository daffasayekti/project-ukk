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
                                    <td class="text-center"><?= $no++; ?></td>
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
                                        <a href="/admin/detail_berita_moderasi/<?= $value['slug']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="/admin/proses_moderasi/<?= $value['id_berita']; ?>" class="btn btn-success ml-1 btn-sm setuju-moderasi"><i class="fas fa-check-circle"></i></a>
                                        <a href="/admin/gagal_moderasi/<?= $value['slug']; ?>" class="btn btn-danger ml-1 btn-sm gagal-moderasi"><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <?php if (empty($data_berita_moderasi)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Tidak Ada Berita Yang Perlu Dimoderasi!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('tb_berita', 'pagination_data_moderasi'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    const setujuModerasi = document.querySelectorAll(".setuju-moderasi")

    for (let i = 0; i < setujuModerasi.length; i++) {
        setujuModerasi[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menyetujui Moderasi Berita Tersebut ?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        })
    }

    const gagalModerasi = document.querySelectorAll(".gagal-moderasi")

    for (let i = 0; i < gagalModerasi.length; i++) {
        gagalModerasi[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menggagalkan Moderasi Berita Tersebut ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Gagalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        })
    }
</script>
<?= $this->endSection(); ?>