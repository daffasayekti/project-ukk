<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Komentar</h1>
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
                <div class="card-body">
                    <div class="table-responsive-sm table-striped">
                        <table class="table table-bordered table-md">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Isi Komentar</th>
                                <th>Penulis</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($data_komentar as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $value['isi_komentar']; ?></td>
                                    <td class="text-center"><?= $value['created_by'] ?></td>
                                    <td class="text-center"><?= tgl_indo_sekarang(date($value['tanggal_komentar'])); ?></td>
                                    <td style="width: 15%;" class="text-center">
                                        <a href="/admin/detail_balas_komentar/<?= $value['id_komentar']; ?>" class="btn btn-success btn-sm ml-1"><i class="fas fa-eye"></i></a>
                                        <a href="/admin/hapus_komentar/<?= $value['id_komentar']; ?>" class="btn btn-danger btn-sm ml-1 hapus-komentar-admin"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <?php if (empty($data_komentar)) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                Data Komentar Tidak Tersedia!
                            </div>
                        <?php endif; ?>
                        <?= $pager->links('tb_komentar', 'pagination_data_komentar'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    const hapusKomentarAdmin = document.querySelectorAll(".hapus-komentar-admin")

    for (let i = 0; i < hapusKomentarAdmin.length; i++) {
        hapusKomentarAdmin[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menghapus Komentar Tersebut ?",
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