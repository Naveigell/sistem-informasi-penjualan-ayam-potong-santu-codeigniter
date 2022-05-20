<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Produk
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $product */ ?>
        <form action="<?= @$product ? route_to('admin.products.update', $product->id) : route_to('admin.products.store'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$product): ?>
                <input type="hidden" name="_method" value="put">
            <?php endif; ?>
            <div class="card-header">
                <h4>Form Produk</h4>
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
                    <label>Nama Produk</label>
                    <input name="name" type="text" class="form-control" value="<?= @$product ? $product->name : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Berat Produk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                gr
                            </div>
                        </div>
                        <input name="weight" type="text" class="form-control nominal" value="<?= @$product ? $product->weight : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Harga Produk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Rp.
                            </div>
                        </div>
                        <input name="price" type="text" class="form-control nominal" value="<?= @$product ? $product->price : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>