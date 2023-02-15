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
                                Create Data Berita
                            </h1>
                            <form action="/home/proses_create_berita" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 mb-5 mb-sm-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('judul_berita')) ? 'is-invalid' : ''; ?>" id="judul_berita" name="judul_berita" value="<?= old('judul_berita'); ?>" placeholder="Judul Berita *" autocomplete="off" />
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('judul_berita'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control <?= ($validation->hasError('created_by')) ? 'is-invalid' : ''; ?>" id="created_by" name="created_by" placeholder="Penulis Berita *" autocomplete="off" value="<?= user()->username; ?>" readonly />
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('created_by'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <select class="custom-select form-control" id="kategori_id" name="kategori_id" id="kategori_id">
                                                        <option selected>Pilih Kategori Berita</option>
                                                        <?php foreach ($kategoriBerita as $value) : ?>
                                                            <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div id="field-tagline">
                                                        <input type="text" class="form-control" id="tagline" placeholder="Pilih Tagline Berita" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input id="isi_berita" type="hidden" name="isi_berita" value="<?= old('isi_berita'); ?>" class="form-control <?= ($validation->hasError('isi_berita')) ? 'is-invalid' : ''; ?>">
                                                    <trix-editor input="isi_berita"></trix-editor>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('isi_berita'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <img src="/assets/images/default.jpg" class="img-thumbnail preview-img mb-3" width="300" />
                                                    <div class="input-group">
                                                        <input type="file" class="custom-file-input form-control <?= ($validation->hasError('gambar_berita')) ? 'is-invalid' : ''; ?>" id="gambar_berita" name="gambar_berita" onchange="previewImg()">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('gambar_berita'); ?>
                                                        </div>
                                                        <label class="custom-file-label">Pilih File</label>
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