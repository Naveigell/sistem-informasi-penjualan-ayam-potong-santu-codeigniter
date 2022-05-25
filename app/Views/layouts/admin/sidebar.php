<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Home</li>
            <li><a class="nav-link" href="<?= route_to('admin.products.index'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Additional</li>
            <li><a class="nav-link" href="<?= route_to('admin.product-categories.index'); ?>"><i class="fa fa-list"></i> <span>Kategori Produk</span></a></li>
            <li><a class="nav-link" href="<?= route_to('admin.products.index'); ?>"><i class="fa fa-shopping-bag"></i> <span>Produk</span></a></li>
            <li><a class="nav-link" href="<?= route_to('admin.shipping-costs.index'); ?>"><i class="fa fa-box"></i> <span>Area Pengiriman</span></a></li>
            <li class="menu-header">Orders</li>
            <li><a class="nav-link" href="<?= route_to('admin.shippings.index'); ?>"><i class="fa fa-truck"></i> <span>Pengiriman</span></a></li>
            <li class="menu-header">Keuangan</li>
            <li><a class="nav-link" href="<?= route_to('admin.finances.index'); ?>"><i class="fa fa-money-bill"></i> <span>Pemasukan</span></a></li>
        </ul>
    </aside>
</div>