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
