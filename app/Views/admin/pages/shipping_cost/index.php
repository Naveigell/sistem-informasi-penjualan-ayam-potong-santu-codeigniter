<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Harga Antar
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<div class="card">
    <div class="card-header">
        <h4 class="d-inline">Area</h4>
        <div class="card-header-action">
            <a href="<?= route_to('admin.shipping-costs.create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Area</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table" id="table-2">
                <thead>
                <tr>
                    <th>Nama Area</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var array $shippingCosts */
                foreach ($shippingCosts as $shippingCost): ?>
                    <tr>
                        <td><?= $shippingCost->area; ?></td>
                        <td><?= format_number($shippingCost->cost); ?></td>
                        <td>
                            <a href="<?= route_to('admin.shipping-costs.edit', $shippingCost->id); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                            <button data-target="#deleteModal" data-url="<?= route_to('admin.shipping-costs.destroy', $shippingCost->id); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
