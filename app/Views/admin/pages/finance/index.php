<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Keuangan
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Keuangan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Nama Pembeli</th>
                        <th>Alamat Pembeli</th>
                        <th>Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Status Pengiriman</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>