<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Shippings
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<div class="card">
    <div class="card-header">
        <h4 class="d-inline">Pengiriman</h4>
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
                <?php /** @var array $shippings */
                foreach ($shippings as $shipping): ?>

                    <?php
                        $history = (new \App\Models\ShippingHistory())->where('shipping_id', $shipping->shipping_id)->orderBy('id', 'desc')->first();
                    ?>

                    <tr <?php if (!$shipping->has_read): ?> style="background: #eeecec;" <?php endif; ?>>
                        <td><?= $shipping->name; ?></td>
                        <td><?= $shipping->address; ?></td>
                        <td><span class="badge badge-primary"><?= str_replace('_', ' ', $shipping->payment_option); ?></span></td>
                        <td>
                            <?php if ($shipping->payment_option == 'cod'): ?>
                                -
                            <?php elseif ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && !$shipping->proof): ?>
                                <span class="badge badge-warning">Belum dibayar</span>
                            <?php elseif ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && $shipping->payment_status == \App\Models\Payment::STATUS_WAITING): ?>
                                <span class="badge badge-info">Menunggu validasi pembayaran</span>
                            <?php elseif ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && $shipping->payment_status == \App\Models\Payment::STATUS_VALID): ?>
                                <span class="badge badge-primary">Valid</span>
                            <?php elseif ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && $shipping->payment_status == \App\Models\Payment::STATUS_INVALID): ?>
                                <span class="badge badge-danger">Invalid</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= array_key_exists('description', is_array($history) ? $history : []) ? $history['description'] : '-'; ?>
                        </td>
                        <td>
                            <a href="<?= route_to('admin.shippings.edit', $shipping->shipping_id); ?>" class="btn btn-warning"><i class="fa fa-truck"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
