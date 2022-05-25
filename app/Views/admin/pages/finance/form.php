<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Pengeluaran
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $finance */ ?>
        <form action="<?= @$finance ? route_to('admin.expenditures.update', $finance->id) : route_to('admin.expenditures.store'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$finance): ?>
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
                    <input name="name" type="text" class="form-control" value="<?= @$finance ? $finance->name : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Berat Produk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                gr
                            </div>
                        </div>
                        <input name="weight" type="text" class="form-control nominal" value="<?= @$finance ? $finance->weight : ''; ?>">
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
                        <input name="price" type="text" class="form-control nominal" value="<?= @$finance ? $finance->price : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input name="stock" type="text" class="form-control nominal" value="<?= @$finance ? $finance->stock : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" id="editor" cols="30" rows="10"><?= @$finance ? $finance->description : ''; ?></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>