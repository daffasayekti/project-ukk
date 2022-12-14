<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pembayaran</h1>
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
                            <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" style="width:159pt" placeholder="Masukkan Nama Pemesan" autocomplete="off">
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
                                <th>Order ID</th>
                                <th>Nama Pemesan</th>
                                <th>Nama Produk</th>
                                <th>Status Pembayaran</th>
                                <th>Total Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            foreach ($data_pembayaran as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $value['order_id']; ?></td>
                                    <td class="text-center"><?= $value['nama_pelanggan']; ?></td>
                                    <td class="text-center">Layanan <?= $value['nama_produk']; ?></td>
                                    <td class="text-center"><?= $value['status_pembayaran']; ?></td>
                                    <td class="text-center">Rp. <?= number_format($value['total_pembayaran'], 0, ",", "."); ?></td>
                                    <td class="text-center">
                                        <?php if ($value['status_pembayaran'] == 'pending') : ?>
                                            <a href="/admin/check_status_pembayaran/<?= $value['order_id']; ?>" class="btn btn-success btn-sm mr-1"><i class="fas fa-eye"></i></a>
                                        <?php endif; ?>
                                        <?php if ($value['status_pembayaran'] == 'expire') : ?>
                                            <a href="/admin/hapus_data_pembayaran/<?= $value['order_id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?= $pager->links('tb_pembayaran', 'pagination_data_pembayaran'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>