<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-style') ?>
    <style>
        ul.timeline {
            list-style-type: none;
            position: relative;
        }
        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline > li {
            margin: 20px 0;
            padding-left: 20px;
        }
        ul.timeline > li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Status Pengiriman</h1>
        </div>
    </div>

    <?php /** @var object $shipping */ ?>
    <?php /** @var array $histories */ ?>

    <?php
        $products = (new \App\Models\Order())->withProduct()->withSubProduct()->withImages()->where('shipping_id', $shipping->id)->get()->getResultObject();
        $area     = (new \App\Models\ShippingCost())->where('id', $shipping->area_id)->first();
        $payment  = (new \App\Models\Payment())->where('shipping_id', $shipping->id)->first();
        $total    = 0;
        $history  = (new \App\Models\ShippingHistory())->where('shipping_id', $shipping->id)->orderBy('id', 'desc')->first();
    ?>

    <div class="container">
        <div class="card mb-4">
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
                            <span>x<?= $product->quantity; ?>&nbsp;(<?= $product->sub_product_unit; ?>)</span>
                        </div>
                        <div class="col-2">
                            <span class="text text-danger"><?= format_number($product->sub_product_price * $product->quantity); ?></span>
                        </div>
                    </div>
                    <hr>
                    <?php $total += $product->sub_product_price * $product->quantity; ?>
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
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <ul class="timeline">
                    <?php if(count($histories) > 0): ?>
                        <?php foreach($histories as $history): ?>
                            <li>
                                <a class="float-right"><?= date('d F, Y', strtotime($history->progress_date)); ?>&nbsp;&nbsp;&nbsp;<?= date('H:i', strtotime($history->progress_date)); ?></a>
                                <p>
                                    <?= $history->description; ?>
                                </p>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>
                            <a class="float-right"><?= date('d F, Y'); ?>&nbsp;&nbsp;&nbsp;<?= date('H:i'); ?></a>
                            <p>
                                Menunggu
                            </p>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>