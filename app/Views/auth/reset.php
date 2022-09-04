<?= $this->extend('/auth/templates/index'); ?>

<?= $this->section('title'); ?>
<title>Pages Reset Password</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="card card-primary">
            <div class="card-header">
                <h4><?= lang('Auth.resetYourPassword') ?></h4>
            </div>

            <div class="card-body">
                <form action="<?= route_to('reset-password') ?>" method="post" class="needs-validation">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="token"><?= lang('Auth.token') ?></label>
                        <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.token') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= lang('Auth.email') ?></label>
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password"><?= lang('Auth.newPassword') ?></label>
                        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password">
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>
                        <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm">
                        <div class="invalid-feedback">
                            <?= session('errors.pass_confirm') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            <?= lang('Auth.resetPassword') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>