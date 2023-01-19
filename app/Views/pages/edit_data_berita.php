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
                            <h1 class="mt-3 text-center mb-4">
                                Edit Data Berita
                            </h1>
                            <form action="/home/proses_edit_berita/<?= $data_berita['id_berita']; ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="slug" value="<?= $data_berita['slug']; ?>">
                                <input type="hidden" name="gambarLamaBerita" value="<?= $data_berita['gambar_berita']; ?>">
                                <div class="row">
                                    <div class="col-lg-12 mb-5 mb-sm-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('judul_berita')) ? 'is-invalid' : ''; ?>" id="judul_berita" name="judul_berita" value="<?= (old('judul_berita')) ? old('judul_berita') : $data_berita['judul_berita'] ?>" placeholder="Judul Berita *" autofocus autocomplete="off" />
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('judul_berita'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('created_by')) ? 'is-invalid' : ''; ?>" id="created_by" name="created_by" placeholder="Penulis Berita *" autocomplete="off" value="<?= (old('created_by')) ? old('created_by') : $data_berita['created_by'] ?>" readonly />
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('created_by'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <select class="custom-select form-control" id="kategori_id" name="kategori_id">
                                                        <?php
                                                        if ($data_berita['kategori_id'] == '1') {
                                                            echo '<option value="1" selected>Kecelakaan</option>';
                                                        } else {
                                                            echo '<option value="1">Kecelakaan</option>';
                                                        }
                                                        if ($data_berita['kategori_id'] == '2') {
                                                            echo '<option value="2" selected>Ekonomi</option>';
                                                        } else {
                                                            echo '<option value="2">Ekonomi</option>';
                                                        }
                                                        if ($data_berita['kategori_id'] == '3') {
                                                            echo '<option value="3" selected>Politik</option>';
                                                        } else {
                                                            echo '<option value="3">Politik</option>';
                                                        }
                                                        if ($data_berita['kategori_id'] == '4') {
                                                            echo '<option value="4" selected>Olahraga</option>';
                                                        } else {
                                                            echo '<option value="4">Olahraga</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input id="isi_berita" type="hidden" name="isi_berita" value="<?= (old('isi_berita')) ? old('isi_berita') : $data_berita['isi_berita'] ?>" class="form-control <?= ($validation->hasError('isi_berita')) ? 'is-invalid' : ''; ?>">
                                                    <trix-editor input="isi_berita"></trix-editor>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('isi_berita'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <img src="/assets/images/resource_berita/<?= $data_berita['gambar_berita']; ?>" class="img-thumbnail preview-img mb-3" width="300" />
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control custom-file-input <?= ($validation->hasError('gambar_berita')) ? 'is-invalid' : ''; ?>" id="gambar_berita" name="gambar_berita" onchange="previewImg()">
                                                        <label class="custom-file-label"><?= $data_berita['gambar_berita']; ?></label>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('gambar_berita'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-dark font-weight-bold mt-3">Create Berita</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImg() {
        const gambar = document.querySelector('#gambar_berita');
        const gambarLabel = document.querySelector('.custom-file-label');
        const imgProfile = document.querySelector('.preview-img');

        gambarLabel.textContent = gambar.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(gambar.files[0]);

        fileSampul.onload = function(e) {
            imgProfile.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>