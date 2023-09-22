<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// $routes->get('/', 'Home::index');
$routes->get('/', 'Auth::login');
// $routes->get('/login', 'Auth::login');
$routes->match(['get', 'post'], 'login', 'Auth::login', ["filter" => "noauth"]);
// $routes->get('/register', 'Auth::register');
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/logout', 'Auth::logout');
$routes->match(['get', 'post'], 'register', 'Auth::register');
$routes->group("user", ["filter" => "auth"], function ($routes){
    $routes->get('about', 'about::index');
    $routes->get('dataset', 'dataset::index');
    $routes->get('dataset/(:segment)/detail', 'dataset::detail/$1');
    $routes->get('dataset/(:segment)/download', 'dataset::download/$1');
    $routes->get('dataset/(:segment)/edit', 'dataset::edit/$1');
    $routes->get('dataset/(:segment)/hapus', 'dataset::hapus/$1');
    $routes->post('dataset/update', 'dataset::update');
    $routes->get('dataset/store', 'dataset::store');
    $routes->post('dataset/store', 'dataset::store');
    $routes->get('visual', 'visual::index');
    $routes->get('visual/(:segment)/upload', 'visual::upload/$1');
    $routes->post('visual/upload', 'visual::upload');
    $routes->get('visual/(:segment)/download', 'visual::download/$1');
    $routes->get('visual/(:segment)/view/pdf', 'visual::view/$1');
});

$routes->group("admin", ["filter" => "auth"], function ($routes){
    $routes->get('dataset', 'dataset::index');
    $routes->get('dataset/(:segment)/detail', 'dataset::detail/$1');
    $routes->get('dataset/(:segment)/download', 'dataset::download/$1');
    $routes->get('dataset/store', 'dataset::store');
    $routes->post('dataset/store', 'dataset::store');
    $routes->get('user', 'user::index');
    $routes->get('visual', 'visual::index');
    $routes->get('visual/(:segment)/upload', 'visual::upload/$1');
    $routes->post('visual/upload', 'visual::upload');
    $routes->post('visual/update', 'visual::update');
    $routes->get('visual/(:segment)/view/pdf', 'visual::view/$1');
    $routes->get('visual/(:segment)/edit', 'visual::edit/$1');
    $routes->get('visual/(:segment)/hapus', 'visual::hapus/$1');
});

$routes->get('diagram', 'staff::diagram');
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
