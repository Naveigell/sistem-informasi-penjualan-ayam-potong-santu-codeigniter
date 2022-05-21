<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Kategori Produk
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<div class="card">
    <div class="card-header">
        <h4 class="d-inline">Area</h4>
        <div class="card-header-action">
            <a href="<?= route_to('admin.product-categories.create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Kategori</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table" id="table-2">
                <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var array $categories */
                foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category->name; ?></td>
                        <td>
                            <img alt="image" src="<?= base_url('/uploads/images/product_categories/' . $category->image); ?>" width="250" height="250">
                        </td>
                        <td>
                            <a href="<?= route_to('admin.product-categories.edit', $category->id); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                            <button data-target="#deleteModal" data-url="<?= route_to('admin.product-categories.destroy', $category->id); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
