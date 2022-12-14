<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('/admin/dashboard'); ?>">My Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('/admin/dashboard'); ?>">MA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item <?= $uri->getPath() == '/admin/dashboard' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url('/admin/dashboard'); ?>"><i class="fas fa-home"></i> <span>Dashboard Admin</span></a>
            </li>
            <li class="menu-header">Kelola Data</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i> <span>Data Berita</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item <?= $uri->getPath() == '/admin/data_kecelakaan' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/data_kecelakaan'); ?>">Kecelakaan</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/data_politik' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/data_politik'); ?>">Politik</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/data_ekonomi' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/data_ekonomi'); ?>">Ekonomi</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/data_olahraga' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/data_olahraga'); ?>">Olahraga</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/moderasi_berita' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/moderasi_berita'); ?>">Moderasi Berita</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/moderasi_laporan' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/moderasi_laporan'); ?>">Moderasi Laporan</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Data Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="<?= base_url('/admin/user_free'); ?>">Users Free</a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url('/admin/user_premium'); ?>">Users Premium</a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= base_url('/admin/admin'); ?>">Admin</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= $uri->getPath() == '/admin/data_komentar' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url('/admin/data_komentar'); ?>"><i class="fas fa-comment"></i> <span>Data Komentar</span></a>
            </li>
            <li class="nav-item <?= $uri->getPath() == '/admin/data_pembayaran' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url('/admin/data_pembayaran'); ?>"><i class="fas fa-money-bill"></i> <span>Data Pembayaran</span></a>
            </li>
            <li class="nav-item <?= $uri->getPath() == '/admin/data_invoice' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url('/admin/data_invoice'); ?>"><i class="fas fa-print"></i> <span>Data Invoice</span></a>
            </li>
        </ul>
    </aside>
</div>