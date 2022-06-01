<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Laporan
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <?php
        $total = 0;
        $totalExpenditure = 0;
        $totalCapital = 0;
        $querystring = [
            "from" => array_key_exists('from', $_GET) ? $_GET['from'] : '',
            "to"   => array_key_exists('to', $_GET) ? $_GET['to'] : '',
        ];
    ?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Laporan</h4>
            <div class="card-header-action">
                <a href="<?= route_to('admin.report.profit-loss.print') . '?' . http_build_query($querystring); ?>" class="btn btn-primary"><i class="fa fa-print"></i> &nbsp; Print</a>
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
                <table class="table" id="table-2">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Pendapatan Penjualan</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php /** @var array $orders */
                        foreach($orders as $order): ?>
                            <tr>
                                <td><?= $order->name; ?> - <?= $order->quantity; ?> <?= $order->unit; ?></td>
                                <td><?php $total += $order->quantity * $order->price; echo format_number($order->quantity * $order->price); ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><b><?= format_number($total); ?></b></td>
                        </tr>
                        <tr>
                            <td><b>Modal</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php /** @var array $capitals */
                        foreach($capitals as $capital): ?>
                            <tr>
                                <td>Modal Awal</td>
                                <td>-</td>
                                <td><b>(<?php $totalCapital += $capital->value; echo format_number($capital->value); ?>)</b></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><b>Laba Rugi Kotor</b></td>
                            <td></td>
                            <td><b><?php $total -= $totalCapital; echo format_number($total); ?></b></td>
                        </tr>
                        <tr>
                            <td><b>Pengeluaran</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php /** @var array $expenditures */
                        foreach($expenditures as $expenditure): ?>
                            <tr>
                                <td><?= $expenditure->name; ?>&nbsp; x<?= $expenditure->quantity; ?></td>
                                <td><?php $totalExpenditure += $expenditure->quantity * $expenditure->nominal; echo format_number($expenditure->quantity * $expenditure->nominal); ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><b>Total Pengeluaran</b></td>
                            <td></td>
                            <td><b>(<?= format_number($totalExpenditure); ?>)</b></td>
                        </tr>
                        <tr>
                            <td><b>Laba Rugi Bersih</b></td>
                            <td></td>
                            <td><b><?= format_number($total - $totalExpenditure); ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>