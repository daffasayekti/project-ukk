<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto" action="" method="post">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
                <div class="search-header">
                    Histories
                </div>
                <div class="search-item">
                    <a href="#">Berita Kecelakaan</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-item">
                    <a href="#">Berita Ekonomi</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-item">
                    <a href="#">Berita Politik</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
            </div>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="mdi mdi-magnify"></i></a>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link">
                <?php if (in_groups('User')) : ?>
                    <img alt="image" src="/assets/images/profile_users/<?= user()->profile_img; ?>" class="rounded-circle mr-1" width="39" height="39">
                <?php elseif (in_groups('Admin')) :  ?>
                    <img alt="image" src="/assets/images/profile_users/<?= user()->profile_img; ?>" class="rounded-circle mr-1" width="39" height="39">
                <?php else : ?>
                    <img alt="image" src="/assets/images/profile_users/default.png" class="rounded-circle mr-1" width="39" height="39">
                <?php endif; ?>
            </a>
            <?php if (in_groups('User') && user()->jenis_akun_id == 1) : ?>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="margin-top: 7px;">
                    <div class="text-center mb-2">
                        <img class="img-profile rounded-circle mb-2" src="/assets/images/profile_users/<?= user()->profile_img; ?>" width="50"><br>
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?= user()->username; ?></b></span><br>
                        <span class="badge badge-pill badge-warning mt-2">User Free</span>
                    </div>
                    <a href="<?= base_url('/'); ?>" class="dropdown-item">
                        <i class="fas fa-newspaper fa-sm fa-fw mr-2 text-gray-400"></i>
                        Halaman Utama
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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?= user()->username; ?></b></span><br>
                        <span class="badge badge-pill badge-success mt-2">User Premium</span>
                    </div>
                    <a href="<?= base_url('/'); ?>" class="dropdown-item">
                        <i class="fas fa-newspaper fa-sm fa-fw mr-2 text-gray-400"></i>
                        Halaman Utama
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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?= user()->username; ?></b></span><br>
                        <span class="badge badge-pill badge-primary mt-2">Admin</span>
                    </div>
                    <a href="<?= base_url('/'); ?>" class="dropdown-item">
                        <i class="fas fa-newspaper fa-sm fa-fw mr-2 text-gray-400"></i>
                        Halaman Utama
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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b>Guest</b></span>
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
</nav>