<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Pengeluaran
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Pengeluaran</h4>
            <div class="card-header-action">
                <a href="<?= route_to('admin.expenditures.create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var array $expenditures */
                    foreach($expenditures as $expenditure): ?>
                        <tr>
                            <td><b><?= strtoupper($expenditure->rand_id); ?></b></td>
                            <td><?= date('d F Y', strtotime($expenditure->publish_date)) ?></td>
                            <td>
                                <a href="<?= route_to('admin.expenditures.edit', $expenditure->id); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                <button data-target="#deleteModal" data-url="<?= route_to('admin.expenditures.destroy', $expenditure->id); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>