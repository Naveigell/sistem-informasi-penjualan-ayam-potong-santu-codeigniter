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
                $products = (new \App\Models\Order())->withProduct()->withSubProduct()->withImages()->where('shipping_id', $shipping->id)->get()->getResultObject();
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
                                <a href="<?= route_to('member.payments.nota', $shipping->id); ?>" class="btn btn-dark"><i class="fa fa-print"></i></a>
                            </div>
                        <?php elseif ($shipping->status == \App\Models\Shipping::STATUS_ON_PROGRESS): ?>
                            <?php if($shipping->finished): ?>
                                <div class="card-header-action text-right">
                                    <button class="btn btn-success">Pesanan Selesai</button>
                                    <a href="<?= route_to('member.reviews.index', $shipping->id); ?>" class="btn btn-warning">Penilaian</a>
                                    <a href="<?= route_to('member.payments.nota', $shipping->id); ?>" class="btn btn-dark"><i class="fa fa-print"></i></a>
                                </div>
                            <?php else: ?>
                                <div class="card-header-action text-right">
                                    <a href="<?= route_to('member.shippings.timeline', $shipping->id); ?>" class="btn btn-info">Lihat</a>
                                    <?php if($payment['status'] == \App\Models\Payment::STATUS_VALID): ?>
                                        <button data-url="<?= route_to('member.shippings.finish', $shipping->id); ?>" data-target="#finishModal" data-toggle="modal" class="btn btn-success btn-finish">Selesaikan Pesanan</button>
                                    <?php endif; ?>
                                    <a href="<?= route_to('member.payments.nota', $shipping->id); ?>" class="btn btn-dark"><i class="fa fa-print"></i></a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if($shipping->payment_option == \App\Models\Payment::PAYMENT_COD): ?>
                            <?php if($shipping->finished): ?>
                                <div class="card-header-action text-right">
                                    <button class="btn btn-success">Pesanan Selesai</button>
                                    <a href="<?= route_to('member.reviews.index', $shipping->id); ?>" class="btn btn-warning">Beri Penilaian</a>
                                    <a href="<?= route_to('member.payments.nota', $shipping->id); ?>" class="btn btn-dark"><i class="fa fa-print"></i></a>
                                </div>
                            <?php else: ?>
                                <div class="card-header-action text-right">
                                    <a href="<?= route_to('member.shippings.timeline', $shipping->id); ?>" class="btn btn-info">Lihat</a>
                                    <button data-url="<?= route_to('member.shippings.finish', $shipping->id); ?>" data-target="#finishModal" data-toggle="modal" class="btn btn-success btn-finish">Selesaikan Pesanan</button>
                                    <a href="<?= route_to('member.payments.nota', $shipping->id); ?>" class="btn btn-dark"><i class="fa fa-print"></i></a>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="card-header-action text-right">
                                <a href="<?= route_to('member.payments.edit', $shipping->id); ?>" class="btn btn-info">Bayar</a>
                                <a href="<?= route_to('member.payments.nota', $shipping->id); ?>" class="btn btn-dark"><i class="fa fa-print"></i></a>
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
                                <span><?= format_number($product->sub_product_price); ?></span> <br>
                                <span>x<?= $product->quantity; ?> (<?= $product->sub_product_unit; ?>)</span>
                            </div>
                            <div class="col-2">
                                <span class="text text-danger"><?= format_number($product->sub_product_price * $product->quantity); ?></span>
                            </div>
                        </div>
                        <hr>
                        <?php $total += $product->sub_product_price * $product->quantity; ?>
                    <?php endforeach; ?>
                    <div class="row">
                        <div class="col-9">
                            <p>Ongkos Kirim : <?= format_number($area['cost']); ?></p>
                            <p>Total : <?= format_number($total + $area['cost']); ?></p>
                            <p><span class="badge badge-primary" style="color: white;"><?= str_replace('_', ' ', $shipping->payment_option); ?></span></p>
                        </div>
                        <div class="col-3">
                            <span>Order Id : <b><?= strtoupper($shipping->order_id); ?></b></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="finishModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="form-finish" method="post" action="">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="put">
                <div class="modal-header">
                    <h5 class="modal-title">Selesaikan pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin selesaikan pesanan?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ya</button>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        $(".btn-finish").on('click', function () {
            $('#form-finish').attr("action", $(this).data('url'));
        })
    </script>
<?= $this->endSection() ?>