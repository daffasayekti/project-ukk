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
                                <img alt="image" src="/assets/images/resource_berita/home_4.jpg" class="rounded-circle mr-1" width="40" height="40">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="features-profile.html" class="dropdown-item has-icon">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </a>
                                <a href="features-activities.html" class="dropdown-item has-icon">
                                    <i class="fas fa-user-cog"></i> Pengaturan Profile
                                </a>
                                <a href="<?= base_url('/home/berlangganan'); ?>" class="dropdown-item has-icon">
                                    <i class="fas fa-users-cog"></i> Halaman Admin
                                </a>
                                <a href="<?= base_url('/home/berlangganan'); ?>" class="dropdown-item has-icon">
                                    <i class="fas fa-money-bill"></i> Menu Berlangganan
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
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