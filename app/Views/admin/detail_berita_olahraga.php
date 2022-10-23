<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/admin/data_olahraga" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Berita Olahraga</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="mx-auto"><?= $detailOlahraga['judul_berita']; ?></h4>
                </div>
                <div class="card-body">
                    <div style="width: 298px; display: block; margin-left: auto; margin-right: auto;">
                        <img alt="image" src="/assets/images/resource_berita/<?= $detailOlahraga['gambar_berita']; ?>" class="img-fluid mb-2">
                    </div>
                    <div class="tab-content mt-4" id="myTabContent">
                        <div class="tab-pane fade show active text-justify" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <?= $detailOlahraga['isi_berita']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>