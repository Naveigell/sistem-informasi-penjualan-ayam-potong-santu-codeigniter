<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        </div>
    </div>

    <?php /** @var array $shippingCosts */ ?>
    <?php /** @var array $carts */ ?>
    <?php
        $total = array_reduce($carts, function ($initial, $cart) {
            return $initial + $cart->quantity * $cart->sub_product_price;
        }, 0);
    ?>

    <form class="container-fluid pt-5" action="<?= route_to('members.checkouts.store'); ?>" method="post">
        <?= csrf_field(); ?>

        <?php if ($errors = session()->getFlashdata('errors')): ?>
            <div class="alert-danger alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input name="name" readonly value="<?= session()->get('user')->name; ?>" class="form-control" type="text" placeholder="Your Name ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input name="email" readonly value="<?= session()->get('user')->email; ?>" class="form-control" type="email" placeholder="Your Email ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input name="address" value="<?= session()->get('user')->address; ?>" class="form-control" type="text" placeholder="Your Address ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input name="phone" value="<?= session()->get('user')->phone; ?>" class="form-control" type="text" placeholder="Your Phone ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Pilihan Pembayaran</label>
                            <select name="payment_option" class="custom-select">
                                <option value="">-- Nothing Selected --</option>
                                <option value="cod">COD</option>
                                <option value="bank_transfer">Transfer Bank</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Area Pengiriman</label>
                            <select name="area_id" class="custom-select" id="shipping-area">
                                <option data-price="0" data-format-price="Rp. 0" value="">-- Nothing Selected --</option>
                                <?php foreach ($shippingCosts as $shippingCost): ?>
                                    <option data-price="<?= $shippingCost->cost; ?>" data-format-price="<?= format_number($shippingCost->cost); ?>" value="<?= $shippingCost->id; ?>"><?= $shippingCost->area; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Total Pemesanan</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Produk</h5>
                        <?php foreach ($carts as $cart): ?>
                            <div class="d-flex justify-content-between">
                                <p><?= $cart->name; ?>&nbsp;x <?= $cart->quantity; ?> (<?= $cart->sub_product_unit; ?>)</p>
                                <p><?= format_number($cart->sub_product_price * $cart->quantity); ?></p>
                            </div>
                        <?php endforeach; ?>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium"><?= format_number($total); ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Ongkos Kirim</h6>
                            <h6 class="font-weight-medium" id="shipping-cost-display">Rp. 0</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold" id="total"><?= format_number($total); ?></h5>
                        </div>
                    </div>
                </div>
                <form class="card border-secondary mb-5">
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Pesan Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </form>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        var total = <?= $total ?>;
        var shippingPrice = 0;

        $('#shipping-area').on('change', function () {
            var formattedPrice = $('option:selected', this).data('format-price');

            shippingPrice = $('option:selected', this).data('price');

            $('#total').html('Rp. ' + numberWithCommas(total + shippingPrice));
            $('#shipping-cost-display').html(formattedPrice);
        });
    </script>
<?= $this->endSection() ?>