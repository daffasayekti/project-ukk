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
        <div class="row" data-aos="fade-up">
            <div class="col-xl-8 stretch-card grid-margin">
                <div class="position-relative">
                    <img src="/assets/images/resource_berita/banner.jpg" alt="banner" class="img-fluid" />
                    <div class="banner-content">
                        <div class="badge badge-danger fs-12 font-weight-bold mb-3">
                            Global News
                        </div>
                        <h1 class="mb-2">
                            <a href="/home/detail_berita_kecelakaan/<?= $global_berita['slug']; ?>" style="text-decoration: none; color: white"><?= $global_berita['judul_berita']; ?></a>
                        </h1>
                        <div class="fs-12 mb-4">
                            <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                            <?= tgl_indo_model_1(date($global_berita['tanggal_buat'])); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 stretch-card grid-margin">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h2>Berita Terbaru</h2>

                        <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                            <div class="pr-3">
                                <h5>
                                    <a href="/home/detail_berita_kecelakaan/<?= $berita_terbaru_kecelakaan['slug']; ?>" style="text-decoration: none; color: white"><?= $berita_terbaru_kecelakaan['judul_berita']; ?></a>
                                </h5>
                                <div class="fs-12">
                                    <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                    <?= tgl_indo_model_2(date($berita_terbaru_kecelakaan['tanggal_buat'])); ?>
                                </div>
                            </div>
                            <div class="rotate-img">
                                <img src="/assets/images/resource_berita/<?= $berita_terbaru_kecelakaan['gambar_berita']; ?>" alt="thumb" class="img-fluid img-lg" />
                            </div>
                        </div>

                        <div class="d-flex border-bottom-blue pb-4 pt-4 align-items-center justify-content-between">
                            <div class="pr-3">
                                <h5>
                                    <a href="/home/detail_berita_ekonomi/<?= $berita_terbaru_ekonomi['slug']; ?>" style="text-decoration: none; color: white"><?= $berita_terbaru_ekonomi['judul_berita']; ?></a>
                                </h5>
                                <div class="fs-12">
                                    <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                    <?= tgl_indo_model_2(date($berita_terbaru_ekonomi['tanggal_buat'])); ?>
                                </div>
                            </div>
                            <div class="rotate-img">
                                <img src="/assets/images/resource_berita/<?= $berita_terbaru_ekonomi['gambar_berita']; ?>" alt="thumb" class="img-fluid img-lg" />
                            </div>
                        </div>

                        <div class="d-flex pt-4 align-items-center justify-content-between">
                            <div class="pr-3">
                                <h5>
                                    <a href="/home/detail_berita_ekonomi/<?= $berita_terbaru_politik['slug']; ?>" style="text-decoration: none; color: white"><?= $berita_terbaru_politik['judul_berita']; ?></a>
                                </h5>
                                <div class="fs-12">
                                    <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                    <?= tgl_indo_model_2(date($berita_terbaru_politik['tanggal_buat'])); ?>
                                </div>
                            </div>
                            <div class="rotate-img">
                                <img src="/assets/images/resource_berita/<?= $berita_terbaru_politik['gambar_berita']; ?>" alt="thumb" class="img-fluid img-lg" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <div class="col-lg-3 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h2>Kategori</h2>
                        <ul class="vertical-menu">
                            <li><a href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a></li>
                            <li><a href="<?= base_url('/home/politik'); ?>">Politik</a></li>
                            <li><a href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a></li>
                            <li><a href="<?= base_url('/home/olahraga'); ?>">Olahraga</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <?php
                        foreach ($berita_politik_terbaru as $value) {
                        ?>
                            <div class="row">
                                <div class="col-sm-4 grid-margin">
                                    <div class="position-relative">
                                        <div class="rotate-img">
                                            <img src="/assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="thumb" class="img-fluid" />
                                        </div>
                                        <div class="badge-positioned">
                                            <span class="badge badge-danger font-weight-bold">Flash News</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8  grid-margin">
                                    <h2 class="mb-2 font-weight-600">
                                        <a href="/home/detail_berita_politik/<?= $value['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $value['judul_berita'] ?></a>
                                    </h2>
                                    <div class="fs-13 mb-2">
                                        <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                        <?= tgl_indo_model_1(date($value['tanggal_buat'])); ?>
                                    </div>
                                    <?php
                                    $data_excerpt = $value['isi_berita'];
                                    $excerpt = substr($data_excerpt, 0, 200) . "...";
                                    echo "<p class='mb-0' style='text-align: justify'><?php $excerpt </p>"
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card-title">
                                    Ekonomi
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-8 col-sm-6">
                                        <div class="rotate-img">
                                            <img src="/assets/images/resource_berita/<?= $berita_terbaru_ekonomi['gambar_berita']; ?>" alt="thumb" class="img-fluid" />
                                        </div>
                                        <h2 class="mt-3 text-primary mb-2">
                                            <a href="/home/detail_berita_ekonomi/<?= $berita_terbaru_ekonomi['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $berita_terbaru_ekonomi['judul_berita']; ?></a>
                                        </h2>
                                        <p class="fs-13 mb-1 text-muted">
                                            <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                            <?= tgl_indo_model_1(date($berita_terbaru_ekonomi['tanggal_buat'])); ?>
                                        </p>
                                        <?php
                                        $data_excerpt = $berita_terbaru_ekonomi['isi_berita'];
                                        $excerpt = substr($data_excerpt, 0, 100) . "...";
                                        echo "<p class='my-3 fs-15' style='text-align: justify'><?php $excerpt </p>"
                                        ?>
                                    </div>
                                    <div class="col-xl-6 col-lg-4 col-sm-6">
                                        <?php foreach ($berita_ekonomi as $value) { ?>
                                            <div class="border-bottom pb-3 mb-3">
                                                <h3 class="font-weight-600 mb-0">
                                                    <a href="/home/detail_berita_ekonomi/<?= $value['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $value['judul_berita']; ?></a>
                                                </h3>
                                                <p class="fs-13 text-muted mb-0">
                                                    <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                                    <?= tgl_indo_model_1(date($value['tanggal_buat'])); ?>
                                                </p>
                                                <?php
                                                $data_excerpt = $value['isi_berita'];
                                                $excerpt = substr($data_excerpt, 0, 35) . "...";
                                                echo "<p class='mb-0' style='text-align: justify'><?php $excerpt </p>"
                                                ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card-title">
                                            Politik
                                        </div>
                                        <?php foreach ($berita_politik as $value) { ?>
                                            <div class="border-bottom pb-3">
                                                <div class="rotate-img">
                                                    <img src="/assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="thumb" class="img-fluid" />
                                                </div>
                                                <p class="fs-16 font-weight-600 mb-0 mt-3">
                                                    <a href="/home/detail_berita_politik/<?= $value['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $value['judul_berita']; ?></a>
                                                </p>
                                                <p class="fs-13 text-muted mb-0">
                                                    <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                                    <?= tgl_indo_model_1(date($value['tanggal_buat'])); ?>
                                                </p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card-title">
                                            Kecelakaan
                                        </div>
                                        <?php foreach ($berita_kecelakaan as $value) { ?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="border-bottom pb-3 mt-4">
                                                        <div class="row">
                                                            <div class="col-sm-5 pr-2">
                                                                <div class="rotate-img">
                                                                    <img src="/assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="thumb" class="img-fluid w-100" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-7 pl-2">
                                                                <p class="fs-16 font-weight-600 mb-0">
                                                                    <a href="/home/detail_berita_kecelakaan/<?= $value['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $value['judul_berita']; ?></a>
                                                                </p>
                                                                <p class="fs-13 text-muted mb-0">
                                                                    <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                                                    <?= tgl_indo_model_1(date($value['tanggal_buat'])); ?>
                                                                </p>
                                                                <?php
                                                                $data_excerpt = $value['isi_berita'];
                                                                $excerpt = substr($data_excerpt, 0, 25) . "...";
                                                                echo "<p class='mb-0 fs-13'><?php $excerpt </p>"
                                                                ?>
                                                            </div>
                                                        </div>
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
    </div>
</div>
<?= $this->endSection(); ?>