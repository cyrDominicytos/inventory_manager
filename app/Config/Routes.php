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
$routes->setDefaultController('Auth');
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
$routes->get('/', 'Auth::index');
$routes->get('/logout', 'Auth::logout');
$routes->post('/sign_in', 'Auth::login');

//user management routes
$routes->post('/sign_up', 'Auth::create_user');
$routes->post('/user/update/(:num)', 'Auth::edit_user/$1');
$routes->get('/user/edit/(:num)', 'Auth::update_user/$1');
$routes->get('/user/banish/(:num)', 'Auth::deactivate/$1');
$routes->get('/user/activate/(:num)', 'Auth::activate/$1');
$routes->get('/users/list', 'Users::list');

$routes->get('/login', 'Auth::index');
$routes->get('/register', 'Auth::register');

//external management routes : 
$routes->get('/external/list', 'ExternalEntity::list');
$routes->get('/client/list', 'ExternalEntity::list/1/0');
$routes->get('/client/list_create', 'ExternalEntity::list/1/1');
$routes->get('/fournisseur/list', 'ExternalEntity::list/2/0');
$routes->get('/fournisseur/list_create', 'ExternalEntity::list/2/1');
$routes->get('/livreur/list', 'ExternalEntity::list/3/0');
$routes->get('/livreur/list_create', 'ExternalEntity::list/3/1');
$routes->post('/external/create', 'ExternalEntity::create_external');
$routes->get('/external/banish/(:num)/(:num)', 'ExternalEntity::deactivate/$1/$2');
$routes->get('/external/activate/(:num)/(:num)', 'ExternalEntity::activate/$1/$2');
$routes->post('/external/edit', 'ExternalEntity::edit_external');
//dashboard
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/back', 'Auth::back');


//ProductCategory management
$routes->get('/product_category/list', 'ProductCategory::list/1/0');
$routes->get('/product_category/list_create', 'ProductCategory::list/1/1');
$routes->get('/sales_option/list', 'ProductCategory::list/2/0');
$routes->get('/sales_option/list_create', 'ProductCategory::list/2/1');
$routes->post('/product_category/create', 'ProductCategory::create_external');
$routes->get('/product_category/banish/(:num)/(:num)', 'ProductCategory::deactivate/$1/$2');
$routes->get('/product_category/activate/(:num)/(:num)', 'ProductCategory::activate/$1/$2');
$routes->post('/product_category/edit', 'ProductCategory::edit_external');

//Product management
$routes->get('/product/list', 'Product::list/0');
$routes->get('/product/list_create', 'Product::list/1');
$routes->post('/product/create', 'Product::create');
$routes->get('/product/banish/(:num)', 'Product::deactivate/$1');
$routes->get('/product/activate/(:num)', 'Product::activate/$1');
$routes->post('/product/edit', 'Product::edit');
//Product management
$routes->get('/product/list', 'Product::list/0');
$routes->get('/product/list_create', 'Product::list/1');
$routes->post('/product/create', 'Product::create');
$routes->get('/product/banish/(:num)', 'Product::deactivate/$1');
$routes->get('/product/activate/(:num)', 'Product::activate/$1');
$routes->post('/product/edit', 'Product::edit');

//Product Price management
$routes->get('/price/list', 'Price::list/0');
$routes->get('/price/list_create', 'Price::list/1');
$routes->post('/price/create', 'Price::create');
$routes->get('/price/delete/(:num)', 'Price::delete/$1');
$routes->post('/price/edit', 'Price::edit');


//Order management
$routes->get('/order/new', 'Order::new');
$routes->get('/order/list', 'Order::list');
$routes->get('/order/update/(:num)', 'Order::update/$1');
$routes->get('/order/delete/(:num)', 'Order::delete/$1');
$routes->post('/order/create', 'Order::create');
$routes->post('/order/edit', 'Order::edit');
$routes->get('/order/vue', 'Order::vue/$1');
$routes->get('/order/sale', 'Order::sale/$1');


//Supply management
$routes->get('/supply/new', 'Supply::new');
$routes->get('/supply/list', 'Supply::list');
$routes->get('/supply/update/(:num)', 'Supply::update/$1');
$routes->get('/supply/delete/(:num)', 'Supply::delete/$1');
$routes->post('/supply/create', 'Supply::create');
$routes->post('/supply/edit', 'Supply::edit');

//sell management
$routes->get('/sell/new', 'Sell::new');
$routes->get('/sell/list', 'Sell::list');
$routes->get('/sell/update/(:num)', 'Sell::update/$1');
$routes->get('/sell/delete/(:num)', 'Sell::delete/$1');
$routes->post('/sell/create', 'Sell::create');
$routes->post('/sell/edit', 'Sell::edit');
$routes->get('/sell/invoice', 'Sell::invoice/$1');
$routes->get('/sell/normalize', 'Sell::normalize/$1');
$routes->get('/sell/vue', 'Sell::vue/$1');

//Inventory management
$routes->get('/inventory', 'Inventory::list');


//Dynamic
$routes->post('/dynamic/product', 'Dynamic::product');
$routes->post('/dynamic/sale_options', 'Dynamic::sale_options');
$routes->post('/dynamic/assign_sale_options', 'Dynamic::assign_sale_options');


//roles and permissions
$routes->get('/groups/list', 'Auth::role_permission');
$routes->get('/groups/new', 'Auth::new_group');
$routes->post('/groups/create', 'Auth::create_group');
$routes->get('/groups/update/(:num)', 'Auth::update_group/$1');
$routes->get('/groups/view/(:num)', 'Auth::view_group/$1');
$routes->post('/groups/edit/(:num)', 'Auth::edit_group/$1');
$routes->get('/groups/delete/(:num)', 'Auth::delete_group/$1');

//config routes
$routes->get('/config', 'Config::config');
$routes->post('/config/save', 'Config::save');


//$routes->get('news/(:segment)', 'News::view/$1');
//$routes->get('news', 'News::index');

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
