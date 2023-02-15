<header id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="navbar-top">
                <div class="d-flex justify-content-between align-items-center">
                    <ul class="navbar-top-left-menu">
                        <li class="nav-item <?= $uri->getPath() == '/home/laporkan' ? 'active' : ''; ?>">
                            <a href="<?= base_url('/home/laporkan'); ?>" class="nav-link">LAPORKAN</a>
                        </li>
                        <li class="nav-item <?= $uri->getPath() == '/home/tentang_kami' ? 'active' : ''; ?>">
                            <a href="<?= base_url('/home/tentang_kami'); ?>" class="nav-link">TENTANG KAMI</a>
                        </li>
                    </ul>
                    <ul class="navbar-top-right-menu">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
                                <?php if (in_groups('User')) : ?>
                                    <img alt="image" src="/assets/images/profile_users/<?= user()->profile_img; ?>" class="rounded-circle mr-1" width="40" height="40">
                                <?php elseif (in_groups('Admin')) :  ?>
                                    <img alt="image" src="/assets/images/profile_users/<?= user()->profile_img; ?>" class="rounded-circle mr-1" width="40" height="40">
                                <?php else : ?>
                                    <img alt="image" src="/assets/images/profile_users/default.png" class="rounded-circle mr-1" width="40" height="40">
                                <?php endif; ?>
                            </a>
                            <?php if (in_groups('User') && user()->jenis_akun_id == 1) : ?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-top: 7px;">
                                    <div class="text-center mb-2">
                                        <img class="img-profile rounded-circle mb-2" src="/assets/images/profile_users/<?= user()->profile_img; ?>" width="50"><br>
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="font-family: Arial;"><b><?= user()->username; ?></b></span><br>
                                        <span class="badge badge-pill badge-warning mt-2 text-white" style="font-family: Arial;">User Free</span>
                                    </div>
                                    <a href="/home/edit_profile" class="dropdown-item">
                                        <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Edit Profile
                                    </a>
                                    <a class="dropdown-item" href="<?= base_url('/home/pilih_langganan'); ?>">
                                        <i class="fas fa-money-bill fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Langganan
                                    </a>
                                    <a href="/home/history_pembayaran" class="dropdown-item">
                                        <i class="fa-solid fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                                        History
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('/logout'); ?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Logout
                                    </a>
                                </div>
                            <?php elseif (in_groups('User') && user()->jenis_akun_id == 2) : ?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-top: 7px;">
                                    <div class="text-center mb-3 mt-3">
                                        <img class="img-profile rounded-circle mb-2" src="/assets/images/profile_users/<?= user()->profile_img; ?>" width="50"><br>
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="font-family: Arial;"><b><?= user()->username; ?></b></span><br>
                                        <span class="badge badge-pill badge-success mt-2 text-white" style="font-family: Arial">User Premium</span>
                                    </div>
                                    <a href="/home/edit_profile" class="dropdown-item">
                                        <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Edit Profile
                                    </a>
                                    <a href="/home/edit_post" class="dropdown-item">
                                        <i class="fa-solid fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Edit Post
                                    </a>
                                    <a href="/home/history_pembayaran" class="dropdown-item mb-3">
                                        <i class="fa-solid fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                                        History
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('/logout'); ?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Logout
                                    </a>
                                </div>
                            <?php elseif (in_groups('Admin')) : ?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-top: 7px;">
                                    <div class="text-center mb-3 mt-3">
                                        <img class="img-profile rounded-circle mb-2" src="/assets/images/profile_users/<?= user()->profile_img; ?>" width="50"><br>
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="font-family: Arial;"><b><?= user()->username; ?></b></span><br>
                                        <span class="badge badge-pill badge-primary mt-2 text-white" style="font-family: Arial;">Admin</span>
                                    </div>
                                    <a href="/home/edit_profile" class="dropdown-item">
                                        <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Edit Profile
                                    </a>
                                    <a href="<?= base_url('/admin/dashboard'); ?>" class="dropdown-item mb-3" target="_blank">
                                        <i class="fa-solid fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                        My Admin
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('/logout'); ?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Logout
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-top: 7px;">
                                    <div class="text-center mb-3 mt-3">
                                        <img class="img-profile rounded-circle mb-2" src="/assets/images/profile_users/default.png" width="40"><br>
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="font-family: Arial;"><b>Akun Guest</b></span>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('/login'); ?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-success"></i>
                                        Login
                                    </a>
                                </div>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="navbar-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a class="navbar-brand" href="<?= base_url('/'); ?>"><img src="/assets/images/logo.svg" alt="" /></a>
                    </div>
                    <div>
                        <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <?php if (in_groups('User') && user()->jenis_akun_id == 1) : ?>
                            <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                    <li>
                                        <button class="navbar-close">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/' ? 'active' : ''; ?> ">
                                        <a class="nav-link" href="<?= base_url('/'); ?>">Beranda</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/ekonomi' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_ekonomi' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/politik' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_politik' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/politik'); ?>">Politik</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/kecelakaan' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_kecelakaan' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a>
                                    </li>
                                </ul>
                            </div>
                        <?php elseif (in_groups('User') && user()->jenis_akun_id == 2) : ?>
                            <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                    <li>
                                        <button class="navbar-close">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/' ? 'active' : ''; ?> ">
                                        <a class="nav-link" href="<?= base_url('/'); ?>">Beranda</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/ekonomi' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_ekonomi' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/politik' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_politik' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/politik'); ?>">Politik</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/kecelakaan' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_kecelakaan' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/olahraga' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_olahraga' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/olahraga'); ?>">Olahraga</a>
                                    </li>
                                </ul>
                            </div>
                        <?php elseif (in_groups('Admin')) : ?>
                            <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                    <li>
                                        <button class="navbar-close">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/' ? 'active' : ''; ?> ">
                                        <a class="nav-link" href="<?= base_url('/'); ?>">Beranda</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/ekonomi' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_ekonomi' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/politik' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_politik' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/politik'); ?>">Politik</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/kecelakaan' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_kecelakaan' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/olahraga' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_olahraga' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/olahraga'); ?>">Olahraga</a>
                                    </li>
                                </ul>
                            </div>
                        <?php else : ?>
                            <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                    <li>
                                        <button class="navbar-close">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/' ? 'active' : ''; ?> ">
                                        <a class="nav-link" href="<?= base_url('/'); ?>">Beranda</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/ekonomi' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_ekonomi' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/politik' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_politik' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/politik'); ?>">Politik</a>
                                    </li>
                                    <li class="nav-item <?= $uri->getPath() == '/home/kecelakaan' || $uri->getTotalSegments() >= 2 && $uri->getSegment(2) == 'detail_berita_kecelakaan' ? 'active' : ''; ?>">
                                        <a class="nav-link" href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <ul class="social-media">
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
            </div>
        </nav>
    </div>
</header>