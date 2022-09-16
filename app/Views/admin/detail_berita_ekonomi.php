<?= $this->extend('/layouts/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/ekonomi/edit_post_ekonomi" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Post Ekonomi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="/ekonomi/edit/<?= $detailBeritaEkonomi['slug']; ?>" class="badge badge-warning">Edit Post</a></div>
                <div class="breadcrumb-item"><a href="/ekonomi/delete/<?= $detailBeritaEkonomi['slug']; ?>" class="badge badge-danger" data-confirm="Hapus Post ?|Apakah Anda Yakin ?" data-confirm-yes="submitDel(<?= $detailBeritaEkonomi['id_berita']; ?>)" id="del-<?= $detailBeritaEkonomi['id_berita']; ?>">Hapus Post</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><?= $detailBeritaEkonomi['judul_berita']; ?></h4>
                </div>
                <div class="card-body">
                    <div style="width: 298px; display: block; margin-left: auto; margin-right: auto;">
                        <img alt="image" src="/images/resource_berita/<?= $detailBeritaEkonomi['gambar_berita']; ?>" class="img-fluid mb-2">
                    </div>
                    <div class="tab-content mt-4" id="myTabContent">
                        <div class="tab-pane fade show active text-justify" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <?= $detailBeritaEkonomi['isi_berita']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>