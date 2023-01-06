<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="flash-news-banner">
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash News</span>
                <marquee class="mb-0" direction="right">
                    <?= $data_laporan['isi_pesan']; ?>
                </marquee>
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
                            <h1 class="mt-5 text-center mb-3">
                                Tentang Kami
                            </h1>
                            <p class="font-weight-600 fs-15" style="text-align: justify;">
                                He has led a remarkable campaign, defying the traditional
                                mainstream parties courtesy of his En Marche! movement.
                                For many, however, the campaign has become less about
                                backing Macron and instead about voting against Le Pen,
                                the National Front candidate.
                            </p>
                            <p class="font-weight-600 fs-15 mb-5 mt-4" style="text-align: justify;">
                                He has led a remarkable campaign, defying the traditional
                                mainstream parties courtesy of his En Marche! movement.
                                For many, however, the campaign has become less about
                                backing Macron and instead about voting against Le Pen,
                                the National Front candidate.
                            </p>
                            <img src="../assets/images/about/about.jpg" alt="banner" class="img-fluid mb-5" />

                            <p class="font-weight-600 fs-15" style="text-align: justify;">
                                He has led a remarkable campaign, defying the traditional
                                mainstream parties courtesy of his En Marche! movement.
                                For many, however, the campaign has become less about
                                backing Macron and instead about voting against Le Pen,
                                the National Front candidate.
                            </p>
                            <p class="font-weight-600 fs-15 mb-5 mt-4" style="text-align: justify;">
                                He has led a remarkable campaign, defying the traditional
                                mainstream parties courtesy of his En Marche! movement.
                                For many, however, the campaign has become less about
                                backing Macron and instead about voting against Le Pen,
                                the National Front candidate.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>