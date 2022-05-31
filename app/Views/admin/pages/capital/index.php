<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Modal
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<div class="card">
    <div class="card-header">
        <h4 class="d-inline">Modal Usaha</h4>
        <div class="card-header-action">
            <a href="<?= route_to('admin.capitals.create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Modal</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table" id="table-2">
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var array $capitals */
                foreach ($capitals as $capital): ?>
                    <tr>
                        <td><?= date('d F Y', strtotime($capital->publish_date)); ?></td>
                        <td><?= format_number($capital->value); ?></td>
                        <td>
                            <a href="<?= route_to('admin.capitals.edit', $capital->id); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                            <button data-target="#deleteModal" data-url="<?= route_to('admin.capitals.destroy', $capital->id); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
