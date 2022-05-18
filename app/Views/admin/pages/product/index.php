<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Product
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<div class="card p-4">
    <div class="table-responsive">
        <table class="table data-table" id="table-2">
            <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Foto Produk</th>
                <th>Berat</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var array $products */
            foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->name; ?></td>
                    <td>
                        <img alt="image" src="" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                    </td>
                    <td><?= $product->weight; ?></td>
                    <td><?= format_price($product->price); ?></td>
                    <td><a href="#" class="btn btn-secondary">Detail</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
