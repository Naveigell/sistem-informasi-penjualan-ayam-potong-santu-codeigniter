<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-style') ?>
    <style>
        .star-active {
            color: #f37809;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <?php /** @var object $subProduct */ ?>
    <?php /** @var object $product */ ?>
    <?php /** @var object $shipping */ ?>
    <?php /** @var object $order */ ?>

    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Reviews</h1>
        </div>
    </div>

    <div class="container mb-4">
        <div class="card">
            <div class="card-header">
                <h4><?= $product->name; ?></h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-2">
                        <img style="width: 100px; height: 100px;" src="<?= base_url('/uploads/images/products/' . $product->media); ?>"
                             alt="">
                    </div>
                    <div class="col-8">
                        <span><?= format_number($subProduct->price); ?></span> <br>
                        <span>x<?= $order->quantity; ?>&nbsp;(<?= $subProduct->unit; ?>)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-12">

                        <?php if ($errors = session()->getFlashdata('errors')): ?>
                            <div class="alert-danger alert">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?= route_to('member.reviews.shipping.store', $order->shipping_id, $order->product_id, $order->sub_product_id); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="">Bintang</label> <br>
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <i class="fa fa-star review-star" style="font-size: 40px; padding: 1px; cursor: pointer;"></i>
                                <?php endfor; ?>
                                <input type="hidden" id="star" name="star" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="form-control" style="height: 300px;" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        $('.review-star').on('click', function () {
            let elementIndex = $(this).index() - 1;
            $('#star').val(elementIndex);
            $('.review-star').removeClass('star-active');
            $('.review-star').each(function (index) {
                if (index <= elementIndex - 1) {
                    $(this).addClass('star-active');
                }
            })
        });
    </script>
<?= $this->endSection() ?>
