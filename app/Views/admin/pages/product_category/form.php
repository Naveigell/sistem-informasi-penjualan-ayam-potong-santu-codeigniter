<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Harga Antar
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $category */ ?>
        <form action="<?= @$category ? route_to('admin.product-categories.update', $category->id) : route_to('admin.product-categories.store'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$category): ?>
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
                    <label>Foto Produk</label>
                    <input name="image" type="file" accept="image/png,image/jpeg,image/jpg" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input name="name" type="text" class="form-control" value="<?= @$category ? $category->name : ''; ?>">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>