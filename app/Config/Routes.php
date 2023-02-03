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
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/admin/dashboard', 'Admin::dashboard', ['filter' => 'role:Admin']);
$routes->get('/admin/kategori_berita', 'Admin::kategori_berita', ['filter' => 'role:Admin']);
$routes->get('/admin/jenis_langganan', 'Admin::jenis_langganan', ['filter' => 'role:Admin']);
$routes->get('/admin/laporan_masyarakat', 'Admin::laporan_masyarakat', ['filter' => 'role:Admin']);
$routes->get('/admin/tagline', 'Admin::tagline', ['filter' => 'role:Admin']);
$routes->get('/admin/data_kecelakaan', 'Admin::data_kecelakaan', ['filter' => 'role:Admin']);
$routes->get('/admin/data_politik', 'Admin::data_politik', ['filter' => 'role:Admin']);
$routes->get('/admin/data_ekonomi', 'Admin::data_ekonomi', ['filter' => 'role:Admin']);
$routes->get('/admin/data_olahraga', 'Admin::data_olahraga', ['filter' => 'role:Admin']);
$routes->get('/admin/moderasi_berita', 'Admin::moderasi_berita', ['filter' => 'role:Admin']);
$routes->get('/admin/moderasi_laporan', 'Admin::moderasi_laporan', ['filter' => 'role:Admin']);
$routes->get('/admin/user_free', 'Admin::user_free', ['filter' => 'role:Admin']);
$routes->get('/admin/user_premium', 'Admin::user_premium', ['filter' => 'role:Admin']);
$routes->get('/admin/admin', 'Admin::admin', ['filter' => 'role:Admin']);
$routes->get('/admin/data_komentar', 'Admin::data_komentar', ['filter' => 'role:Admin']);
$routes->get('/admin/data_pembayaran', 'Admin::data_pembayaran', ['filter' => 'role:Admin']);
$routes->get('/admin/data_invoice', 'Admin::data_invoice', ['filter' => 'role:Admin']);
$routes->get('/home/edit_profile', 'Home::edit_profile', ['filter' => 'role:Admin,User']);
$routes->get('/home/edit_post', 'Home::edit_post', ['filter' => 'role:User']);
$routes->get('/home/pilih_langganan', 'Home::pilih_langganan', ['filter' => 'role:User']);
$routes->get('/home/history_pembayaran', 'Home::history_pembayaran', ['filter' => 'role:User']);

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
