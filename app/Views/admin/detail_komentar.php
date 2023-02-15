<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/admin/data_komentar" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Data Balas Komentar</h1>
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
                    <div class="row">
                        <?php if (empty($balasKomentar)) : ?>
                            <div class="col-lg-12 col-md-6 col-lg-6">
                                <div class="alert alert-danger text-center" role="alert">
                                    Data Balas Komentar Tidak Tersedia!
                                </div>
                            </div>
                        <?php else : ?>
                            <?php foreach ($balasKomentar as $value) : ?>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4>Ditulis Oleh : <?= $value['penulis_komentar']; ?></h4>
                                            <div class="card-header-action">
                                                <a href="/admin/hapus_balas_komentar/<?= $value['id']; ?>" class="btn btn-danger btn-sm hapus-balas-komentar-admin"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p><?= $value['isi_balas_komentar']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    </section>
</div>

<script>
    const hapusBalasKomentarAdmin = document.querySelectorAll(".hapus-balas-komentar-admin")

    for (let i = 0; i < hapusBalasKomentarAdmin.length; i++) {
        hapusBalasKomentarAdmin[i].addEventListener('click', function(e) {
            e.preventDefault()
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Ingin Menghapus Balasan Komentar Tersebut ?",
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