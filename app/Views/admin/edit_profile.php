<?= $this->extend('/layouts/template'); ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Profile</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>My Profile</h4>
                        </div>
                        <form action="/pages/proses_edit_profile/<?= user()->id; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="profileLama" value="<?= user()->profile_img; ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-5" style=" display: block; margin-left: auto; margin-right: auto;">
                                        <div id="image-preview" class="image-preview rounded-circle">
                                            <img src="/images/profile_users/<?= $dataUser['profile_img']; ?>" class="img-thumbnail preview-img rounded-circle" />
                                            <label for="image-upload" id="image-label">Pilih Gambar</label>
                                            <input type="file" class="form-control" name="profile_img" id="image-upload" onchange="previewImg()" style="position:fixed;" />
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Fullname</label>
                                        <input type="text" class="form-control" value="<?= $dataUser['fullname']; ?>" name="fullname">
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="<?= $dataUser['username']; ?>" name="username">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="<?= $dataUser['email']; ?>" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Edit Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>