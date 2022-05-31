<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Modal
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $capital */ ?>
        <form action="<?= @$capital ? route_to('admin.capitals.update', $capital->id) : route_to('admin.capitals.store'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$capital): ?>
                <input type="hidden" name="_method" value="put">
            <?php endif; ?>
            <div class="card-header">
                <h4>Form Modal</h4>
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
                    <label>Jumlah</label>
                    <input name="value" type="number" class="form-control" value="<?= @$capital ? $capital->value : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input name="publish_date" type="date" class="form-control" value="<?= @$capital ? date('Y-m-d', strtotime($capital->publish_date)) : ''; ?>">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>