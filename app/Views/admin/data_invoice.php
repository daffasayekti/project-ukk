<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Invoice</h1>
        </div>

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
                            foreach ($data_invoice as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $value['order_id']; ?></td>
                                    <td class="text-center"><?= $value['nama_pelanggan']; ?></td>
                                    <td class="text-center">Layanan <?= $value['nama_produk']; ?></td>
                                    <td class="text-center"><?= $value['status_pembayaran']; ?></td>
                                    <td class="text-center">Rp. <?= number_format($value['total_pembayaran'], 0, ",", "."); ?></td>
                                    <td class="text-center">
                                        <a href="/admin/detail_invoice/<?= $value['id_pembayaran']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-save"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?= $pager->links('tb_invoice', 'pagination_data_invoice'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>