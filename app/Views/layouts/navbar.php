<header id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="navbar-top">
                <div class="d-flex justify-content-between align-items-center">
                    <ul class="navbar-top-left-menu">
                        <li class="nav-item">
                            <a href="<?= base_url('/home/pemberitahuan'); ?>" class="nav-link">Pemberitahuan</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/home/tentang_kami'); ?>" class="nav-link">Tentang Kami</a>
                        </li>
                    </ul>
                    <ul class="navbar-top-right-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link"><i class="mdi mdi-magnify"></i></a>
                        </li>
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
                                        <img class="img-profile rounded-circle mb-2" src="/assets/images/profile_users/<?= user()->profile_img; ?>" width="40"><br>
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?= user()->username; ?></b></span>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#editprofile" class="dropdown-item">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Edit Profile
                                    </a>
                                    <a class="dropdown-item" href="<?= base_url('/admin/dashboard'); ?>">
                                        <i class="fas fa-money-bill fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Langganan
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('/logout'); ?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Logout
                                    </a>
                                </div>
                            <?php elseif (in_groups('User') && user()->jenis_akun_id == 2) : ?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-top: 7px;">
                                    <div class="text-center mb-2">
                                        <img class="img-profile rounded-circle mb-2" src="/assets/images/profile_users/<?= user()->profile_img; ?>" width="40"><br>
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?= user()->username; ?></b></span>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#editprofile" class="dropdown-item">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Edit Profile
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#editprofile" class="dropdown-item">
                                        <i class="fa-solid fa-gear fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Edit Post
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('/logout'); ?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Logout
                                    </a>
                                </div>
                            <?php elseif (in_groups('Admin')) : ?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-top: 7px;">
                                    <div class="text-center mb-2">
                                        <img class="img-profile rounded-circle mb-2" src="/assets/images/profile_users/<?= user()->profile_img; ?>" width="40"><br>
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?= user()->username; ?></b></span>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#editprofile" class="dropdown-item">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Edit Profile
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#editprofile" class="dropdown-item">
                                        <i class="fa-solid fa-user-tie fa-sm fa-fw mr-2 text-gray-400"></i>
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
                                    <div class="text-center mb-2">
                                        <img class="img-profile rounded-circle mb-2" src="/assets/images/profile_users/default.png" width="40"><br>
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b>Guest</b></span>
                                    </div>
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
                        <div class="navbar-collapse justify-content-center collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav d-lg-flex justify-content-between align-items-center">
                                <li>
                                    <button class="navbar-close">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?= base_url('/'); ?>">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('/home/ekonomi'); ?>">Ekonomi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('/home/politik'); ?>">Politik</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('/home/kecelakaan'); ?>">Kecelakaan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('/home/olahraga'); ?>">Olahraga</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="social-media">
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
        </nav>
    </div>
</header>