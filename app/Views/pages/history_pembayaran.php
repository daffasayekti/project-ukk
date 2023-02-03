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
                        <h1 class="mt-3 text-center mb-5">
                            History Pembayaran
                        </h1>

                        <form action="" method="get" autocomplete="off" style="display:flex">
                            <div class="float-left mb-4">
                                <input type="text" name="keyword" value="<?= $keyword; ?>" class="form-control" placeholder="Masukkan Nama Pelanggan" autocomplete="off" style="margin-right: 100px;">
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary" style="height: 51px"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-md table-striped">
                                <tr class="text-center">
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Nama Pemesan</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Total Pembayaran</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                <?php
                                foreach ($data_pembayaran as $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $value['order_id']; ?></td>
                                        <td class="text-center"><?= $value['nama_pelanggan']; ?></td>
                                        <td class="text-center">Layanan <?= $value['nama_produk']; ?></td>
                                        <td class="text-center">Rp. <?= number_format($value['total_pembayaran'], 0, ",", "."); ?></td>
                                        <td class="text-center">
                                            <a href="/payment/detail_invoice/<?= $value['id_pembayaran']; ?>" class="btn btn-danger btn-sm ml-1"><i class="fas fa-save"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php if (empty($data_pembayaran)) : ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    Anda Belum Pernah Melakukan Pembayaran!
                                </div>
                            <?php endif; ?>
                        </div>
                        <?= $pager->links('tb_invoice', 'pagination_history_pembayaran'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>