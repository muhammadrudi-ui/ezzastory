<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Customer
$routes->get('/', 'Home::index');
$routes->get('/beranda', 'BerandaController::index');
$routes->get('/about-us', 'ProfileController::index');
$routes->get('/paket-layanan', 'PaketLayananController::index');
$routes->get('/portofolio', 'PortofolioController::index');
$routes->get('/portofolio-kategori', 'PortofolioController::kategori');
$routes->get('/portofolio-detail', 'PortofolioController::detail');
$routes->get('/reservasi', 'ReservasiController::index');
$routes->get('/login', 'LoginController::index');
$routes->get('/register', 'RegisterController::index');

// Admin
$routes->get('/dashboard', 'BerandaController::index_admin');
$routes->get('/ketersediaan-jadwal', 'JadwalController::index');
$routes->get('/profile-perusahaan', 'ProfileController::index_admin');
$routes->get('/profile-perusahaan-add', 'ProfileController::add_admin');
$routes->get('/profile-perusahaan-edit', 'ProfileController::edit_admin');
$routes->get('/data-pemesanan', 'PemesananController::index_admin');
$routes->get('/data-pemesanan-edit', 'PemesananController::edit_admin');
$routes->get('/laporan-keuangan', 'LaporanKeuanganController::index');
$routes->get('/riwayat-pemesanan', 'RiwayatPemesananController::index');
$routes->get('/portofolio-view', 'PortofolioController::view_admin');
$routes->get('/portofolio-add', 'PortofolioController::add_admin');
$routes->get('/portofolio-edit', 'PortofolioController::edit_admin');

// Paket Layanan Admin
// Routes for Paket Layanan
$routes->get('/paket-layanan-view', 'PaketLayananController::view_admin');
$routes->get('/paket-layanan-add', 'PaketLayananController::add_admin');
$routes->post('/paket-layanan-store', 'PaketLayananController::store');
$routes->get('/paket-layanan-edit/(:num)', 'PaketLayananController::edit_admin/$1');
$routes->post('/paket-layanan-update/(:num)', 'PaketLayananController::update/$1');
$routes->get('/paket-layanan-delete/(:num)', 'PaketLayananController::delete/$1');

