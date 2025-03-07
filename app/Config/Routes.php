<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/beranda', 'BerandaController::index');
$routes->get('/about-us', 'ProfileController::index');
$routes->get('/portofolio', 'PortofolioController::index');
$routes->get('/portofolio-kategori', 'PortofolioController::kategori');
$routes->get('/portofolio-detail', 'PortofolioController::detail');
$routes->get('/reservasi', 'ReservasiController::index');
$routes->get('/login', 'LoginController::index');
$routes->get('/register', 'RegisterController::index');

$routes->get('/dashboard', 'BerandaController::index_admin');
$routes->get('/ketersediaan-jadwal', 'JadwalController::index');
$routes->get('/profile-perusahaan', 'ProfileController::index_admin');
$routes->get('/profile-perusahaan-add', 'ProfileController::add_admin');
$routes->get('/profile-perusahaan-edit', 'ProfileController::edit_admin');
$routes->get('/data-pemesanan', 'PemesananController::index_admin');
$routes->get('/data-pemesanan-edit', 'PemesananController::edit_admin');
$routes->get('/laporan-keuangan', 'LaporanKeuanganController::index');
$routes->get('/riwayat-pemesanan', 'RiwayatPemesananController::index');
