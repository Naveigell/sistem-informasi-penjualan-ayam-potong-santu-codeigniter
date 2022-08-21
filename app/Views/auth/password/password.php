<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Lupa Password</h1>
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
                    <?php elseif ($success = session()->getFlashdata('success')): ?>
                        <div class="alert-success alert text-left">
                            <ul>
                                <li><?= $success; ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= route_to('auth.password.store'); ?>?<?= http_build_query($_GET); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="control-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password" data-validation-required-message="Please enter your name" aria-invalid="false">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" name="repeat_password" placeholder="Your Repeat Password" data-validation-required-message="Please enter your name" aria-invalid="false">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>