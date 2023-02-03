<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/admin/data_kecelakaan" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Create Berita Kecelakaan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="/admin/proses_create_kecelakaan" method="post" enctype="multipart/form-data" class="mt-3">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('judul_berita')) ? 'is-invalid' : ''; ?>" name="judul_berita" value="<?= old('judul_berita'); ?>" autofocus autocomplete="off">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul_berita'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penulis Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('created_by')) ? 'is-invalid' : ''; ?>" name="created_by" value="<?= user()->username; ?>" autocomplete="off" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('created_by'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="kategori_id" id="kategori_id">
                                            <option selected>Pilih Kategori Berita</option>
                                            <?php foreach ($kategoriBerita as $value) : ?>
                                                <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tagline Berita</label>
                                    <div class="col-sm-12 col-md-7" id="field-tagline" style="color: black;">
                                        <input type="text" class="form-control" id="tagline" placeholder="Pilih Tagline Berita" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="isi_berita" type="hidden" name="isi_berita" value="<?= old('isi_berita'); ?>" class="form-control <?= ($validation->hasError('isi_berita')) ? 'is-invalid' : ''; ?>">
                                        <trix-editor input="isi_berita"></trix-editor>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('isi_berita'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <img src="/assets/images/default.jpg" class="img-thumbnail preview-img mb-3" width="250" />
                                        <div class="custom-file">
                                            <input type="file" class="form-control custom-file-input <?= ($validation->hasError('gambar_berita')) ? 'is-invalid' : ''; ?>" id="gambar_berita" name="gambar_berita" onchange="previewImg()">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('gambar_berita'); ?>
                                            </div>
                                            <label class="custom-file-label">Pilih File</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" type="submit">Create Berita</button>
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

    document.querySelector('#kategori_id').addEventListener('change', function() {
        var kategoriBerita = document.querySelector('#kategori_id').value;

        $.ajax({
            url: '/admin/getTagline/' + kategoriBerita,
            method: 'POST',
            success: function(data) {
                document.querySelector('#field-tagline').innerHTML = `
                    <select class="js-example-basic-multiple form-control" name="tagline[]" multiple="multiple" id="tagline">
                    ${data.map(item => `<option value="${item.nama_tags}">#${item.nama_tags}</option>`).join('')}
                    </select>
                `;

                $('.js-example-basic-multiple').select2({
                    tags: true
                });
            }
        })
    });
</script>
<?= $this->endSection(); ?>