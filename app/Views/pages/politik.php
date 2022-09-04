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
        <div class="col-sm-12">
            <div class="card" data-aos="fade-up">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="font-weight-600 mb-4">
                                POLITIK
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <?php foreach ($berita_politik as $value) { ?>
                                <div class="row">
                                    <div class="col-sm-4 grid-margin">
                                        <div class="rotate-img">
                                            <img src="/assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="banner" class="img-fluid" />
                                        </div>
                                    </div>
                                    <div class="col-sm-8 grid-margin">
                                        <h2 class="font-weight-600 mb-2">
                                            <?= $value['judul_berita']; ?>
                                        </h2>
                                        <p class="fs-13 text-muted mb-0">
                                            <span class="mr-2"><i class="fa-solid fa-clock"></i> </span><?= tgl_indo_model_1(date($value['tanggal_buat'])); ?>
                                        </p>
                                        <?php
                                        $data_excerpt = $value['isi_berita'];
                                        $excerpt = substr($data_excerpt, 0, 200) . "...";
                                        echo "<p class='fs-15' style='text-align: justify'><?php $excerpt </p>"
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-4">
                            <h2 class="mb-4 text-primary font-weight-600">
                                Berita Terbaru
                            </h2>
                            <?php foreach ($berita_politik_terbaru as $value) { ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="border-bottom pb-4 pt-4">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <h5 class="font-weight-600 mb-1">
                                                        <?= $value['judul_berita']; ?>
                                                    </h5>
                                                    <p class="fs-13 text-muted mb-0">
                                                        <span class="mr-2"><i class="fa-solid fa-clock"></i> </span><?= tgl_indo_model_2(date($value['tanggal_buat'])); ?>
                                                    </p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="rotate-img">
                                                        <img src="../assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="banner" class="img-fluid" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="trending">
                                <h2 class="mb-4 text-primary font-weight-600">
                                    Trending
                                </h2>
                                <div class="mb-4">
                                    <div class="rotate-img">
                                        <img src="../assets/images/magazine/Magzine_4.jpg" alt="banner" class="img-fluid" />
                                    </div>
                                    <h3 class="mt-3 font-weight-600">
                                        Virus Kills Member Of Advising Iran’s Supreme
                                    </h3>
                                    <p class="fs-13 text-muted mb-0">
                                        <span class="mr-2">Photo </span>10 Minutes ago
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <div class="rotate-img">
                                        <img src="../assets/images/magazine/Magzine_5.jpg" alt="banner" class="img-fluid" />
                                    </div>
                                    <h3 class="mt-3 font-weight-600">
                                        Virus Kills Member Of Advising Iran’s Supreme
                                    </h3>
                                    <p class="fs-13 text-muted mb-0">
                                        <span class="mr-2">Photo </span>10 Minutes ago
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <div class="rotate-img">
                                        <img src="../assets/images/magazine/Magzine_6.jpg" alt="banner" class="img-fluid" />
                                    </div>
                                    <h3 class="mt-3 font-weight-600">
                                        Virus Kills Member Of Advising Iran’s Supreme
                                    </h3>
                                    <p class="fs-13 text-muted mb-0">
                                        <span class="mr-2">Photo </span>10 Minutes ago
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>