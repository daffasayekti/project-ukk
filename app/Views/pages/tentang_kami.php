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
                        <div class="aboutus-wrapper">
                            <h1 class="mt-5 text-center mb-5">
                                Tentang Kami
                            </h1>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <img src="/assets/images/sekolahku.png" alt="sekolahku" width="270" height="270" class="img-fluid">
                                </div>
                                <div class="col-md-6" style="text-align: justify;">
                                    <p>Perkenalkan nama saya Daffa Pratama A.S, saya sekolah di <b>SMKN 2 Surabaya</b> Jurusan <b>RPL (Rekayasa Perangkat Lunak)</b>. Pada Kelas 12 ini kita diwajibkan membuat Project. Saya memilih untuk membuat Website Portal Berita yang bernama <b>World Time</b>. World Time adalah sebuah Website Portal Berita yang mempunyai banyak fitur diantaranya adalah fitur berlangganan <b>Users Premium</b>.</p>
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