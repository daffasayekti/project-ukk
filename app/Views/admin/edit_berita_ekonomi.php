<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/admin/data_ekonomi" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Berita Ekonomi</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="/admin/proses_edit_ekonomi/<?= $beritaEkonomi['id_berita']; ?>" method="post" enctype="multipart/form-data" class="mt-3">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="slug" value="<?= $beritaEkonomi['slug']; ?>">
                            <input type="hidden" name="gambarLamaBerita" value="<?= $beritaEkonomi['gambar_berita']; ?>">
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('judul_berita')) ? 'is-invalid' : ''; ?>" name="judul_berita" value="<?= (old('judul_berita')) ? old('judul_berita') : $beritaEkonomi['judul_berita'] ?>" autofocus autocomplete="off">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul_berita'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penulis Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('created_by')) ? 'is-invalid' : ''; ?>" name="created_by" value="<?= (old('created_by')) ? old('created_by') : $beritaEkonomi['created_by'] ?>" autocomplete="off" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('created_by'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="kategori_id">
                                            <?php
                                            if ($beritaEkonomi['kategori_id'] == '1') {
                                                echo '<option value="1" selected>Kecelakaan</option>';
                                            } else {
                                                echo '<option value="1">Kecelakaan</option>';
                                            }
                                            if ($beritaEkonomi['kategori_id'] == '2') {
                                                echo '<option value="2" selected>Ekonomi</option>';
                                            } else {
                                                echo '<option value="2">Ekonomi</option>';
                                            }
                                            if ($beritaEkonomi['kategori_id'] == '3') {
                                                echo '<option value="3" selected>Politik</option>';
                                            } else {
                                                echo '<option value="3">Politik</option>';
                                            }
                                            if ($beritaEkonomi['kategori_id'] == '4') {
                                                echo '<option value="4" selected>Olahraga</option>';
                                            } else {
                                                echo '<option value="4">Olahraga</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="isi_berita" type="hidden" name="isi_berita" value="<?= (old('isi_berita')) ? old('isi_berita') : $beritaEkonomi['isi_berita'] ?>" class="form-control <?= ($validation->hasError('isi_berita')) ? 'is-invalid' : ''; ?>">
                                        <trix-editor input="isi_berita"></trix-editor>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('isi_berita'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <img src="/assets/images/resource_berita/<?= $beritaEkonomi['gambar_berita']; ?>" class="img-thumbnail preview-img mb-4" width="250" />
                                        <div class="custom-file">
                                            <input type="file" class="form-control custom-file-input <?= ($validation->hasError('gambar_berita')) ? 'is-invalid' : ''; ?>" name="gambar_berita" id="gambar_berita" onchange="previewImg()" />
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('gambar_berita'); ?>
                                            </div>
                                            <label class="custom-file-label"><?= $beritaEkonomi['gambar_berita']; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" type="submit">Edit Berita</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault()
    })

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