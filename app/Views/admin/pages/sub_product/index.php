<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Produk
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<?php
/** @var stdClass $product */
?>

<div class="card">
    <div class="card-header">
        <h4 class="d-inline">Produk <?= $product->name; ?></h4>
        <div class="card-header-action">
            <a href="<?= route_to('admin.sub-products.create', $product->id); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Sub Produk</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table" id="table-2">
                <thead>
                <tr>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var array $subProducts */
                foreach ($subProducts as $subProduct): ?>
                    <tr>
                        <td><?= format_number($subProduct->price); ?></td>
                        <td><?= $subProduct->stock; ?></td>
                        <td><?= $subProduct->unit; ?></td>
                        <td>
                            <a href="<?= route_to('admin.sub-products.edit', $product->id, $subProduct->id); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                            <button data-target="#deleteModal" data-url="<?= route_to('admin.sub-products.destroy', $product->id, $subProduct->id); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
