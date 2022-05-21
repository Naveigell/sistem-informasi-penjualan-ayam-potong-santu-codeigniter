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
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="email" class="form-control" id="name" placeholder="Your Email" required="required" data-validation-required-message="Please enter your name" aria-invalid="false">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" id="email" placeholder="Your Password" required="required" data-validation-required-message="Please enter your email">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>