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
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <?php if (in_groups('User')) : ?>
                    <img alt="image" src="/images/profile_users/<?= user()->profile_img; ?>" class="rounded-circle mr-1">
                <?php else : ?>
                    <img alt="image" src="/images/profile_users/default.png" class="rounded-circle mr-1">
                <?php endif; ?>
                <?php if (in_groups('User')) : ?>
                    <div class="d-sm-none d-lg-inline-block">Hi, <?= (user()->username); ?></div>
                <?php else : ?>
                    <div class="d-sm-none d-lg-inline-block">Hi, Guest</div>
                <?php endif; ?>
            </a>
            <?php if (in_groups('User')) : ?>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="text-center mt-3">
                        <figure class="avatar avatar-md mb-2">
                            <img src="/images/profile_users/<?= user()->profile_img; ?>">
                            <i class="avatar-presence online"></i>
                        </figure><br>
                        <a class="d-sm-none d-lg-inline-block"><?= user()->username; ?></a><br>
                        <a href="#" class="badge badge-success"><?= user()->jenis_users; ?></a>
                    </div>
                    <hr>
                    <a href="/pages/edit_profile/<?= user()->id; ?>" class="dropdown-item has-icon">
                        <i class="fas fa-cogs"></i> Edit Profile
                    </a>
                    <a href="<?= base_url('logout'); ?>" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            <?php else : ?>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="text-center mt-3">
                        <figure class="avatar avatar-md mb-2">
                            <img src="/images/profile_users/default.png">
                            <i class="avatar-presence online"></i>
                        </figure><br>
                        <a class="d-sm-none d-lg-inline-block">Guest</a>
                    </div>
                    <hr>
                    <a href="/login" class="dropdown-item has-icon">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </div>
            <?php endif; ?>
        </li>
    </ul>
</nav>