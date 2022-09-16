<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Post Kecelakaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="/kecelakaan/create" class="badge badge-primary">Add Post</a></div>
                <div class="breadcrumb-item"><a href="/kecelakaan/export" class="badge badge-info">Export Excel</a></div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>Success!</b> <?= session()->getFlashData('success'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>My Post Kecelakaan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm table-striped">
                        <table class="table table-bordered table-md" id="table">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Judul Berita</th>
                                <th>Penulis Berita</th>
                                <th>Kategori Berita</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($beritaKecelakaan as $value) :
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $value['judul_berita']; ?></td>
                                    <td class="text-center"><?= $value['penulis_berita']; ?></td>
                                    <td class="text-center"><?= $value['kategori_berita']; ?></td>
                                    <td style="width: 15%;" class="text-center">
                                        <a href="/kecelakaan/detail/<?= $value['slug']; ?>" class="btn btn-success btn-sm"><i class="fas fa-info-circle"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>