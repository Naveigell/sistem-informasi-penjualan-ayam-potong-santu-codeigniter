<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Register</h1>
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

                    <?php if ($success = session()->getFlashdata('success')): ?>
                        <div class="alert-success alert text-left">
                            <?= $success; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (array_key_exists('text', $_GET)): ?>
                        <div class="alert-danger alert">
                            Anda belum memiliki akun, registrasi terlebih dahulu agar anda dapat melakukan login.
                        </div>
                    <?php endif; ?>

                    <form novalidate="novalidate" action="<?= route_to('member.auth.register.store'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="control-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" aria-invalid="false">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="username" placeholder="Your Username" aria-invalid="false">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" aria-invalid="false">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="phone" placeholder="Your Phone">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="address" placeholder="Your Address">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>