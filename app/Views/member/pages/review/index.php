<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-style') ?>
    <style>
        .star-active {
            color: #f37809;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <?php /** @var array $orders */ ?>

    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Reviews</h1>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Order List</h4>
            </div>
            <div class="card-body">
                <?php foreach($orders as $order): ?>

                    <?php
                        $review = (new \App\Models\Review())->where('shipping_id', $order->shipping_id)->where('product_id', $order->product_id)->where('sub_product_id', $order->sub_product_id)->where('user_id', session()->get('user')->id)->first();
                    $media = (new \App\Models\ProductMedia())->where('product_id', $order->product_id)->where('type', \App\Models\ProductMedia::TYPE_IMAGE)->first();
                    ?>

                    <div class="row mb-4">
                        <div class="col-2">
                            <img style="width: 100px; height: 100px;" src="<?= base_url('/uploads/images/products/' . $media['media']); ?>"
                                 alt="">
                        </div>
                        <div class="col-8">
                            <p><?= $order->name; ?></p>
                            <span><?= format_number($order->sub_product_price); ?></span> <br>
                            <span>x<?= $order->quantity; ?> <br> Varian : (<?= $order->sub_product_unit; ?>)</span> <br>
                            <?php if($review): ?>
                                <?php for ($i = 0; $i < $review['star']; $i++): ?>
                                    <i class="fa fa-star review-star star-active" style="font-size: 15px; padding: 1px; cursor: pointer;"></i>
                                <?php endfor; ?>
                                <?php for ($i = $review['star']; $i < 5; $i++): ?>
                                    <i class="fa fa-star review-star" style="font-size: 15px; padding: 1px; cursor: pointer;"></i>
                                <?php endfor; ?>
                                (<?= $review['description']; ?>)
                            <?php endif; ?>
                        </div>
                        <div class="col-2">
                            <?php if($review): ?>
                                <button class="btn btn-info">Sudah Dinilai</button>
                            <?php else: ?>
                                <a href="<?= route_to('member.reviews.shipping.edit', $order->shipping_id, $order->product_id, $order->sub_product_id); ?>" class="btn btn-success">
                                    Nilai
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>