<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/admin/data_kecelakaan" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Berita Kecelakaan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="/admin/proses_edit_kecelakaan/<?= $beritaKecelakaan['id_berita']; ?>" method="post" enctype="multipart/form-data" class="mt-3">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="slug" value="<?= $beritaKecelakaan['slug']; ?>">
                            <input type="hidden" name="gambarLamaBerita" value="<?= $beritaKecelakaan['gambar_berita']; ?>">
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('judul_berita')) ? 'is-invalid' : ''; ?>" name="judul_berita" value="<?= (old('judul_berita')) ? old('judul_berita') : $beritaKecelakaan['judul_berita'] ?>" autofocus required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul_berita'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penulis Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('created_by')) ? 'is-invalid' : ''; ?>" name="created_by" value="<?= (old('created_by')) ? old('created_by') : $beritaKecelakaan['created_by'] ?>" required>
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
                                            if ($beritaKecelakaan['kategori_id'] == '1') {
                                                echo '<option value="1" selected>Kecelakaan</option>';
                                            } else {
                                                echo '<option value="1">Kecelakaan</option>';
                                            }
                                            if ($beritaKecelakaan['kategori_id'] == '2') {
                                                echo '<option value="2" selected>Ekonomi</option>';
                                            } else {
                                                echo '<option value="2">Ekonomi</option>';
                                            }
                                            if ($beritaKecelakaan['kategori_id'] == '3') {
                                                echo '<option value="3" selected>Politik</option>';
                                            } else {
                                                echo '<option value="3">Politik</option>';
                                            }
                                            if ($beritaKecelakaan['kategori_id'] == '4') {
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
                                        <input id="isi_berita" type="hidden" name="isi_berita" value="<?= (old('isi_berita')) ? old('isi_berita') : $beritaKecelakaan['isi_berita'] ?>" required>
                                        <trix-editor input="isi_berita"></trix-editor>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview" class="image-preview h-100">
                                            <img src="/assets/images/resource_berita/<?= $beritaKecelakaan['gambar_berita']; ?>" class="img-thumbnail preview-img" />
                                            <label for="image-upload" id="image-label"><?= $beritaKecelakaan['gambar_berita']; ?></label>
                                            <input type="file" class="form-control" name="gambar_berita" id="image-upload" onchange="previewImg()" style="position:fixed;" />
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
</script>
<?= $this->endSection(); ?>