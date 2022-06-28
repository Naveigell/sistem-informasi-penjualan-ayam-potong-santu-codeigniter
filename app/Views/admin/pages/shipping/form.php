<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Shippings
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <?php /** @var array $orders */ ?>
    <?php /** @var object $shipping */ ?>

    <?php
        $total = array_reduce($orders, function ($initial, $order) {
            return $initial + $order->sub_product_price * $order->quantity;
        }, 0);
    ?>

    <div class="card mb-4 col-12">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6>List Barang</h6>
        </div>
        <div class="card-body">
            <?php foreach ($orders as $order): ?>

                <?php
                    $media = (new \App\Models\ProductMedia())->where('product_id', $order->product_id)->where('type', \App\Models\ProductMedia::TYPE_IMAGE)->first();
                ?>

                <div class="row mb-4">
                    <div class="col-2">
                        <img style="width: 100px; height: 100px;" src="<?= base_url('/uploads/images/products/' . $media['media']); ?>" alt="">
                    </div>
                    <div class="col-8">
                        <p><?= $order->name; ?></p>
                        <span><?= format_number($order->sub_product_price); ?></span> <br>
                        <span>x<?= $order->quantity; ?></span> <br>
                        <span>Varian : <?= $order->sub_product_unit; ?></span> <br>
                    </div>
                    <div class="col-2">
                        <span class="text text-danger"><?= format_number($order->sub_product_price * $order->quantity); ?></span>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
            <div class="row">
                <div class="col-12">
                    <p>Ongkos Kirim : <?= format_number($shipping->cost); ?></p>
                    <p>Total : <?= format_number($total + $shipping->cost); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card col-12">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6>Data Pembeli</h6>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="mb-3">
                    <?php if ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && !$shipping->proof): ?>
                        <span class="badge badge-warning">Belum dibayar</span>
                    <?php elseif ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && $shipping->payment_status == \App\Models\Payment::STATUS_WAITING): ?>
                        <span class="badge badge-info">Menunggu validasi pembayaran</span>
                    <?php elseif ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && $shipping->payment_status == \App\Models\Payment::STATUS_VALID): ?>
                        <span class="badge badge-primary">Valid</span>
                    <?php elseif ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && $shipping->payment_status == \App\Models\Payment::STATUS_INVALID): ?>
                        <span class="badge badge-danger">Invalid</span>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-<?= $shipping->payment_option == \App\Models\Payment::PAYMENT_COD ? '12' : '6'; ?>">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" disabled value="<?= $shipping->name; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" disabled value="<?= $shipping->email; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" disabled value="<?= $shipping->address; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="text" disabled value="<?= $shipping->phone; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <input type="text" disabled value="<?= str_replace('_', ' ', $shipping->payment_option); ?>" class="form-control">
                        </div>
                        <?php if ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && $shipping->proof && $shipping->payment_status != \App\Models\Payment::STATUS_VALID): ?>
                            <form class="form-group" method="post" action="<?= route_to('admin.shippings.update', $shipping->id); ?>">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="put">
                                <label>Validitas Pembayaran</label>
                                <select name="status" id="" class="form-control">
                                    <option value="">-- Nothing Selected --</option>
                                    <option value="<?= \App\Models\Payment::STATUS_VALID; ?>">valid</option>
                                    <option value="<?= \App\Models\Payment::STATUS_INVALID; ?>">invalid</option>
                                </select>
                                <br>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        <?php elseif (!($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER && !$shipping->proof)): ?>
                            <form action="<?= route_to('admin.shippings.status', $shipping->id); ?>" method="post">
                                <?php if ($errors = session()->getFlashdata('errors')): ?>
                                    <div class="alert-danger alert">
                                        <ul>
                                            <?php foreach ($errors as $error): ?>
                                                <li><?= $error; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="put">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Tulis status</label>
                                        <input type="text" class="form-control" name="status">
                                        <input type="hidden" class="form-control" name="index">
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Auto fill status</label>
                                        <select name="" id="auto-fill" class="form-control">
                                            <option value="">-- Nothing Selected --</option>
                                            <?php foreach(history_list() as $index => $history): ?>
                                                <option value="<?= $index; ?>"><?= $history; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>

                    <?php if ($shipping->payment_option == \App\Models\Payment::PAYMENT_BANK_TRANSFER): ?>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Bank Pengirim</label>
                                <input type="text" disabled value="<?= $shipping->sender_bank ?? '-'; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor Rekening</label>
                                <input type="text" disabled value="<?= $shipping->sender_account_number ?? '-'; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Pengirim</label>
                                <input type="text" disabled value="<?= $shipping->sender_name ?? '-'; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Bank Penerima</label>
                                <input type="text" disabled value="<?= $shipping->merchant_bank ?? '-'; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Bukti Pembayaran</label>
                                <div class="" style="border: 1px dashed #5f5c5c; border-radius: 5px;">
                                    <img width="100%" src="<?= base_url('/uploads/images/payments/' . $shipping->proof); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
<script>
    let autofill = $('#auto-fill');
    autofill.on('change', function () {
        $('input[name="status"]').val($(this).find(":selected").text());
        $('input[name="index"]').val($(this).val());
    });
</script>
<?= $this->endSection() ?>
