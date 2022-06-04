<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>
    <?php /** @var object $shipping */ ?>

    <?php
        $products = (new \App\Models\Order())->withProduct()->withSubProduct()->withImages()->where('shipping_id', $shipping->id)->get()->getResultObject();
        $area     = (new \App\Models\ShippingCost())->where('id', $shipping->area_id)->first();
        $total    = 0;
    ?>

    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Pembayaran</h1>
        </div>
    </div>

    <div style="width: 90%; margin: 0 auto;">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6>List Barang</h6>
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
                            <span>x<?= $product->quantity; ?></span> <br>
                            <span>Varian : <?= $product->sub_product_unit; ?></span>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input name="name" readonly="" value="<?= $shipping->name; ?>" class="form-control" type="text" placeholder="Your Name ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input name="email" readonly="" value="<?= $shipping->email; ?>" class="form-control" type="email" placeholder="Your Email ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Alamat</label>
                            <input name="address" readonly value="<?= $shipping->address; ?>" class="form-control" type="text" placeholder="Your Address ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input name="phone" readonly value="<?= $shipping->phone; ?>" class="form-control" type="text" placeholder="Your Phone ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Metode Pembayaran</label>
                            <input name="phone" readonly value="<?= ucwords(str_replace('_', ' ', $shipping->payment_option)); ?>" class="form-control" type="text" placeholder="Your Phone ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Area Antar</label>
                            <input name="phone" readonly value="<?= $area['area']; ?>" class="form-control" type="text" placeholder="Your Phone ...">
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-lg-12">
                <div class="mb-4">
                    <?php if ($errors = session()->getFlashdata('errors')): ?>
                        <div class="alert-danger alert">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <h4 class="font-weight-semi-bold mb-4">Pembayaran</h4>
                    <form action="<?= route_to('member.payments.store', $shipping->id); ?>" class="row" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="col-md-6 form-group">
                            <label>Bank Pengirim</label>
                            <input name="sender_bank" class="form-control" type="text" placeholder="Bank Pengirim. Cth: BCA, BRI ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Nomor Rekening Pengirim</label>
                            <input name="sender_account_number" class="form-control" type="text" placeholder="No Rekening ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Bank Dituju</label>
                            <select name="merchant_bank" class="custom-select">
                                <option value="">-- Nothing Selected --</option>
                                <option value="bri">18399848 [BRI]</option>
                                <option value="bca">3949859391 [BCA]</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Bukti Pembayaran</label>
                            <input name="proof" class="form-control" type="file" placeholder="Your Phone ...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Nama Pengirim</label>
                            <input name="sender_name" class="form-control" type="text" placeholder="Nama Pengirim ...">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-info">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>

<?= $this->endSection() ?>