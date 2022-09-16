<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('/admin/dashboard'); ?>">My-Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('/admin/dashboard'); ?>">MA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Berita Terbaru</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Berita Terbaru</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= site_url('/'); ?>">Kecelakaan</a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= site_url('/pages/berita_terbaru_ekonomi'); ?>">Ekonomi</a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= site_url('/pages/berita_terbaru_politik'); ?>">Politik</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Kategori Berita</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-car-crash"></i> <span>Kecelakaan</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= site_url('/kecelakaan/lalu_lintas'); ?>">Lalu Lintas</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-bill"></i> <span>Ekonomi</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= site_url('/ekonomi/kemiskinan'); ?>">Kemiskinan</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tie"></i> <span>Politik</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= site_url('/politik/pemilihan_umum'); ?>">Pemilihan Umum</a></li>
                </ul>
            </li>
            <?php if (in_groups('User') && user()->jenis_users == 'Premium') : ?>
                <li class="menu-header">My Post</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i> <span>My Post</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?= site_url('/kecelakaan/my_post_kecelakaan'); ?>">Kecelakaan</a></li>
                        <li><a class="nav-link" href="<?= site_url('/ekonomi/my_post_ekonomi'); ?>">Ekonomi</a></li>
                        <li><a class="nav-link" href="<?= site_url('/politik/my_post_politik'); ?>">Politik</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-pencil-alt"></i> <span>Edit Post</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?= site_url('/kecelakaan/edit_post_kecelakaan'); ?>">Kecelakaan</a></li>
                        <li><a class="nav-link" href="<?= site_url('/ekonomi/edit_post_ekonomi'); ?>">Ekonomi</a></li>
                        <li><a class="nav-link" href="<?= site_url('/politik/edit_post_politik'); ?>">Politik</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </aside>
</div>