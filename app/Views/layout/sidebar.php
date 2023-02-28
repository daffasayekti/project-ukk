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
            <li class="nav-item dropdown <?= $uri->getPath() == '/admin/kategori_berita' || $uri->getPath() == '/admin/jenis_langganan' || $uri->getPath() == '/admin/laporan_masyarakat' || $uri->getPath() == '/admin/tagline' || $uri->getSegment(2) == 'create_jenis_langganan' || $uri->getSegment(2) == 'edit_jenis_langganan' || $uri->getSegment(2) == 'create_tagline' || $uri->getSegment(2) == 'edit_tagline' ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-server"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= $uri->getPath() == '/admin/kategori_berita' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/kategori_berita'); ?>">Kategori Berita</a>
                    </li>
                    <li class="<?= $uri->getPath() == '/admin/jenis_langganan' || $uri->getSegment(2) == 'create_jenis_langganan' || $uri->getSegment(2) == 'edit_jenis_langganan' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/jenis_langganan'); ?>">Jenis Langganan</a>
                    </li>
                    <li class="<?= $uri->getPath() == '/admin/laporan_masyarakat' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/laporan_masyarakat'); ?>">Laporan Masyarakat</a>
                    </li>
                    <li class="<?= $uri->getPath() == '/admin/tagline' || $uri->getSegment(2) == 'create_tagline' || $uri->getSegment(2) == 'edit_tagline' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/tagline'); ?>">Tagline Berita</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown <?= $uri->getPath() == '/admin/data_kecelakaan' ||  $uri->getPath() == '/admin/data_politik' || $uri->getPath() == '/admin/data_ekonomi' || $uri->getPath() == '/admin/data_olahraga' || $uri->getPath() == '/admin/moderasi_berita' || $uri->getPath() == '/admin/moderasi_laporan' || $uri->getSegment(2) == 'create_berita_kecelakaan' || $uri->getSegment(2) == 'edit_berita_kecelakaan' || $uri->getSegment(2) == 'detail_kecelakaan' || $uri->getSegment(2) == 'create_berita_ekonomi' || $uri->getSegment(2) == 'edit_berita_ekonomi' || $uri->getSegment(2) == 'detail_ekonomi' || $uri->getSegment(2) == 'create_berita_politik' || $uri->getSegment(2) == 'edit_berita_politik' || $uri->getSegment(2) == 'detail_politik' || $uri->getSegment(2) == 'create_berita_olahraga' || $uri->getSegment(2) == 'edit_berita_olahraga' || $uri->getSegment(2) == 'detail_olahraga' || $uri->getSegment(2) == 'detail_berita_moderasi' ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i> <span>Data Berita</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item <?= $uri->getPath() == '/admin/data_kecelakaan' || $uri->getSegment(2) == 'create_berita_kecelakaan' || $uri->getSegment(2) == 'edit_berita_kecelakaan' || $uri->getSegment(2) == 'detail_kecelakaan' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/data_kecelakaan'); ?>">Kecelakaan</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/data_politik' || $uri->getSegment(2) == 'create_berita_politik' || $uri->getSegment(2) == 'edit_berita_politik' || $uri->getSegment(2) == 'detail_politik' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/data_politik'); ?>">Politik</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/data_ekonomi' || $uri->getSegment(2) == 'create_berita_ekonomi' || $uri->getSegment(2) == 'edit_berita_ekonomi' || $uri->getSegment(2) == 'detail_ekonomi' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/data_ekonomi'); ?>">Ekonomi</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/data_olahraga' || $uri->getSegment(2) == 'create_berita_olahraga' || $uri->getSegment(2) == 'edit_berita_olahraga' || $uri->getSegment(2) == 'detail_olahraga' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/data_olahraga'); ?>">Olahraga</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/moderasi_berita' ||  $uri->getSegment(2) == 'detail_berita_moderasi' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/moderasi_berita'); ?>">Moderasi Berita</a>
                    </li>
                    <li class="nav-item <?= $uri->getPath() == '/admin/moderasi_laporan' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/moderasi_laporan'); ?>">Moderasi Laporan</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown <?= $uri->getPath() == '/admin/user_free' || $uri->getPath() == '/admin/admin' || $uri->getPath() == '/admin/user_premium' || $uri->getSegment(2) == 'create_data_admin' ? 'active' : ''; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Data Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= $uri->getPath() == '/admin/user_free' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/user_free'); ?>">Users Free</a>
                    </li>
                    <li class="<?= $uri->getPath() == '/admin/user_premium' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/user_premium'); ?>">Users Premium</a>
                    </li>
                    <li class="<?= $uri->getPath() == '/admin/admin' || $uri->getSegment(2) == 'create_data_admin' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url('/admin/admin'); ?>">Admin</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= $uri->getPath() == '/admin/data_komentar' || $uri->getSegment(2) == 'detail_balas_komentar' ? 'active' : ''; ?>">
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