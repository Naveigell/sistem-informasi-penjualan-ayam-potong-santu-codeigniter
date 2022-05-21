<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>
    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <?php /** @var array $products */
            foreach ($products as $product): ?>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right font-weight-bold" style="font-size: 20px;"><?= format_number($product->price); ?></p>
                        <p class="text-right">
                            <span class="badge-success badge" style="font-size: 17px; border-radius: 100px;">Stok: &nbsp; <?= $product->stock; ?></span>
                        </p>
                        <a href="<?= route_to('member.home.detail', $category->slug, $product->slug); ?>" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="<?= base_url('/uploads/images/products/' . $product->media); ?>" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0"><?= $product->name; ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Categories End -->

<?= $this->endSection() ?>