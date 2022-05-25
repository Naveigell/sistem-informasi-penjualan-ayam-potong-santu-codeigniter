<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Laporan
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <?php
        $querystring = [
            "from" => array_key_exists('from', $_GET) ? $_GET['from'] : '',
            "to"   => array_key_exists('to', $_GET) ? $_GET['to'] : '',
        ];
    ?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Laporan</h4>
            <div class="card-header-action">
                <a href="<?= route_to('admin.reports.print') . '?' . http_build_query($querystring); ?>" class="btn btn-primary"><i class="fa fa-print"></i> &nbsp; Print</a>
            </div>
        </div>
        <div class="card-body">
            <form action="" class="row">
                <div class="col-3">
                    <div class="form-group">
                        <input type="date" class="form-control" name="from" value="<?= array_key_exists('from', $_GET) ? $_GET['from'] : ''; ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <input type="date" class="form-control" name="to" value="<?= array_key_exists('to', $_GET) ? $_GET['to'] : ''; ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Filter</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php /** @var array $finances */
                        $total = 0;
                        foreach($finances as $finance): ?>
                            <?php $total += @$finance->order_id ? $finance->total : -$finance->total; ?>
                            <tr>
                                <td><?= date('d F Y', strtotime($finance->date)); ?></td>
                                <td><?= @$finance->order_id ? format_number($finance->total) : '-'; ?></td>
                                <td><?= @$finance->rand_id ? format_number($finance->total) : '-'; ?></td>
                                <td><?= format_number($total) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>