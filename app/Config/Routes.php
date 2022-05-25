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
$routes->group('admin', function ($routes) {
    $routes->get('products', 'Admin\ProductController::index', ["as" => "admin.products.index"]);
    $routes->post('products', 'Admin\ProductController::store', ["as" => "admin.products.store"]);
    $routes->get('products/create', 'Admin\ProductController::create', ["as" => "admin.products.create"]);
    $routes->get('products/(:num)/edit', 'Admin\ProductController::edit/$1', ["as" => "admin.products.edit"]);
    $routes->put('products/(:num)', 'Admin\ProductController::update/$1', ["as" => "admin.products.update"]);
    $routes->delete('products/(:num)', 'Admin\ProductController::destroy/$1', ["as" => "admin.products.destroy"]);

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

    $routes->get('finances', 'Admin\FinanceController::index', ["as" => "admin.finances.index"]);
});

$routes->get('/', 'Home::index', ["as" => "home"]);
$routes->get('/login', 'Auth\MemberAuthController::login', ["as" => "member.auth.login.index"]);
$routes->post('/login', 'Auth\MemberAuthController::doLogin', ["as" => "member.auth.login.store"]);
$routes->get('/register', 'Auth\MemberAuthController::register', ["as" => "member.auth.register.index"]);
$routes->post('/register', 'Auth\MemberAuthController::doRegister', ["as" => "member.auth.register.store"]);
$routes->get('/logout', 'Auth\AuthController::logout', ["as" => "logout"]);

$routes->group('member', function ($routes) {
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

    $routes->get('reviews/(:num)', 'Member\ReviewController::index/$1', ["as" => "member.reviews.index"]);
    $routes->get('reviews/(:num)/product/(:num)', 'Member\ReviewController::edit/$1/$2', ["as" => "member.reviews.shipping.edit"]);
    $routes->post('reviews/(:num)/product/(:num)', 'Member\ReviewController::store/$1/$2', ["as" => "member.reviews.shipping.store"]);
});

$routes->post('/carts/(:num)', 'Member\CartController::store/$1', ["as" => "member.carts.store"]);
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
