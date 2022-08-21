<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Login</h1>
        </div>
    </div>

    <div class="container pt-5 text-center">
        <div class="row px-xl-5">
            <div class="col-lg-12 mb-5">
                <div class="contact-form">

                    <?php if ($errors = session()->getFlashdata('errors')): ?>
                        <div class="alert-danger alert text-left">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= route_to('member.auth.login.store'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="control-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" data-validation-required-message="Please enter your name" aria-invalid="false">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password" data-validation-required-message="Please enter your email">
                            <p class="help-block text-danger"></p>
                            <a href="<?= route_to('auth.password.email.index'); ?>" class="btn btn-link d-inline-block" style="float: left;">Lupa password</a>
                            <div class="" style="clear: both;"></div>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit">Login</button>
                            <br>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>