<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="flash-news-banner">
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash News</span>
                <p class="mb-0">
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
                            <h1 class="mt-5 mb-3 text-center mb-3">
                                Pilih Langganan
                            </h1>
                            <div class="row">
                                <?php foreach ($jenis_langganan as $value) { ?>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $value['nama_langganan']; ?> <span class="badge badge-danger ml-2">Rp. <?= number_format($value['harga_langganan'], 0, ",", "."); ?></span></h5>
                                                <p class="card-text">Anda bisa menikmati layanan dari kami selama <?= $value['jenis_langganan']; ?></p>
                                                <a href="#" class="btn btn-primary">Bayar</a>
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