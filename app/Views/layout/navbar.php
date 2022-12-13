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
        <div class="search-item">
          <a href="#">Berita Olahraga</a>
          <a href="#" class="search-close"><i class="fas fa-times"></i></a>
        </div>
      </div>
    </div>
  </form>
  <ul class="navbar-nav navbar-right">
    <?php if (count($notifikasi_berita) || count($notifikasi_pembayaran)) : ?>
      <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep active"><i class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
          <div class="dropdown-header">Notifikasi
          </div>
          <div class="dropdown-list-content dropdown-list-icons">
            <?php foreach ($notifikasi_berita as $value) : ?>
              <a href="<?= base_url('/admin/moderasi_berita'); ?>" class="dropdown-item dropdown-item-unread">
                <div class="dropdown-item-icon bg-primary text-white">
                  <i class="fas fa-newspaper"></i>
                </div>
                <div class="dropdown-item-desc">
                  <?php if ($value['kategori_id'] == 1) : ?>
                    Silahkan Moderasi Berita Kecelakaan dengan ID-<?= $value['id_berita']; ?>
                  <?php elseif ($value['kategori_id'] == 2) : ?>
                    Silahkan Moderasi Berita Ekonomi dengan ID-<?= $value['id_berita']; ?>
                  <?php elseif ($value['kategori_id'] == 3) : ?>
                    Silahkan Moderasi Berita Politik dengan ID-<?= $value['id_berita']; ?>
                  <?php elseif ($value['kategori_id'] == 4) : ?>
                    Silahkan Moderasi Berita Olahraga dengan ID-<?= $value['id_berita']; ?>
                  <?php endif; ?>
                  <div class="time text-primary"><?= tgl_indo_sekarang($value['tanggal_buat']); ?></div>
                </div>
              </a>
            <?php endforeach; ?>
            <?php foreach ($notifikasi_pembayaran as $value) : ?>
              <a href="<?= base_url('/admin/data_pembayaran'); ?>" class="dropdown-item dropdown-item-unread">
                <div class="dropdown-item-icon bg-success text-white">
                  <i class="fas fa-money-bill"></i>
                </div>
                <div class="dropdown-item-desc">
                  Silahkan Check Status Pembayaran dengan Order ID-<?= $value['order_id']; ?>
                  <div class="time text-primary"><?= tgl_indo_sekarang($value['tanggal_pembayaran']); ?></div>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
          <div class="dropdown-footer text-center">
            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </li>
    <?php else : ?>
      <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
      </li>
    <?php endif; ?>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
        <img alt="image" src="/assets/images/profile_users/<?= user()->profile_img; ?>" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">Hi, <?= user()->username; ?></div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="<?= base_url('/'); ?>" class="dropdown-item has-icon">
          <i class="fas fa-newspaper"></i> Halaman Utama
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?= base_url('/logout'); ?>" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>