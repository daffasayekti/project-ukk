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
        <?php if (empty($berita_politik_terbaru) || empty($global_berita) || empty($berita_terbaru_kecelakaan) || empty($berita_terbaru_ekonomi) || empty($berita_terbaru_politik) || empty($berita_politik_terbaru) || empty($berita_ekonomi_terbaru) || empty($berita_ekonomi) || empty($berita_kecelakaan) || empty($berita_politik)) : ?>
            <div class="row" data-aos="fade-up">
                <div class="col-lg-3 stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h2>Kategori</h2>
                            <ul class="vertical-menu">
                                <?php if (in_groups('User') && user()->jenis_akun_id == 2) : ?>
                                    <li><a href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a></li>
                                    <li><a href="<?= base_url('/home/politik'); ?>">Politik</a></li>
                                    <li><a href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a></li>
                                    <li><a href="<?= base_url('/home/olahraga'); ?>">Olahraga</a></li>
                                <?php elseif (in_groups('Admin') && user()->jenis_akun_id == 3) : ?>
                                    <li><a href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a></li>
                                    <li><a href="<?= base_url('/home/politik'); ?>">Politik</a></li>
                                    <li><a href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a></li>
                                    <li><a href="<?= base_url('/home/olahraga'); ?>">Olahraga</a></li>
                                <?php elseif (in_groups('User') && user()->jenis_akun_id == 1) : ?>
                                    <li><a href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a></li>
                                    <li><a href="<?= base_url('/home/politik'); ?>">Politik</a></li>
                                    <li><a href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a></li>
                                <?php else : ?>
                                    <li><a href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a></li>
                                    <li><a href="<?= base_url('/home/politik'); ?>">Politik</a></li>
                                    <li><a href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <h1 class="font-weight-600 mb-4">
                                    BERANDA
                                </h1>
                            </div>
                            <div class="alert alert-danger" role="alert">
                                Seluruh Berita Sedang Tidak Tersedia!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="row" data-aos="fade-up">
                <div class="col-xl-8 stretch-card grid-margin">
                    <div class="position-relative">
                        <img src="/assets/images/resource_berita/<?= $global_berita['gambar_berita']; ?>" alt="banner" class="img-fluid" width="1000px" />
                        <div class="banner-content">
                            <h1 class="mb-2">
                                <a href="/home/detail_berita_kecelakaan/<?= $global_berita['slug']; ?>" style="text-decoration: none; color: white"><?= $global_berita['judul_berita']; ?></a>
                            </h1>
                            <div class="fs-12 mb-5">
                                <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                <?= tgl_indo_model_2(date($global_berita['tanggal_buat'])); ?>
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
                                <?php if (in_groups('User') && user()->jenis_akun_id == 2) : ?>
                                    <li><a href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a></li>
                                    <li><a href="<?= base_url('/home/politik'); ?>">Politik</a></li>
                                    <li><a href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a></li>
                                    <li><a href="<?= base_url('/home/olahraga'); ?>">Olahraga</a></li>
                                <?php elseif (in_groups('Admin') && user()->jenis_akun_id == 3) : ?>
                                    <li><a href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a></li>
                                    <li><a href="<?= base_url('/home/politik'); ?>">Politik</a></li>
                                    <li><a href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a></li>
                                    <li><a href="<?= base_url('/home/olahraga'); ?>">Olahraga</a></li>
                                <?php elseif (in_groups('User') && user()->jenis_akun_id == 1) : ?>
                                    <li><a href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a></li>
                                    <li><a href="<?= base_url('/home/politik'); ?>">Politik</a></li>
                                    <li><a href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a></li>
                                <?php else : ?>
                                    <li><a href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a></li>
                                    <li><a href="<?= base_url('/home/politik'); ?>">Politik</a></li>
                                    <li><a href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a></li>
                                <?php endif; ?>
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
                                        </div>
                                    </div>
                                    <div class="col-sm-8  grid-margin">
                                        <h2 class="mb-2 font-weight-600">
                                            <a href="/home/detail_berita_politik/<?= $value['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $value['judul_berita'] ?></a>
                                        </h2>
                                        <div class="fs-13 mb-2">
                                            <span class="mr-2"><i class="fa-solid fa-clock"></i> </span>
                                            <?= tgl_indo_model_2(date($value['tanggal_buat'])); ?>
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
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection(); ?>