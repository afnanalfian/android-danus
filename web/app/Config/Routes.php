<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/me', 'Me::index');
$routes->get('/android/login', 'AndroidUser::login');
$routes->post('/android/login', 'AndroidUser::login');
$routes->get('/android/register', 'AndroidUser::register');
$routes->post('/android/register', 'AndroidUser::register');
$routes->get('/android/update', 'AndroidUser::updateprofile');
$routes->post('/android/update', 'AndroidUser::updateprofile');
$routes->get('/android/addfood', 'AndroidUser::addfood');
$routes->post('/android/addfood', 'AndroidUser::addfood');
$routes->get('/android/listmenu', 'AndroidUser::listmenu');
$routes->post('/android/listmenu', 'AndroidUser::listmenu');
$routes->get('/android/listorder', 'AndroidUser::listorder');
$routes->post('/android/listorder', 'AndroidUser::listorder');
// $routes->resource('product');
$routes->get('/admin/login/auth', 'LoginAdmin::auth');
$routes->post('/admin/login/auth', 'LoginAdmin::auth');
$routes->get('/index.php/admin/signin', 'Home::signinadmin');
$routes->get('/admin/signin', 'Home::signinadmin');
$routes->get('/admin/signup', 'Home::signupadmin');
$routes->get('/admin/logout', 'LoginAdmin::logout');
$routes->post('/admin/menu', 'MenuOrder::profilAdmin',['filter' => 'authadmin']);
$routes->get('/admin/menu', 'MenuOrder::profilAdmin',['filter' => 'authadmin']);
$routes->get('/admin/order', 'MenuOrder::orderAdmin');
$routes->get('/admin/profile/(:segment)', 'RegisterAdmin::editprofile/$1');
$routes->post('/admin/profile/update/(:segment)', 'RegisterAdmin::updateaccount/$1');
$routes->post('/admin/register/save', 'RegisterAdmin::saveaccount');
$routes->get('/user/login/auth', 'LoginUser::auth');
$routes->post('/user/login/auth', 'LoginUser::auth');
$routes->get('/user/signin', 'Home::signinuser');
$routes->get('/user/signup', 'Home::signupuser');
$routes->get('/user/logout', 'LoginUser::logout');
$routes->post('/user/menu', 'MenuOrder::profilUser',['filter' => 'authuser']);
$routes->get('/user/menu', 'MenuOrder::profilUser',['filter' => 'authuser']);
$routes->get('/user/order/(:segment)', 'MenuOrder::orderUser/$1');
$routes->get('/user/profile/(:segment)', 'RegisterUser::editprofile/$1');
$routes->post('/user/profile/update/(:segment)', 'RegisterUser::updateaccount/$1');
$routes->post('/user/register/save', 'RegisterUser::saveaccount');
$routes->post('/menu/save', 'MenuOrder::savemenu');
$routes->get('/menu/edit/(:segment)', 'MenuOrder::editmenu/$1');
$routes->post('/menu/update', 'MenuOrder::updatemenu');
$routes->get('/menu/delete/(:segment)', 'MenuOrder::deletemenu/$1');
$routes->post('/order/save', 'MenuOrder::saveorder');
$routes->get('/order/delete/(:segment)', 'MenuOrder::deleteorder/$1');
$routes->resource('menu');
$routes->resource('order');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
