<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="flash-news-banner">
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash News</span>
                <marquee class="mb-0" direction="right">
                    <?= $data_laporan['isi_pesan']; ?>
                </marquee>
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
                                Laporkan Kejadian Disekitarmu
                            </h1>
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
                            <div class="row">
                                <div class="col-lg-12 mb-5 mb-sm-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control textarea" placeholder="Ketik Pesan *" id="pesan" name="pesan" autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Pengirim *" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select class="custom-select form-control" id="nomer_whatsapp" name="nomer_whatsapp">
                                                    <option value="085655385882">+6285655385882 (Admin 1)</option>
                                                    <option value="089699397150">+6289699397150 (Admin 2)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-dark font-weight-bold mt-3" id="kirim_whatsapp">Kirim Whatsapp</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#kirim_whatsapp').on('click', function() {
        var nomer_whatsapp = document.getElementById('nomer_whatsapp').value;
        var pesan = document.getElementById('pesan').value;
        var nama_lengkap = document.getElementById('nama_lengkap').value;
        $.ajax({
            url: 'http://localhost:3000/api?nowhatsapp=' + nomer_whatsapp + '&pesan=' + pesan,
            method: 'GET',
            data: {},
            success: function(res) {
                saveLaporan();
                pesan.value = "";
                nomer_whatsapp.value = "";
            }
        });
    });

    function saveLaporan() {
        $.ajax({
            url: '/home/proses_laporkan',
            method: 'POST',
            data: {
                nomer_whatsapp: nomer_whatsapp.value,
                pesan: pesan.value,
                nama_lengkap: nama_lengkap.value,
            },
            success: function(res) {
                nomer_whatsapp.value = "";
                pesan.value = "";
            }
        });

        window.location.href = '/home/laporkan';
    }
</script>
<?= $this->endSection(); ?>