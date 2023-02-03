<?= $this->extend('/auth/templates/index'); ?>

<?= $this->section('title'); ?>
<title>World Time | Login</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="card card-primary">
            <div class="card-header">
                <h4><?= lang('Auth.loginTitle') ?></h4>
            </div>

            <div class="card-body">
                <?= view('Myth\Auth\Views\_message_block') ?>
                <form action="<?= route_to('login') ?>" method="post" class="needs-validation">
                    <?= csrf_field() ?>
                    <?php if ($config->validFields === ['email']) : ?>
                        <div class="form-group">
                            <label for="login"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.login') ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="form-group">
                            <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.login') ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <div class="float-right">
                                <a href="/forgot" class="text-small">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>

                    <?php if ($config->allowRemembering) : ?>
                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                <?= lang('Auth.rememberMe') ?>
                            </label>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Login
                        </button>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    Don't have an account? <a href="register">Create Account!</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>