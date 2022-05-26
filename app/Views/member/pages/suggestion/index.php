<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>
<?php /** @var array $shippings */ ?>

    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Saran</h1>
        </div>
    </div>

    <div class="container">
        <form class="card mb-4" method="post" action="<?= route_to('member.suggestions.store'); ?>">
            <?= csrf_field(); ?>
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6>Kirim Saran</h6>
                <div class="card-header-action text-right">
                    <button type="submit" class="btn btn-info"><i class="fa fa-paper-plane"></i>&nbsp;Kirim</button>
                </div>
            </div>
            <div class="card-body">

                <?php if ($errors = session()->getFlashdata('errors')): ?>
                    <div class="alert-danger alert">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="form-group col-12">
                        <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Ketik saran disini ..."></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php /** @var array $suggestions */
    foreach($suggestions as $suggestion): ?>
        <div class="container">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h6><?= date('d F Y', strtotime($suggestion->created_at)); ?></h6>
                    <div class="card-header-action">
                        <?= date('H:i', strtotime($suggestion->created_at)); ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <?= $suggestion->description; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        $(".btn-finish").on('click', function () {
            $('#form-finish').attr("action", $(this).data('url'));
        })
    </script>
<?= $this->endSection() ?>