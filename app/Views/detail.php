<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-style') ?>
    <style>
        .star-active {
            color: #f37809;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Detail Produk</h1>
        </div>
    </div>
    <!-- Page Header End -->
    <?php /** @var stdClass $product */ ?>
    <?php /** @var array $reviews */ ?>
    <?php /** @var string $categorySlug */ ?>
    <?php /** @var string $productSlug */ ?>
    <?php /** @var integer $reviewsValue */ ?>

    <?php
        $medias = (new \App\Models\ProductMedia())->where('product_id', $product->id)->get()->getResultObject();
    ?>

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <?php foreach($medias as $index => $media): ?>
                            <?php if($media->type == \App\Models\ProductMedia::TYPE_VIDEO): ?>

                                <?php if (!$media->media): ?>
                                    <?php continue; ?>
                                <?php endif; ?>

                                <div class="carousel-item <?= $index == 0 ? 'active' : ''; ?> carousel-index-<?= $index; ?>">
                                    <video id="vid" controls width="100%" height="100%" style="cursor: pointer;">
                                        <source src="<?= base_url('/uploads/videos/products/' . $media->media); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>

                            <?php else: ?>

                                <div class="carousel-item <?= $index == 0 ? 'active' : ''; ?> carousel-index-<?= $index; ?>">
                                    <img class="w-100 h-100" src="<?= base_url('/uploads/images/products/' . $media->media); ?>" alt="Image">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-white"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-white"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?= $product->name; ?></h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <?php for ($i = 0; $i < $reviewsValue; $i++): ?>
                            <small class="fas fa-star"></small>
                        <?php endfor; ?>
                        <?php for ($i = $reviewsValue; $i < 5; $i++): ?>
                            <small class="far fa-star"></small>
                        <?php endfor; ?>
                    </div>
                    <small class="pt-1">(<?= count($reviews); ?> Reviews)</small>
                </div>
                <?php
                    $subProducts = (new \App\Models\SubProduct())->where('product_id', $product->id)->get()->getResultObject();
                    $subProductIndex = array_key_exists('sub_id', $_GET) ? $_GET['sub_id'] : -1;

                    $prices = array_map(function ($item) {
                        return $item->price;
                    }, $subProducts);

                    $stocks = array_map(function ($item) {
                        return $item->stock;
                    }, $subProducts);

                    sort($prices);
                    sort($stocks);

                    $startPrice = reset($prices);
                    $endPrice   = end($prices);

                    $startStock = reset($stocks);
                    $endStock   = end($stocks);

                    if (count($subProducts) == 0) {
                        $subProductIndex = -1;
                    }
                ?>
                <h3 class="font-weight-semi-bold mb-4">

                    <?php if(!array_key_exists('sub_id', $_GET)): ?>

                        <?php if($startPrice === $endPrice): ?>
                            <?= format_number($startPrice); ?>
                        <?php else: ?>
                            <?= format_number($startPrice); ?> - <?= format_number($endPrice); ?>
                        <?php endif; ?>

                    <?php else: ?>

                        <?= $subProductIndex >= 0 ? format_number($subProducts[$subProductIndex]->price) : '-'; ?>

                    <?php endif; ?>
                </h3>
                <span class="mb-4">
                    Sisa Stok :

                    <?php if(!array_key_exists('sub_id', $_GET)): ?>

                        <?php if($startStock === $endStock): ?>
                            <?= $startStock; ?>
                        <?php else: ?>
                            <?= $startStock; ?> - <?= $endStock; ?>
                        <?php endif; ?>

                    <?php else: ?>

                        <?= $subProductIndex >= 0 ? $subProducts[$subProductIndex]->stock : '-'; ?>

                    <?php endif; ?>
                </span>
                <br>
                <div class="mb-4">
                    <label for="">Pilih Satuan : </label>
                    <div class="form-group" id="variant-container">
                        <?php foreach($subProducts as $index => $subProduct): ?>
                            <a href="<?= route_to('member.home.detail', $categorySlug, $productSlug) . '?' . http_build_query(['sub_id' => $index]); ?>"  class="btn btn-sm <?= $subProductIndex == $index ? 'btn-primary' : 'btn-light'; ?>" <?php if($subProductIndex == $index): ?> style="color: white;" <?php else: ?> style="border: 1px solid #b5b1b1;" <?php endif; ?>><?= $subProduct->unit; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <p class="mb-4">
                    <?= $product->description; ?>
                </p>
                <form method="post" <?php if($subProductIndex < 0): ?> onsubmit="animateVariantContainer(); return false;" <?php endif; ?> action="<?= $subProductIndex >= 0 ? route_to('member.carts.store', $product->id, $subProducts[$subProductIndex]->id) : '#'; ?>" class="d-flex align-items-center mb-4 pt-2">
                    <?= csrf_field(); ?>
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-minus" >
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input name="quantity" type="text" class="form-control bg-secondary text-center" value="1" min="1" max="<?= $subProductIndex >= 0 ? $subProducts[$subProductIndex]->stock : 0; ?>">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <?php if (!session()->has('hasLoggedIn')): ?>
                        <a href="<?= route_to('member.auth.register.index') . '?' . http_build_query(['text' => 'true']); ?>" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</a>
                    <?php else: ?>
                        <button class="btn btn-primary px-3" type="submit"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    <?php endif; ?>
                </form>
                <?php if (!session()->has('hasLoggedIn')): ?>
                    <span class="text text-danger">Login dahulu jika ingin menambahkan ke dalam keranjang!</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
<!--                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Review</a>-->
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4"><?= count($reviews); ?> Reviews</h4>
                                <?php foreach($reviews as $review): ?>
                                    <?php
                                        $subProductReview = (object) (new \App\Models\SubProduct())->where('id', $review->sub_product_id)->first();
                                    ?>
                                    <div class="media mb-4">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARMAAAC3CAMAAAAGjUrGAAAAKlBMVEXg4OD////j4+Pb29v7+/vi4uLx8fHs7Oz39/f09PTa2tru7u7m5ubX19cF3ejnAAABRElEQVR4nO3Z27JDMBiAURFVVN//dXfp+ZC6Y0//tS4zphPflARVBQAAAAAAAAAAAAAAAAAAAAAAAADAj6i/23p6G+jSkn7rKa6tXUyS0mHrSa4rp9QuHNKlJq8yl//i1GS/cEgbtsm4Kx0StEme7ipd4ZCgTQ7zrbT7fOoxm+TL+vL58ondZLwPd/2tQ+wm99HTRu4WJWaTapyTtNdTz/Pe9holaJNcnxrsh+vYZbt/iRK0SVUdj8fnf8k9StgmDyMPD4VzlNBN5qU4Pz0nT1EiN2mmdSe/vDroQzdppsX4NUlKOXCT5ry9f3t3ErhJU3qfFLdJMUncJuUkYZvkchJNNJlo8u58P6l3JXXoPVtRxCZ9PX5Tx/u+4zvgu2H5e3E7LP/MbxmWLowhXBIAAAAAAAAAAAAAAAAAAAAAAAAAgF/1BxZSCIBLTls7AAAAAElFTkSuQmCC" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6><?= $review->name; ?></h6>
                                            <div>
                                                Varian : <?= $subProductReview->unit; ?>
                                            </div>
                                            <div class="text-primary mb-2">
                                                <?php for ($i = 0; $i < $review->star; $i++): ?>
                                                    <i class="fa fa-star review-star star-active" style="font-size: 15px; padding: 1px; cursor: pointer;"></i>
                                                <?php endfor; ?>
                                                <?php for ($i = $review->star; $i < 5; $i++): ?>
                                                    <i class="fa fa-star review-star" style="font-size: 15px; padding: 1px; cursor: pointer;"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <p><?= $review->description; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        // Product Quantity
        $('.quantity button').on('click', function () {
            var button = $(this);
            var oldValue = button.parent().parent().find('input').val();
            if (button.hasClass('btn-plus')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }

            if (newVal >= 1 && newVal <= <?= $subProductIndex >= 0 ? $subProducts[$subProductIndex]->stock : 1 ?>) {
                button.parent().parent().find('input').val(newVal);
            }
        });

        $('#unit-dropdown').on('change', function () {
            window.location.href = $(this).find(':selected').data('url');
        });

        $('#variant-container').on('animationend', function () {
            $(this).removeClass(['animate__animated', 'animate__shakeX']);
        });

        function animateVariantContainer() {
            $('#variant-container').addClass(['animate__animated', 'animate__shakeX']);
        }
    </script>

    <script>
        var isPlaying = false;
        var video = document.getElementById("vid");

        video.addEventListener('click', function () {
            isPlaying = !isPlaying;
        })

        $('#product-carousel').on('slid.bs.carousel', function (item) {
            if ($(item.currentTarget).find("div").find('.active').find('#vid').length > 0) {

                if (!isPlaying)
                    return;

                video.play();
            } else {
                video.pause();
            }
        })
    </script>
<?= $this->endSection() ?>