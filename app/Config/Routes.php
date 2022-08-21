<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/admin/login', 'Auth\AdminAuthController::index', ["as" => "admin.auth.login.index"]);
$routes->post('/admin/login', 'Auth\AdminAuthController::store', ["as" => "admin.auth.login.store"]);

$routes->group('admin', ['filter' => 'adminfilter'], function ($routes) {

    $routes->get('chats', 'Admin\ChatController::index', ["as" => "admin.chats.index"]);
    $routes->get('chats/(:num)', 'Admin\ChatController::show/$1', ["as" => "admin.chats.show"]);
    $routes->post('chats/(:num)', 'Admin\ChatController::store/$1', ["as" => "admin.chats.store"]);

    $routes->get('products/(:num)/medias', 'Admin\ProductMediaController::index/$1', ["as" => "admin.product-medias.index"]);
    $routes->post('products/(:num)/medias', 'Admin\ProductMediaController::store/$1', ["as" => "admin.product-medias.store"]);
    $routes->get('products/(:num)/medias/create', 'Admin\ProductMediaController::create/$1', ["as" => "admin.product-medias.create"]);
    $routes->get('products/(:num)/medias/(:num)/edit', 'Admin\ProductMediaController::edit/$1/$2', ["as" => "admin.product-medias.edit"]);
    $routes->put('products/(:num)/medias/(:num)', 'Admin\ProductMediaController::update/$1/$2', ["as" => "admin.product-medias.update"]);
    $routes->delete('products/(:num)/medias/(:num)', 'Admin\ProductMediaController::destroy/$1/$2', ["as" => "admin.product-medias.destroy"]);

    $routes->get('products/(:num)/subs', 'Admin\SubProductController::index/$1', ["as" => "admin.sub-products.index"]);
    $routes->post('products/(:num)/subs', 'Admin\SubProductController::store/$1', ["as" => "admin.sub-products.store"]);
    $routes->get('products/create/(:num)/subs', 'Admin\SubProductController::create/$1', ["as" => "admin.sub-products.create"]);
    $routes->get('products/(:num)/edit/subs/(:num)', 'Admin\SubProductController::edit/$1/$2', ["as" => "admin.sub-products.edit"]);
    $routes->put('products/(:num)/subs/(:num)', 'Admin\SubProductController::update/$1/$2', ["as" => "admin.sub-products.update"]);
    $routes->delete('products/(:num)/subs/(:num)', 'Admin\SubProductController::destroy/$1/$2', ["as" => "admin.sub-products.destroy"]);

    $routes->get('products', 'Admin\ProductController::index', ["as" => "admin.products.index"]);
    $routes->post('products', 'Admin\ProductController::store', ["as" => "admin.products.store"]);
    $routes->get('products/create', 'Admin\ProductController::create', ["as" => "admin.products.create"]);
    $routes->get('products/(:num)/edit', 'Admin\ProductController::edit/$1', ["as" => "admin.products.edit"]);
    $routes->put('products/(:num)', 'Admin\ProductController::update/$1', ["as" => "admin.products.update"]);
    $routes->delete('products/(:num)', 'Admin\ProductController::destroy/$1', ["as" => "admin.products.destroy"]);

    $routes->get('capitals', 'Admin\CapitalController::index', ["as" => "admin.capitals.index"]);
    $routes->post('capitals', 'Admin\CapitalController::store', ["as" => "admin.capitals.store"]);
    $routes->get('capitals/create', 'Admin\CapitalController::create', ["as" => "admin.capitals.create"]);
    $routes->get('capitals/(:num)/edit', 'Admin\CapitalController::edit/$1', ["as" => "admin.capitals.edit"]);
    $routes->put('capitals/(:num)', 'Admin\CapitalController::update/$1', ["as" => "admin.capitals.update"]);
    $routes->delete('capitals/(:num)', 'Admin\CapitalController::destroy/$1', ["as" => "admin.capitals.destroy"]);

    $routes->get('product_categories', 'Admin\ProductCategoryController::index', ["as" => "admin.product-categories.index"]);
    $routes->post('product_categories', 'Admin\ProductCategoryController::store', ["as" => "admin.product-categories.store"]);
    $routes->get('product_categories/create', 'Admin\ProductCategoryController::create', ["as" => "admin.product-categories.create"]);
    $routes->get('product_categories/(:num)/edit', 'Admin\ProductCategoryController::edit/$1', ["as" => "admin.product-categories.edit"]);
    $routes->put('product_categories/(:num)', 'Admin\ProductCategoryController::update/$1', ["as" => "admin.product-categories.update"]);
    $routes->delete('product_categories/(:num)', 'Admin\ProductCategoryController::destroy/$1', ["as" => "admin.product-categories.destroy"]);

    $routes->get('shipping-costs', 'Admin\ShippingCostController::index', ["as" => "admin.shipping-costs.index"]);
    $routes->post('shipping-costs', 'Admin\ShippingCostController::store', ["as" => "admin.shipping-costs.store"]);
    $routes->get('shipping-costs/create', 'Admin\ShippingCostController::create', ["as" => "admin.shipping-costs.create"]);
    $routes->get('shipping-costs/(:num)/edit', 'Admin\ShippingCostController::edit/$1', ["as" => "admin.shipping-costs.edit"]);
    $routes->put('shipping-costs/(:num)', 'Admin\ShippingCostController::update/$1', ["as" => "admin.shipping-costs.update"]);
    $routes->delete('shipping-costs/(:num)', 'Admin\ShippingCostController::destroy/$1', ["as" => "admin.shipping-costs.destroy"]);

    $routes->get('shippings', 'Admin\ShippingController::index', ["as" => "admin.shippings.index"]);
    $routes->post('shippings', 'Admin\ShippingController::store', ["as" => "admin.shippings.store"]);
    $routes->get('shippings/create', 'Admin\ShippingController::create', ["as" => "admin.shippings.create"]);
    $routes->get('shippings/(:num)/edit', 'Admin\ShippingController::edit/$1', ["as" => "admin.shippings.edit"]);
    $routes->put('shippings/(:num)', 'Admin\ShippingController::update/$1', ["as" => "admin.shippings.update"]);
    $routes->delete('shippings/(:num)', 'Admin\ShippingController::destroy/$1', ["as" => "admin.shippings.destroy"]);

    $routes->put('shippings/(:num)/status', 'Admin\ShippingController::status/$1', ["as" => "admin.shippings.status"]);

    $routes->get('incomes', 'Admin\IncomeController::index', ["as" => "admin.incomes.index"]);

    $routes->get('suggestions', 'Admin\SuggestionController::index', ["as" => "admin.suggestions.index"]);

    $routes->get('dashboard', 'Admin\DashboardController::index', ["as" => "admin.dashboard.index"]);

    $routes->get('reports/profit-loss', 'Admin\ProfitLossReportController::index', ["as" => "admin.report.profit-loss.index"]);
    $routes->get('reports/profit-loss/print', 'Admin\ProfitLossReportController::print', ["as" => "admin.report.profit-loss.print"]);

    $routes->get('reports/sale', 'Admin\SaleReportController::index', ["as" => "admin.report.sale.index"]);
    $routes->get('reports/sale/print', 'Admin\SaleReportController::print', ["as" => "admin.report.sale.print"]);

    $routes->get('expenditures', 'Admin\ExpenditureController::index', ["as" => "admin.expenditures.index"]);
    $routes->get('expenditures/create', 'Admin\ExpenditureController::create', ["as" => "admin.expenditures.create"]);
    $routes->get('expenditures/(:num)/edit', 'Admin\ExpenditureController::edit/$1', ["as" => "admin.expenditures.edit"]);
    $routes->post('expenditures', 'Admin\ExpenditureController::store', ["as" => "admin.expenditures.store"]);
    $routes->put('expenditures/(:num)', 'Admin\ExpenditureController::update/$1', ["as" => "admin.expenditures.update"]);
    $routes->delete('expenditures/(:num)', 'Admin\ExpenditureController::destroy/$1', ["as" => "admin.expenditures.destroy"]);
});

$routes->get('/', 'Home::index', ["as" => "home"]);
$routes->get('/login', 'Auth\MemberAuthController::login', ["as" => "member.auth.login.index"]);
$routes->get('/forget-password', 'Auth\AuthController::forgetPasswordIndex', ["as" => "auth.password.email.index"]);
$routes->post('/forget-password', 'Auth\AuthController::forgetPasswordStore', ["as" => "auth.password.email.store"]);
$routes->get('/password', 'Auth\AuthController::passwordIndex', ["as" => "auth.password.index"]);
$routes->post('/password', 'Auth\AuthController::passwordStore', ["as" => "auth.password.store"]);
$routes->post('/login', 'Auth\MemberAuthController::doLogin', ["as" => "member.auth.login.store"]);
$routes->get('/register', 'Auth\MemberAuthController::register', ["as" => "member.auth.register.index"]);
$routes->post('/register', 'Auth\MemberAuthController::doRegister', ["as" => "member.auth.register.store"]);
$routes->get('/logout', 'Auth\AuthController::logout', ["as" => "logout"]);

$routes->group('member', function ($routes) {
    $routes->get('chats', 'Member\ChatController::index', ["as" => "member.chats.index"]);
    $routes->post('chats', 'Member\ChatController::store/$1', ["as" => "member.chats.store"]);

    $routes->get('carts', 'Member\CartController::index', ["as" => "member.carts.index"]);
    $routes->delete('carts/(:num)', 'Member\CartController::destroy/$1', ["as" => "member.carts.destroy"]);

    $routes->get('checkouts', 'Member\CheckoutController::index/$1', ["as" => "member.checkouts.index"]);
    $routes->post('checkouts', 'Member\CheckoutController::store/$1', ["as" => "member.checkouts.store"]);

    $routes->get('payments', 'Member\PaymentController::index/$1', ["as" => "member.payments.index"]);
    $routes->get('payments/(:num)', 'Member\PaymentController::edit/$1', ["as" => "member.payments.edit"]);
    $routes->post('payments/(:num)', 'Member\PaymentController::store/$1', ["as" => "member.payments.store"]);
    $routes->get('payments/(:num)/nota', 'Member\PaymentController::nota/$1', ["as" => "member.payments.nota"]);

    $routes->get('shippings/(:num)/timeline', 'Member\ShippingController::timeline/$1', ["as" => "member.shippings.timeline"]);
    $routes->put('shippings/(:num)/finish', 'Member\ShippingController::finish/$1', ["as" => "member.shippings.finish"]);
    $routes->put('shippings/(:num)/notification', 'Member\ShippingController::notification/$1', ["as" => "member.shippings.notification"]);

    $routes->get('reviews/(:num)', 'Member\ReviewController::index/$1', ["as" => "member.reviews.index"]);
    $routes->get('reviews/(:num)/product/(:num)/sub/(:num)', 'Member\ReviewController::edit/$1/$2/$3', ["as" => "member.reviews.shipping.edit"]);
    $routes->post('reviews/(:num)/product/(:num)/sub/(:num)', 'Member\ReviewController::store/$1/$2/$3', ["as" => "member.reviews.shipping.store"]);

    $routes->get('suggestions', 'Member\SuggestionController::index', ["as" => "member.suggestions.index"]);
    $routes->post('suggestions', 'Member\SuggestionController::store', ["as" => "member.suggestions.store"]);
});

$routes->post('/carts/(:num)/(:num)', 'Member\CartController::store/$1/$2', ["as" => "member.carts.store"]);
$routes->get('/(:any)/(:any)', 'Home::detail/$1/$2', ["as" => "member.home.detail"]);
$routes->get('/(:any)', 'Home::category/$1', ["as" => "member.home.categories"]);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
