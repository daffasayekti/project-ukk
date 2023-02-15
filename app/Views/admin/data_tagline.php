<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tagline Berita</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="/admin/create_tagline" class="badge badge-primary py-lg-2" style="box-shadow:0 2px 6px #6777ef">Add Tagline</a></div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class=" alert alert-success alert-dismissible show fade">
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
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Judul Tagline" autocomplete="off">
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
                                <th>Nama Tagline</th>
                                <th>Kategori Berita</th>
                                <th>Jumlah Digunakan</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_tagline as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td>#<?= $value['nama_tags']; ?></td>
                                    <td class="text-center">
                                        <?php foreach ($kategoriBerita as $kategori) : ?>
                                            <?php if ($value['kategori_id'] == $kategori['id_kategori']) : ?>
                                                <?= $kategori['nama_kategori']; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="text-center"><?= $value['banyak_digunakan']; ?> Berita</td>
                                    <td style="width: 15%;" class="text-center">
                                        <a href="/admin/edit_tagline/<?= $value['id_tags']; ?>" class="btn btn-warning btn-sm ml-1"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="/admin/hapus_tagline/<?= $value['id_tags']; ?>" class="btn btn-danger btn-sm ml-1 hapus-tagline"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php if (empty($data_tagline)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Data Berita Kecelakaan Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('tags', 'pagination_data_tagline'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    const hapusTagline = document.querySelectorAll(".hapus-tagline")

    for (let i = 0; i < hapusTagline.length; i++) {
        hapusTagline[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menghapus Tagline Tersebut ?",
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