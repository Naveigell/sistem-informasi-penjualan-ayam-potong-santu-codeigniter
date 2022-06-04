<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Laporan Penjualan
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
                <a href="<?= route_to('admin.report.sale.print') . '?' . http_build_query($querystring); ?>" class="btn btn-primary"><i class="fa fa-print"></i> &nbsp; Print</a>
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
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Satuan (Kg)</th>
                        <th>Harga per/Kg (Rp)</th>
                        <th>Total Harga (Rp)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var array $orders */
                        $total = 0;
                        foreach($orders as $order): ?>
                            <tr>
                                <td><?= $order->name; ?></td>
                                <td>x<?= $order->quantity; ?></td>
                                <td><?= $order->sub_product_unit; ?></td>
                                <td><?= format_number($order->sub_product_price); ?></td>
                                <td><?php $total += $order->sub_product_price * $order->quantity; echo format_number($order->sub_product_price * $order->quantity); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr style="border-top: 1px solid #f5f3f3;">
                            <td><b>Total Penjualan</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b><?= format_number($total); ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>