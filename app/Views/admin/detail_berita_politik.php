<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/admin/data_politik" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Berita Politik</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="mx-auto"><?= $detailPolitik['judul_berita']; ?></h4>
                </div>
                <div class="card-body">
                    <div style="width: 298px; display: block; margin-left: auto; margin-right: auto;">
                        <img alt="image" src="/assets/images/resource_berita/<?= $detailPolitik['gambar_berita']; ?>" class="img-fluid mb-2">
                    </div>
                    <div class="tab-content mt-4" id="myTabContent">
                        <div class="tab-pane fade show active text-justify" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <?= $detailPolitik['isi_berita']; ?>
                        </div>
                    </div>
                    <div class="d-lg-flex mt-3">
                        <span class="fs-16 font-weight-600 mr-2 mb-1"><b>Tags : </b></span>
                        <?php foreach ($data_tagline as $value) : ?>
                            <span class="mr-2 mb-1"><b>#<?= $value['nama_tags']; ?></b></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>