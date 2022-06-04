<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Pemasukan
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Pemasukan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var array $shippings */
                    foreach($shippings as $shipping): ?>

                        <?php
                            $orders = (new \App\Models\Order())->withProduct()->withSubProduct()->withImages()->where('shipping_id', $shipping->id)->get()->getResultObject();
                        ?>

                        <?php foreach($orders as $order): ?>
                            <tr>
                                <td>
                                    <img alt="image" src="<?= base_url('/uploads/images/products/' . $order->media); ?>" width="250" height="250">
                                </td>
                                <td><?= $order->name ?></td>
                                <td><?= format_number($order->sub_product_price) ?></td>
                                <td>x<?= $order->quantity ?></td>
                                <td><?= $order->sub_product_unit; ?></td>
                                <td><?= format_number($order->sub_product_price * $order->quantity) ?></td>
                                <td><?= date('d F Y', strtotime($shipping->finished_date)) ?></td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>