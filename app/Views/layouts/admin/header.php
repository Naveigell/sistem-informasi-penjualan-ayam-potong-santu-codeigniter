<style>
    .dropdown-list .dropdown-list-content:not(.is-end):after {
        content: ' ';
        position: absolute;
        bottom: 46px;
        left: 0;
        width: 100%;
        background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.8));
        height: 60px;
        visibility: hidden;
    }
</style>

<?php
    $shippings = (new \App\Models\Shipping())->where('has_read', 0)->get()->getResultObject();
?>

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep" aria-expanded="false">
                <i class="far fa-bell"></i>
                <span class="font-weight-bold" style="font-size: 17px;"><?= count($shippings); ?></span>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifikasi</div>
                <div class="dropdown-list-content dropdown-list-icons" tabindex="3" style="overflow-y: auto;">
                    <?php foreach ($shippings as $shipping): ?>
                        <a href="<?= route_to('admin.shippings.edit', $shipping->id); ?>" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-primary text-white">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Ada Order Baru!
                                <div class="time">Order Id : <span class="text-primary"><?= ucwords($shipping->order_id); ?></span></div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block"><?= session()->get('user')->email; ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="<?= route_to('logout'); ?>" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>