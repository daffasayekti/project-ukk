<?= $this->extend('/auth/templates/index'); ?>

<?= $this->section('title'); ?>
<title>World Time | Register</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
        <div class="card card-primary">
            <div class="card-header">
                <h4><?= lang('Auth.register') ?></h4>
            </div>

            <div class="card-body">
                <?= view('Myth\Auth\Views\_message_block') ?>
                <form action="<?= route_to('register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="username"><?= lang('Auth.username') ?></label>
                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                    </div>

                    <div class="form-group">
                        <label for="email"><?= lang('Auth.email') ?></label>
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                        </div>
                        <div class="form-group col-6">
                            <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                            <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Register
                        </button>
                    </div>
                </form>
                <div class="mt-3 text-muted text-center">
                    <a href="/forgot">
                        Forgot Password?
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