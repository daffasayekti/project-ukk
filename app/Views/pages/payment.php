<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="flash-news-banner">
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash News</span>
                <p class="mb-0">
                </p>
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
                            <h2 class="mt-3 mb-3 text-center mb-3">
                                Detail Pembayaran
                            </h2>
                            <div class="row">
                                <table class="table mt-3 mb-3 table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Nama Langganan</td>
                                            <td><?= $data_langganan['nama_langganan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Langganan</td>
                                            <td><?= $data_langganan['jenis_langganan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Langganan</td>
                                            <td>Rp. <?= number_format($data_langganan['harga_langganan'], 0, ",", "."); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td><?= user()->username ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?= user()->email ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php if ($data_pembayaran == null) : ?>
                                    <button id="pay-button" class="btn btn-primary mt-2">Bayar</button>
                                <?php elseif ($data_pembayaran['status_pembayaran'] == 'pending') : ?>
                                    <a href="/" class="btn btn-primary mt-2 ml-2"><i class="fas fa-arrow-alt-circle-left mr-1"></i> Kembali Halaman Utama</a>
                                <?php elseif ($data_pembayaran['status_pembayaran'] == 'settlement') : ?>
                                    <a href="/payment/detail_invoice/<?= $data_pembayaran['id_pembayaran']; ?>" class="btn btn-success mt-2 ml-2"><i class="fas fa-save mr-1"></i> Detail Invoice</a>
                                    <a href="/" class="btn btn-primary mt-2 ml-2"><i class="fas fa-arrow-alt-circle-left mr-1"></i> Kembali Halaman Utama</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="
SB-Mid-client-7zf0YflUfO844bEx"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        snap.pay('<?= $snapToken ?>', {
            onSuccess: function(result) {
                $.ajax({
                    url: '/payment/save',
                    method: 'POST',
                    data: {
                        ...result,
                        id_langganan: <?= $data_langganan['id_langganan'] ?>,
                        id_pelanggan: <?= user()->id ?>
                    },
                    success: function(res) {}
                })
            },
            onPending: function(result) {
                $.ajax({
                    url: '/payment/save',
                    method: 'POST',
                    data: {
                        ...result,
                        id_langganan: <?= $data_langganan['id_langganan'] ?>,
                        id_pelanggan: <?= user()->id ?>
                    },
                    success: function(res) {}
                })
            },
            onError: function(result) {
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
    };
</script>
<?= $this->endSection(); ?>