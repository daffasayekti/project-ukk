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
                                        <a href="/admin/hapus_komentar/<?= $value['id_komentar']; ?>" class="btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?= $pager->links('tb_komentar', 'pagination_data_komentar'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>