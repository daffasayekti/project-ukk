<?= $this->extend('/layouts/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/politik/pemilihan_umum" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Berita Pemilihan Umum</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><?= $beritaPemilihanUmum['judul_berita']; ?></h4>
                </div>
                <div class="card-body">
                    <div style="width: 298px; display: block; margin-left: auto; margin-right: auto;">
                        <img alt="image" src="/images/resource_berita/<?= $beritaPemilihanUmum['gambar_berita']; ?>" class="img-fluid mb-2">
                    </div>
                    <div class="tab-content mt-4" id="myTabContent">
                        <div class="tab-pane fade show active text-justify" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <?= $beritaPemilihanUmum['isi_berita']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>