<?php
    $totalCarts = 0;

    if (session()->has('hasLoggedIn')) {
        $totalCarts = (new \App\Models\Cart())->where('user_id', session()->get('user')->id)->countAll();
    }
?>

<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="<?= route_to('home'); ?>" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">EAyam</span>Santu</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="<?= route_to('member.carts.index'); ?>" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge"><?= $totalCarts; ?></span>
            </a>
            <?php if (session()->has('hasLoggedIn')): ?>
                <a href="<?= route_to('member.payments.index'); ?>" class="btn border">
                    <span class="badge"><?= session()->get('user')->email; ?></span>
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
                <a href="<?= route_to('member.auth.register.index'); ?>" class="btn border">
                    <i class="fa fa-door-open text-primary"></i>
                    <span class="badge">Register</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Topbar End -->