<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>
    <?php /** @var array $shippings */ ?>

    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Pembayaran Dan Pengiriman</h1>
        </div>
    </div>

    <div class="container">
        <?php foreach ($shippings as $shipping): ?>

            <?php
                $products = (new \App\Models\Order())->withProduct()->withImages()->where('shipping_id', $shipping->id)->get()->getResultObject();
                $area     = (new \App\Models\ShippingCost())->where('id', $shipping->area_id)->first();
                $payment  = (new \App\Models\Payment())->where('shipping_id', $shipping->id)->first();
                $total    = 0;
                $history  = (new \App\Models\ShippingHistory())->where('shipping_id', $shipping->id)->orderBy('id', 'desc')->first();
            ?>

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h6>
                        <i class="fa fa-truck"></i> <?= array_key_exists('description', is_array($history) ? $history : []) ? $history['description'] : 'Menunggu'; ?>
                        <?php if (!$payment && $shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER): ?>
                            <span class="badge badge-danger">Belum Di Bayar</span>
                        <?php elseif (!$payment): ?>
<!--                            <span class="badge badge-success">Sedang Di Proses</span>-->
                        <?php elseif ($payment['status'] == \App\Models\Payment::STATUS_WAITING): ?>
                            <span class="badge badge-info">Menunggu Persetujuan </span>
                        <?php elseif ($payment['status'] == \App\Models\Payment::STATUS_INVALID): ?>
                            <span class="badge badge-danger">Pembayaran Invalid</span>
                        <?php endif; ?>
                    </h6>

                    <?php if ($payment): ?>
                        <?php if($payment['status'] == \App\Models\Payment::STATUS_INVALID): ?>
                            <div class="card-header-action text-right">
                                <a href="<?= route_to('member.payments.edit', $shipping->id); ?>" class="btn btn-info">Bayar</a>
                            </div>
                        <?php elseif ($shipping->status == \App\Models\Shipping::STATUS_ON_PROGRESS): ?>
                            <div class="card-header-action text-right">
                                <a href="<?= route_to('member.shippings.timeline', $shipping->id); ?>" class="btn btn-info">Lihat</a>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if($shipping->payment_option == \App\Models\Payment::PAYMENT_COD): ?>
                            <div class="card-header-action text-right">
                                <a href="<?= route_to('member.shippings.timeline', $shipping->id); ?>" class="btn btn-info">Lihat</a>
                            </div>
                        <?php else: ?>
                            <div class="card-header-action text-right">
                                <a href="<?= route_to('member.payments.edit', $shipping->id); ?>" class="btn btn-info">Bayar</a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php foreach ($products as $product): ?>
                        <div class="row mb-4">
                            <div class="col-2">
                                <img style="width: 100px; height: 100px;" src="<?= base_url('/uploads/images/products/' . $product->media); ?>"
                                     alt="">
                            </div>
                            <div class="col-8">
                                <p><?= $product->name; ?></p>
                                <span><?= format_number($product->price); ?></span> <br>
                                <span>x<?= $product->quantity; ?></span>
                            </div>
                            <div class="col-2">
                                <span class="text text-danger"><?= format_number($product->price * $product->quantity); ?></span>
                            </div>
                        </div>
                        <hr>
                        <?php $total += $product->price * $product->quantity; ?>
                    <?php endforeach; ?>
                    <div class="row">
                        <div class="col-12">
                            <p>Ongkos Kirim : <?= format_number($area['cost']); ?></p>
                            <p>Total : <?= format_number($total + $area['cost']); ?></p>
                            <p><span class="badge badge-primary" style="color: white;"><?= str_replace('_', ' ', $shipping->payment_option); ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>

<?= $this->endSection() ?>