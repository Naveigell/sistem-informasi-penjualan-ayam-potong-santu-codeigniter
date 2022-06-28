<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Media
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $media */ ?>
        <?php /** @var int $productId */ ?>
        <?php /** @var int $subProductId */ ?>
        <form action="<?= @$media ? route_to('admin.product-medias.update', $productId, $media['id']) : route_to('admin.product-medias.store', $productId); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$media): ?>
                <input type="hidden" name="_method" value="put">
            <?php endif; ?>
            <div class="card-header">
                <h4>Form Media</h4>
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
                    <label>Foto</label>
                    <input name="image" type="file" accept="image/png,image/jpeg,image/jpg" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>