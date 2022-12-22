<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="container">
        <div class="col-sm-12">
            <div class="card" data-aos="fade-up">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div>
                                <h1 class="font-weight-600 mb-1">
                                    <?= $detailOlahraga['judul_berita']; ?>
                                </h1>
                                <p class="fs-13 text-muted mb-0 mt-2">
                                    <span class="mr-2"><i class="fa-solid fa-clock"></i> </span><?= tgl_indo_model_2(date($detailOlahraga['tanggal_buat'])); ?>
                                </p>
                                <img src="/assets/images/resource_berita/<?= $detailOlahraga['gambar_berita']; ?>" alt="banner" class="img-fluid mt-4 mb-4" />
                                <div style="text-align: justify; line-height: 1.7;">
                                    <p class="mb-4 fs-15">
                                        <?= $detailOlahraga['isi_berita']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="d-lg-flex mt-3">
                                <span class="fs-16 font-weight-600 mr-2 mb-1">Tags</span>
                                <span class="badge badge-outline-dark mr-2 mb-1">Olahraga</span>
                                <span class="badge badge-outline-dark mr-2 mb-1">Olahraga</span><span class="badge badge-outline-dark mr-2 mb-1">Olahraga</span><span class="badge badge-outline-dark mr-2 mb-1">Olahraga</span><span class="badge badge-outline-dark mb-1">Olahraga</span>
                            </div>
                            <div class="post-comment-section">
                                <?php if (in_groups('User') || in_groups('Admin')) : ?>
                                    <div class="testimonial">
                                        <div class="d-lg-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="/assets/images/profile_users/<?= $detailOlahraga['profile_img']; ?>" alt="banner" class="img-fluid img-rounded mr-3" />
                                                <div>
                                                    <p class="fs-12 mb-1 line-height-xs">
                                                        Penulis Berita
                                                    </p>
                                                    <p class="fs-16 font-weight-600 mb-0 line-height-xs">
                                                        <?= $detailOlahraga['username']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <ul class="social-media mb-3">
                                                <li>
                                                    <a href="#">
                                                        <i class="mdi mdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="mdi mdi-youtube"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="mdi mdi-twitter"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="comment-section">
                                    <?php if (in_groups('User') || in_groups('Admin')) : ?>
                                        <h5 class="font-weight-600">Kolom Komentar</h5>
                                        <div class="testimonial">
                                            <div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="/assets/images/profile_users/<?= user()->profile_img; ?>" alt="banner" class="img img-rounded mr-3" />
                                                    <p class="fs-16 font-weight-600 mb-0 line-height-xs">
                                                        <?= user()->username; ?>
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control komentar" cols="50" name="isi_komentar" id="isi_komentar" placeholder="Tulis Komentar...">

                                                </textarea>
                                                </div>
                                                <button id="komentarOlahraga" class="btn btn-primary">Kirim</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div id="comments">
                                        <?php foreach ($komentarOlahraga as $i => $value) { ?>
                                            <div class="comment-box">
                                                <div class="d-flex align-items-center">
                                                    <img src="/assets/images/profile_users/<?= $value['profile_img']; ?>" alt="banner" class="img-fluid img-rounded mr-3" />
                                                    <div>
                                                        <p class="fs-12 mb-1 line-height-xs">
                                                            <?= tgl_indo_model_2(date($value['tanggal_komentar'])); ?>
                                                        </p>
                                                        <p class="fs-16 font-weight-600 mb-0 line-height-xs">
                                                            <?= $value['username']; ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                <p class="fs-12 mt-3">
                                                    <?= $value['isi_komentar']; ?>
                                                </p>
                                                <?php if (in_groups('User') || in_groups('Admin')) : ?>
                                                    <h5 class="text-primary balas-komentar" data-index="<?= $i ?>" style="font-size: 14px; cursor:pointer"><b>Balas Komentar</b></h5>
                                                    <div class="textarea-balas"></div>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h2 class="mb-4 text-primary font-weight-600">
                                Berita Terbaru
                            </h2>
                            <div class="row">
                                <?php foreach ($berita_olahraga_terbaru as $value) { ?>
                                    <div class="col-sm-12">
                                        <div class="border-bottom pb-4 pt-4">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <h5 class="font-weight-600 mb-1">
                                                        <a href="/home/detail_berita_olahraga/<?= $value['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $value['judul_berita']; ?></a>
                                                    </h5>
                                                    <p class="fs-13 text-muted mb-0">
                                                        <span class="mr-2"><i class="fa-solid fa-clock"></i> </span><?= tgl_indo_model_2(date($value['tanggal_buat'])); ?>
                                                    </p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="rotate-img">
                                                        <img src="/assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="banner" class="img-fluid" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="trending">
                                <h2 class="mb-4 text-primary font-weight-600">
                                    Berita Trending
                                </h2>
                                <?php foreach ($berita_olahraga_trending as $value) { ?>
                                    <div class="mb-4">
                                        <div class="rotate-img">
                                            <img src="/assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="banner" class="img-fluid" />
                                        </div>
                                        <h3 class="mt-3 font-weight-600">
                                            <a href="/home/detail_berita_olahraga/<?= $value['slug']; ?>" style="text-decoration: none; color: #434a54"><?= $value['judul_berita']; ?></a>
                                        </h3>
                                        <p class="fs-13 text-muted mb-0">
                                            <span class="mr-2"><i class="fa-solid fa-clock"></i> </span><?= tgl_indo_model_2(date($value['tanggal_buat'])); ?>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#komentarOlahraga').on('click', function() {
        var isi_komentar = document.getElementById('isi_komentar');
        $.ajax({
            url: '/home/komentar_olahraga1',
            method: 'POST',
            data: {
                id_berita: <?= $detailOlahraga['id_berita'] ?>,
                created_by: '<?= in_groups('User') || in_groups('Admin') ? user()->username : 'Guest'; ?>',
                isi_komentar: isi_komentar.value
            },
            success: function(res) {
                getKomentarOlahraga();
                isi_komentar.value = "";
            }
        })
    });

    function getKomentarOlahraga() {
        $.ajax({
            url: '/home/get_komentar_olahraga/<?= $detailOlahraga['id_berita'] ?>',
            method: 'GET',
            success: function(data) {
                document.getElementById('comments').innerHTML = data.map((item, i) => `
                <div class="comment-box">
                    <div class="d-flex align-items-center">
                        <img src="/assets/images/profile_users/${item.profile_img}" alt="banner" class="img-fluid img-rounded mr-3" />
                        <div>
                            <p class="fs-12 mb-1 line-height-xs">
                                ${item . tanggal_komentar}
                            </p>
                            <p class="fs-16 font-weight-600 mb-0 line-height-xs">
                                ${item.username}
                            </p>
                        </div>
                    </div>

                    <p class="fs-12 mt-3">
                        ${item.isi_komentar}
                    </p>

                    <h5 class="text-primary balas-komentar" data-index="${i}" style="font-size: 14px; cursor:pointer"><b>Balas Komentar</b></h5>
                    <div class="textarea-balas"></div>
                </div>
                `).join('')
            }
        })
    }

    $('.content-wrapper').on('click', '.balas-komentar', function() {
        var index = $(this).data('index');
        if (!document.querySelectorAll('.textarea-balas')[index].querySelector('textarea')) {
            document.querySelectorAll('.textarea-balas')[index].innerHTML = `<textarea class="form-control komentar mt-3" cols="30" name="balas_komentar" id="balas_komentar" placeholder="Tulis Komentar..."></textarea>
            <button class="btn btn-primary mt-3" id="komentarEkonomi">Kirim</button>`
        } else {
            document.querySelectorAll('.textarea-balas')[index].innerHTML = ''
        }
    });
</script>
<?= $this->endSection(); ?>