<?= $this->extend('/auth/templates/index'); ?>

<?= $this->section('title'); ?>
<title>World Time | Forgot Password</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="card card-primary">
            <div class="card-header">
                <h4><?= lang('Auth.forgotPassword') ?></h4>
            </div>
            <div class="card-body">
                <?= view('Myth\Auth\Views\_message_block') ?>
                <form action="<?= route_to('forgot') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="email"><?= lang('Auth.emailAddress') ?></label>
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            <?= lang('Auth.sendInstructions') ?>
                        </button>
                    </div>
                </form>
                <div class="mt-3 text-muted text-center">
                    <a href="/register">
                        Create Account
                    </a>
                </div>
                <div class="mt-3 text-center">
                    Already have an account? <a href="/login">Login!</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>