<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <img src="/assets/images/logo.svg" class="footer-logo" alt="" />
                    <h5 class="font-weight-normal mt-4 mb-5">
                        World Time adalah website portal berita yang berdiri pada tahun 2022, dibuat oleh Daffa Pratama A.S untuk keperluan Tugas Akhir (UKK).
                    </h5>
                    <ul class="social-media mb-3">
                        <li>
                            <a href="https://www.facebook.com/daffa.sayekti.733/" target="_blank">
                                <i class="mdi mdi-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UCFlbmXEPFLh68zA4oLORovw" target="_blank">
                                <i class="mdi mdi-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/daffasayekti" target="_blank">
                                <i class="mdi mdi-github-circle"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h3 class="font-weight-bold mb-3">POSTINGAN TERBARU</h3>
                    <?php foreach ($berita_ekonomi_terbaru as $value) { ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="footer-border-bottom pb-2 pt-2">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="/assets/images/resource_berita/<?= $value['gambar_berita']; ?>" alt="thumb" class="img-fluid" />
                                        </div>
                                        <div class="col-9">
                                            <h5 class="font-weight-600">
                                                <a href="/home/detail_berita_ekonomi/<?= $value['slug']; ?>" style="text-decoration: none; color: white"><?= $value['judul_berita']; ?></a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-sm-3">
                    <h3 class="font-weight-bold mb-3">KATEGORI BERITA</h3>
                    <?php if (in_groups('User') && user()->jenis_akun_id == 2) : ?>
                        <div class="footer-border-bottom pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Ekonomi</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Politik</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Kecelakaan</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Olahraga</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                    <?php elseif (in_groups('Admin') && user()->jenis_akun_id == 3) : ?>
                        <div class="footer-border-bottom pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Ekonomi</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Politik</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Kecelakaan</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Olahraga</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                    <?php elseif (in_groups('User') && user()->jenis_akun_id == 1) : ?>
                        <div class="footer-border-bottom pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Ekonomi</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Politik</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Kecelakaan</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="footer-border-bottom pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Ekonomi</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Politik</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                        <div class="footer-border-bottom pb-2 pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-600">Kecelakaan</h5>
                                <div class="count">!</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div class="fs-14 font-weight-600">
                            © 2023 @ <a href="<?= base_url('/'); ?>" class="text-white"> Daffa Pratama A.S</a>. All rights reserved.
                        </div>
                        <div class="fs-14 font-weight-600">
                            Created by <a href="<?= base_url('/'); ?>" class="text-white">Daffa Pratama A.S</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>