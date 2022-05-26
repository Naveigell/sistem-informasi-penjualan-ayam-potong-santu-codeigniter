<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Saran
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<div class="card">
    <div class="card-header">
        <h4 class="d-inline">Saran</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table" id="table-2">
                <thead>
                <tr>
                    <th>Nama Pengirim</th>
                    <th>Deskripsi</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var array $suggestions */
                foreach ($suggestions as $suggestion): ?>
                    <tr>
                        <td><?= $suggestion->name; ?></td>
                        <td><?= $suggestion->description; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
