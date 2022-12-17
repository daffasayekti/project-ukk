<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="flash-news-banner">
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash News</span>
                <p class="mb-0">
                    <?= $data_laporan['isi_pesan']; ?>
                </p>
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
                        <div class="aboutus-wrapper">
                            <h2 class="mt-3 mb-3 text-center mb-3">
                                Pilih Langganan
                            </h2>
                            <div class="row">
                                <?php foreach ($data_langganan as $value) { ?>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $value['nama_langganan']; ?> <span class="badge badge-danger ml-1">Rp. <?= number_format($value['harga_langganan'], 0, ",", "."); ?></span></h5>
                                                <p class="card-text">Anda bisa menikmati layanan dari kami selama <?= $value['jenis_langganan']; ?></p>
                                                <a href="/payment/detail_pembayaran/<?= $value['id_langganan']; ?>" class="btn btn-primary">Lanjutkan</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>