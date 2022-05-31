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
            <li><a class="nav-link" href="<?= route_to('admin.dashboard.index'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Komunikasi</li>
            <li><a class="nav-link" href="<?= route_to('admin.chats.index'); ?>"><i class="fa fa-comment"></i> <span>Chat</span></a></li>
            <li class="menu-header">Additional</li>
            <li><a class="nav-link" href="<?= route_to('admin.product-categories.index'); ?>"><i class="fa fa-list"></i> <span>Kategori Produk</span></a></li>
            <li><a class="nav-link" href="<?= route_to('admin.products.index'); ?>"><i class="fa fa-shopping-bag"></i> <span>Produk</span></a></li>
            <li><a class="nav-link" href="<?= route_to('admin.shipping-costs.index'); ?>"><i class="fa fa-box"></i> <span>Area Pengiriman</span></a></li>
            <li class="menu-header">Pemesanan</li>
            <li><a class="nav-link" href="<?= route_to('admin.shippings.index'); ?>"><i class="fa fa-truck"></i> <span>Pengiriman</span></a></li>
            <li class="menu-header">Saran</li>
            <li><a class="nav-link" href="<?= route_to('admin.suggestions.index'); ?>"><i class="fa fa-envelope"></i> <span>Saran</span></a></li>
            <li class="menu-header">Keuangan</li>
            <li><a class="nav-link" href="<?= route_to('admin.expenditures.index'); ?>"><i class="fa fa-upload"></i> <span>Pengeluaran</span></a></li>
            <li><a class="nav-link" href="<?= route_to('admin.incomes.index'); ?>"><i class="fa fa-download"></i> <span>Pemasukan</span></a></li>
            <li><a class="nav-link" href="<?= route_to('admin.incomes.index'); ?>"><i class="fa fa-money-bill"></i> <span>Modal</span></a></li>
            <li class="menu-header">Laporan</li>
            <li><a class="nav-link" href="<?= route_to('admin.report.sale.index'); ?>"><i class="fa fa-print"></i> <span>Laporan Penjualan</span></a></li>
            <li><a class="nav-link" href="<?= route_to('admin.report.profit-loss.index'); ?>"><i class="fa fa-laptop"></i> <span>Laporan Rugi Laba</span></a></li>
        </ul>
    </aside>
</div>