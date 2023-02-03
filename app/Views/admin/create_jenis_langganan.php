<?= $this->extend('/layout/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/admin/jenis_langganan" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Create Jenis Langganan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="/admin/proses_create_jenis_langganan" method="post" enctype="multipart/form-data" class="mt-3">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Langganan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_langganan')) ? 'is-invalid' : ''; ?>" name="nama_langganan" value="<?= old('nama_langganan'); ?>" autofocus autocomplete="off">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_langganan'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Langganan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('jenis_langganan')) ? 'is-invalid' : ''; ?>" name="jenis_langganan" value="<?= old('jenis_langganan'); ?>" autocomplete="off" id="jenis_langganan">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jenis_langganan'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Waktu Langganan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?= ($validation->hasError('waktu_langganan')) ? 'is-invalid' : ''; ?>" name="waktu_langganan" value="<?= old('waktu_langganan'); ?>" autocomplete="off" id="waktu_langganan">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('waktu_langganan'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Langganan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" class="form-control <?= ($validation->hasError('harga_langganan')) ? 'is-invalid' : ''; ?>" name="harga_langganan" autocomplete="off" value="<?= old('harga_langganan'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('harga_langganan'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" type="submit">Create Langganan</button>
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