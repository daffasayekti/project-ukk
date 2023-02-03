<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/admin/tagline" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Tagline Berita</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="/admin/proses_edit_tagline_berita/<?= $data_tagline['id_tags']; ?>" method="post" enctype="multipart/form-data" class="mt-3">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Tagline</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_tags')) ? 'is-invalid' : ''; ?>" name="nama_tags" value="<?= (old('nama_tags')) ? old('nama_tags') : $data_tagline['nama_tags'] ?>" autofocus autocomplete="off">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_tags'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori Berita</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="kategori_id">
                                            <?php foreach ($kategoriBerita as $value) : ?>
                                                <?php if ($data_tagline['kategori_id'] == $value['id_kategori']) : ?>
                                                    <option value="<?= $data_tagline['kategori_id']; ?>" selected><?= $value['nama_kategori']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" type="submit">Edit Tagline</button>
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
    document.querySelector('#jenis_langganan').addEventListener('change', function() {
        var jenisLangganan = document.querySelector('#jenis_langganan').value.split(' ')[0];
        var waktu = jenisLangganan * 30;

        document.querySelector('#waktu_langganan').value = waktu + ' Hari';
    });
</script>
<?= $this->endSection(); ?>