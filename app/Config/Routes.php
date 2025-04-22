<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// VISITOR
// Users
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginPost');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::registerPost');
$routes->get('/logout', 'AuthController::logout');



// CUSTOMER
$routes->get('/', 'Home::index');
$routes->get('/beranda', 'BerandaController::index');
$routes->get('/about-us', 'ProfileController::index');
$routes->get('/paket-layanan', 'PaketLayananController::index');

// Portofolio
$routes->get('/portofolio', 'PortofolioController::index');
$routes->get('portofolio-kategori-(:segment)', 'PortofolioController::kategori/$1');
$routes->get('portofolio-detail/(:num)', 'PortofolioController::detail/$1');


$routes->get('/portofolio-kategori', 'PortofolioController::kategori');
$routes->get('/portofolio-detail', 'PortofolioController::detail');
$routes->get('/reservasi', 'ReservasiController::index');
$routes->get('/login', 'LoginController::index');
$routes->get('/register', 'RegisterController::index');


// Dashboard sesuai role
$routes->get('/admin/dashboard', 'AdminController::dashboard', ['filter' => 'auth:admin']);
$routes->get('/user/dashboard', 'UserController::dashboard', ['filter' => 'auth:user']);



// ADMIN
$routes->get('/dashboard', 'BerandaController::index_admin');
$routes->get('/ketersediaan-jadwal', 'JadwalController::index');

// Profile Perusahaan Admin
$routes->get('/profile-perusahaan', 'ProfileController::index_admin');
$routes->get('/profile-perusahaan-add', 'ProfileController::add_admin');
$routes->post('/profile-perusahaan-store', 'ProfileController::store');
$routes->get('/profile-perusahaan-edit/(:num)', 'ProfileController::edit_admin/$1');
$routes->post('/profile-perusahaan-update/(:num)', 'ProfileController::update/$1');
$routes->get('/profile-perusahaan-delete/(:num)', 'ProfileController::delete/$1');

$routes->get('/data-pemesanan', 'PemesananController::index_admin');
$routes->get('/data-pemesanan-edit', 'PemesananController::edit_admin');
$routes->get('/laporan-keuangan', 'LaporanKeuanganController::index');
$routes->get('/riwayat-pemesanan', 'RiwayatPemesananController::index');
$routes->get('/portofolio-view', 'PortofolioController::view_admin');
$routes->get('/portofolio-add', 'PortofolioController::add_admin');
$routes->get('/portofolio-edit', 'PortofolioController::edit_admin');

// Paket Layanan Admin
$routes->get('admin/paket-layanan/index', 'PaketLayananController::index_admin');
$routes->get('admin/paket-layanan/add', 'PaketLayananController::add_admin');
$routes->post('admin/paket-layanan/proses-add', 'PaketLayananController::store');
$routes->get('admin/paket-layanan/edit/(:num)', 'PaketLayananController::edit_admin/$1');
$routes->post('admin/paket-layanan/proses-edit/(:num)', 'PaketLayananController::update/$1');
$routes->get('admin/paket-layanan/delete/(:num)', 'PaketLayananController::delete/$1');

// Portofolio Admin
$routes->get('admin/portofolio/index', 'PortofolioController::index_admin');
$routes->get('admin/portofolio/add', 'PortofolioController::add_admin');
$routes->post('admin/portofolio/proses-add', 'PortofolioController::store');
$routes->get('admin/portofolio/edit/(:num)', 'PortofolioController::edit_admin/$1');
$routes->post('admin/portofolio/proses-edit/(:num)', 'PortofolioController::update/$1');
$routes->get('admin/portofolio/delete/(:num)', 'PortofolioController::delete/$1');

