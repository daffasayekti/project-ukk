<?= $this->extend('/layouts/templates'); ?>

<?= $this->section('content') ?>
<div class="flash-news-banner">
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash News</span>
                <marquee class="mb-0" direction="right">
                    <?= $data_laporan['isi_pesan']; ?>
                </marquee>
            </div>
            <div class="d-flex">
                <span class="mr-3 text-danger">
                    <?= tgl_indo_sekarang(date("Y-m-d")); ?>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card" data-aos="fade-up">
                    <div class="card-body">
                        <div class="aboutus-wrapper">
                            <h1 class="mt-3 text-center mb-3">
                                Edit Profile
                            </h1>
                            <form action="/home/proses_edit_profile/<?= user()->id; ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="profile_lama" value="<?= user()->profile_img; ?>">
                                <div class="col-sm-4 grid-margin mx-auto">
                                    <img src="/assets/images/profile_users/<?= user()->profile_img; ?>" alt="banner" class="img-fluid rounded-circle previewImg" />
                                    <div class="round">
                                        <i class="fas fa-camera text-white">
                                            <input type="file" class="form-control <?= ($validation->hasError('profile_img')) ? 'is-invalid' : ''; ?> mt-2" name="profile_img" id="profile_img" value="<?= user()->profile_img; ?>" onchange="editProfile()" style="position: absolute; bottom: 0; left: 0; background: #00B4FF; border-radius: 50%; margin-top: -50px;">
                                        </i>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('profile_img'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-5 mb-sm-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email *" autocomplete="off" value="<?= user()->email; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username *" autocomplete="off" value="<?= user()->username; ?>" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" class="form-control mt-3" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap *" autocomplete="off" value="<?= user()->fullname; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-dark font-weight-bold mt-3">Edit Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>