<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="container">
        <div class="col-sm-12">
            <div class="card" data-aos="fade-up">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div>
                                <h1 class="font-weight-600 mb-1">
                                    <?= $detailPolitik['judul_berita']; ?>
                                </h1>
                                <p class="fs-13 text-muted mb-0 mt-2">
                                    <span class="mr-2"><i class="fa-solid fa-clock"></i> </span><?= tgl_indo_model_2(date($detailPolitik['tanggal_buat'])); ?>
                                </p>
                                <div class="rotate-img">
                                    <img src="/assets/images/resource_berita/<?= $detailPolitik['gambar_berita']; ?>" alt="banner" class="img-fluid mt-4 mb-4" />
                                </div>
                                <p class="mb-4 fs-15">
                                    <?= $detailPolitik['isi_berita']; ?>
                                </p>
                            </div>
                            <div class="d-lg-flex mt-3">
                                <span class="fs-16 font-weight-600 mr-2 mb-1">Tags</span>
                                <span class="badge badge-outline-dark mr-2 mb-1">Politik</span>
                                <span class="badge badge-outline-dark mr-2 mb-1">Politik</span><span class="badge badge-outline-dark mr-2 mb-1">Politik</span><span class="badge badge-outline-dark mr-2 mb-1">Politik</span><span class="badge badge-outline-dark mb-1">Politik</span>
                            </div>
                            <div class="post-comment-section">
                                <div class="testimonial">
                                    <div class="d-lg-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="rotate-img">
                                                <img src="/assets/images/profile_users/<?= $detailPolitik['profile_img']; ?>" alt="banner" class="img-fluid img-rounded mr-3" />
                                            </div>
                                            <div>
                                                <p class="fs-12 mb-1 line-height-xs">
                                                    Penulis Berita
                                                </p>
                                                <p class="fs-16 font-weight-600 mb-0 line-height-xs">
                                                    <?= $detailPolitik['username']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <ul class="social-media mb-3">
                                            <li>
                                                <a href="#">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="mdi mdi-youtube"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="comment-section">
                                    <h5 class="font-weight-600">Kolom Komentar</h5>
                                    <div class="comment-box">
                                        <div class="d-flex align-items-center">
                                            <div class="rotate-img">
                                                <img src="/assets/images/profile_users/default.png" alt="banner" class="img-fluid img-rounded mr-3" />
                                            </div>
                                            <div>
                                                <p class="fs-12 mb-1 line-height-xs">
                                                    24 Jul 2020
                                                </p>
                                                <p class="fs-16 font-weight-600 mb-0 line-height-xs">
                                                    Chigusa Kisa
                                                </p>
                                            </div>
                                        </div>

                                        <p class="fs-12 mt-3">
                                            Praesent facilisis vulputate venenatis. In
                                            facilisis placerat arcu, in tempor neque aliquet
                                            quis. Integer lacinia in ligula eu sodales. Proin
                                            non lorem iaculis, dictum lorem quis, bibendum
                                            leo.
                                        </p>
                                    </div>
                                    <div class="comment-box mb-0">
                                        <div class="d-flex align-items-center">
                                            <div class="rotate-img">
                                                <img src="/assets/images/profile_users/default.png" alt="banner" class="img-fluid img-rounded mr-3" />
                                            </div>
                                            <div>
                                                <p class="fs-12 mb-1 line-height-xs">
                                                    24 Jul 2020
                                                </p>
                                                <p class="fs-16 font-weight-600 mb-0 line-height-xs">
                                                    Lucy Miller
                                                </p>
                                            </div>
                                        </div>

                                        <p class="fs-12 mt-3">
                                            Praesent facilisis vulputate venenatis. In
                                            facilisis placerat arcu, in tempor neque aliquet
                                            quis. Integer lacinia in ligula eu sodales. Proin
                                            non lorem iaculis, dictum lorem quis, bibendum
                                            leo.
                                        </p>
                                    </div>
                                </div>
                            </div>
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
                                                        <a href="/home/detail_berita_politik/<?= $value['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $value['judul_berita']; ?></a>
                                                    </h5>
                                                    <p class="fs-13 text-muted mb-0">
                                                        <span class="mr-2"><i class="fa-solid fa-clock"></i> </span><?= tgl_indo_model_2(date($value['tanggal_buat'])); ?>
                                                    </p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="rotate-img">
                                                        <img src="/assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="banner" class="img-fluid" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="trending">
                                <h2 class="mb-4 text-primary font-weight-600">
                                    Berita Trending
                                </h2>
                                <?php foreach ($berita_politik_trending as $value) { ?>
                                    <div class="mb-4">
                                        <div class="rotate-img">
                                            <img src="/assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="banner" class="img-fluid" />
                                        </div>
                                        <h3 class="mt-3 font-weight-600">
                                            <a href="/home/detail_berita_politik/<?= $value['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $value['judul_berita']; ?></a>
                                        </h3>
                                        <p class="fs-13 text-muted mb-0">
                                            <span class="mr-2"><i class="fa-solid fa-clock"></i> </span><?= tgl_indo_model_2(date($value['tanggal_buat'])); ?>
                                        </p>
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