<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Harga Antar
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $cost */ ?>
        <form action="<?= @$cost ? route_to('admin.shipping-costs.update', $cost->id) : route_to('admin.shipping-costs.store'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$cost): ?>
                <input type="hidden" name="_method" value="put">
            <?php endif; ?>
            <div class="card-header">
                <h4>Form Area</h4>
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
                <div class="form-group">
                    <label>Nama Area</label>
                    <input name="area" type="text" class="form-control" value="<?= @$cost ? $cost->area : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Harga Antar</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Rp.
                            </div>
                        </div>
                        <input name="cost" type="text" class="form-control nominal" value="<?= @$cost ? $cost->cost : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>