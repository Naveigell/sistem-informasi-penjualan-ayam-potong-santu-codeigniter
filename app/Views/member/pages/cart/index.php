<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>
<?php /** @var array $carts */ ?>

<?php $total = array_reduce($carts, function ($initial, $cart) {
    return $initial + $cart->quantity * $cart->price;
}, 0); ?>

<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Keranjang Belanja</h1>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="align-middle">
                    <?php foreach ($carts as $cart): ?>
                        <tr>
                            <td class="align-middle"><img src="<?= base_url('/uploads/images/products/' . $cart->media); ?>" alt="" style="width: 50px;"> <?= $cart->name; ?></td>
                            <td class="align-middle"><?= format_number($cart->price); ?></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" disabled value="<?= $cart->quantity; ?>">
                                </div>
                            </td>
                            <td class="align-middle"><?= $cart->unit; ?></td>
                            <td class="align-middle"><?= format_number($cart->quantity * $cart->price); ?></td>
                            <td class="align-middle"><button data-url="<?= route_to('member.carts.destroy', $cart->id); ?>" data-target="#deleteModal" data-toggle="modal" class="btn btn-sm btn-primary btn-delete"><i class="fa fa-times"></i></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Ringkasan Belanja</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium"><?= format_number($total); ?></h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold"><?= format_number($total); ?></h5>
                    </div>
                    <?php if(count($carts) > 0): ?>
                        <a href="<?= route_to('member.checkouts.index'); ?>" class="btn btn-block btn-primary my-3 py-3">Proses Pembelian</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" id="form-delete" method="post" action="">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="delete">
            <div class="modal-header">
                <h5 class="modal-title">Hapus item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Item tidak akan bisa dikembalikan</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        $(".btn-delete").on('click', function () {
            $('#form-delete').attr("action", $(this).data('url'));
        })
    </script>
<?= $this->endSection() ?>