<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Produk
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<div class="card">
    <div class="card-header">
        <h4 class="d-inline">Produk</h4>
        <div class="card-header-action">
            <a href="<?= route_to('admin.products.create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Produk</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table" id="table-2">
                <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Foto Produk</th>
                    <th>Kategori</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var array $products */
                foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product->name; ?></td>
                        <td>
                            <img alt="image" src="<?= base_url('/uploads/images/products/' . $product->media); ?>" width="250" height="250">
                        </td>
                        <td>
                            <span class="badge badge-success"><?= $product->category_name; ?></span>
                        </td>
                        <td><?= format_number($product->weight, ''); ?>gr</td>
                        <td><?= format_number($product->price); ?></td>
                        <td><?= $product->stock; ?></td>
                        <td><?= $product->unit; ?></td>
                        <td><?= $product->description; ?></td>
                        <td>
                            <a href="<?= route_to('admin.products.edit', $product->product_id); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                            <a href="<?= route_to('admin.sub-products.index', $product->product_id); ?>" class="btn btn-info"><i class="fa fa-list"></i></a>
                            <button data-target="#deleteModal" data-url="<?= route_to('admin.products.destroy', $product->product_id); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
