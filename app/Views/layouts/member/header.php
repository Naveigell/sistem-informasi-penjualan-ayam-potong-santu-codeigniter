<?php
    $totalCarts = 0;

    if (session()->has('hasLoggedIn')) {
        $totalCarts = (new \App\Models\Cart())->where('user_id', session()->get('user')->id)->countAll();
    }
?>

<?php
    $shippings = (new \App\Models\Shipping())->where('user_has_read', 0)->get()->getResultObject();
?>

<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-3 d-none d-lg-block">
            <a href="<?= route_to('home'); ?>" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E-Commerce</span><br>Daging Ayam Santu</h1>
            </a>
        </div>
        <div class="col-9 text-right">
            <a href="<?= session()->has('hasLoggedIn') ? route_to('member.carts.index') : '#'; ?>" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge"><?= $totalCarts; ?></span>
            </a>
            <?php if (session()->has('hasLoggedIn')): ?>
                <a class="btn border">
                    <span class="badge"><?= session()->get('user')->email; ?></span>
                </a>
                <a href="<?= route_to('member.suggestions.index'); ?>" class="btn border">
                    <i class="fas fa-envelope text-primary"></i>
                    <span class="badge">Saran</span>
                </a>
                <a href="<?= route_to('member.payments.index'); ?>" class="btn border">
                    <i class="fas fa-truck text-primary"></i>
                    <span class="badge">
                        Pengiriman &nbsp;&nbsp;&nbsp;

                        <?php if (count($shippings) > 0): ?>
                            <span class="badge badge-primary" style="font-size: 12px;"><?= count($shippings); ?></span>
                        <?php endif; ?>
                    </span>
                </a>
                <a href="<?= route_to('member.chats.index'); ?>" class="btn border">
                    <i class="fas fa-comment text-primary"></i>
                    <span class="badge">Pesan</span>
                </a>
                <a href="<?= route_to('logout'); ?>" class="btn border">
                    <i class="fa fa-sign-in-alt text-primary"></i>
                    <span class="badge">Logout</span>
                </a>
            <?php else: ?>
                <a href="<?= route_to('member.auth.login.index'); ?>" class="btn border">
                    <i class="fa fa-sign-in-alt text-primary"></i>
                    <span class="badge">Login</span>
                </a>
                <a href="<?= route_to('auth.password.email.index'); ?>" class="btn border">
                    <i class="fa fa-key text-primary"></i>
                    <span class="badge">Forget Password</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Topbar End -->