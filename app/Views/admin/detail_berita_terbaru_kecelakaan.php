<?= $this->extend('/layouts/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/pages/berita_terbaru_kecelakaan" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Berita Kecelakaan</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><?= $detailBeritaKecelakaan['judul_berita']; ?></h4>
                </div>
                <div class="card-body">
                    <div style="width: 298px; display: block; margin-left: auto; margin-right: auto;">
                        <img alt="image" src="/images/resource_berita/<?= $detailBeritaKecelakaan['gambar_berita']; ?>" class="img-fluid mb-2">
                    </div>
                    <div class="tab-content mt-4" id="myTabContent">
                        <div class="tab-pane fade show active text-justify" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <?= $detailBeritaKecelakaan['isi_berita']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>