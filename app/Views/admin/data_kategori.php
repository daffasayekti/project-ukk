<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori Berita</h1>
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
                <div class="card-body">
                    <div class="table-responsive-sm table-striped">
                        <table class="table table-bordered table-sm">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Kategori Berita</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_kategori as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $value['nama_kategori']; ?></td>
                                    <td class="text-center">
                                        <a href="/admin/hapus_kategori/<?= $value['id_kategori']; ?>" class="btn btn-danger btn-sm ml-1 hapus-kategori"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php if (empty($data_kategori)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Kategori Berita Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('kategori_berita', 'pagination_data_kategori'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    const hapusKategori = document.querySelectorAll(".hapus-kategori")

    for (let i = 0; i < hapusKategori.length; i++) {
        hapusKategori[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menghapus Kategori Tersebut ?",
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