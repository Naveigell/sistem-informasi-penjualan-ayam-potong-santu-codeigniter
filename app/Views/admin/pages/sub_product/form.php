<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Sub Produk
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<div class="card">
    <?php /** @var stdClass $product */ ?>
    <?php /** @var stdClass $subProduct */ ?>
    <form action="<?= @$subProduct ? route_to('admin.sub-products.update', $product->id, $subProduct->id) : route_to('admin.sub-products.store', $product->id); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <?php if (@$subProduct): ?>
            <input type="hidden" name="_method" value="put">
        <?php endif; ?>
        <div class="card-header">
            <h4>Form Produk <?= $product->name; ?></h4>
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
                <label>Harga Produk</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Rp.
                        </div>
                    </div>
                    <input name="price" type="text" class="form-control nominal" value="<?= @$subProduct ? $subProduct->price : ''; ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input name="stock" type="text" class="form-control nominal" value="<?= @$subProduct ? $subProduct->stock : ''; ?>">
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <input name="unit" type="text" class="form-control" value="<?= @$subProduct ? $subProduct->unit : ''; ?>">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
