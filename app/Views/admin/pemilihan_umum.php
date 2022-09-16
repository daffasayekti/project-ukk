<?= $this->extend('/layouts/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Berita Pemilihan Umum</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <?php foreach ($beritaPemilihanUmum as $value) : ?>
                    <div class="col-12 col-md-4 col-lg-4">
                        <article class="article article-style-c">
                            <div class="article-header">
                                <div class="article-image" data-background="/images/resource_berita/<?= $value['gambar_berita']; ?>">
                                </div>
                            </div>
                            <div class="article-details text-justify">
                                <div class="article-category"><a><?= $value['kategori_berita']; ?> | <?= date('d F Y', strtotime($value['created_at'])); ?></a>
                                </div>
                                <div class="article-title">
                                    <h2><a href="/politik/detail_berita_pemilihan_umum/<?= $value['slug']; ?>" style="text-decoration: none;"><?= $value['judul_berita']; ?></a></h2>
                                </div>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. </p>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>