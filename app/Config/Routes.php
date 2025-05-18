<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// VISITOR (Akses Publik, Tanpa Login)
// Profile Perusahaan
$routes->get('/', 'BerandaController::index_visitor');
$routes->get('visitor/tentang-kami', 'ProfileController::index_visitor');

// Portofolio untuk pengunjung
$routes->get('visitor/portofolio/index', 'PortofolioController::index_visitor');
$routes->get('visitor/portofolio/kategori-(:segment)', 'PortofolioController::kategori_visitor/$1');
$routes->get('visitor/portofolio/detail/(:num)', 'PortofolioController::detail_visitor/$1');


// -----------------------------------------------------------------------------------


// Auth User (Akses Publik)
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginPost');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::registerPost');
$routes->get('/logout', 'AuthController::logout');


// -----------------------------------------------------------------------------------


// CUSTOMER (role = user)
$routes->group('user', ['filter' => 'user'], function ($routes) {
    // Profile
    $routes->get('profile', 'AuthController::profile');
    $routes->post('profile/update', 'AuthController::updateProfile');

    // Beranda dan Profile Perusahaan
    $routes->get('beranda', 'BerandaController::index');
    $routes->get('tentang-kami', 'ProfileController::index');

    // Paket Layanan
    $routes->get('paket-layanan', 'PaketLayananController::index');

    // Portofolio
    $routes->get('portofolio/index', 'PortofolioController::index');
    $routes->get('portofolio/kategori-(:segment)', 'PortofolioController::kategori/$1');
    $routes->get('portofolio/detail/(:num)', 'PortofolioController::detail/$1');

    // Reservasi (jika ada)
    $routes->get('reservasi', 'PemesananController::index');
    $routes->post('pemesanan/simpan', 'PemesananController::simpan');
    $routes->post('pemesanan/batal/(:num)', 'PemesananController::batal/$1');
    $routes->post('pemesanan/selesai/(:num)', 'PemesananController::selesai/$1');
    $routes->post('pemesanan/check-availability', 'PemesananController::checkAvailability');


    // Pembayaran
    $routes->get('pembayaran/bayar/(:num)', 'PembayaranController::bayar/$1');
    $routes->get('pembayaran/finish', 'PembayaranController::finish');

    $routes->get('pembayaran/check-status/(:any)', 'PembayaranController::checkStatus/$1');





});


// -----------------------------------------------------------------------------------


// ADMIN
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'BerandaController::index_admin');
    $routes->get('jadwal', 'JadwalController::index');

    // Admin Edit Profile
    $routes->get('profile', 'AuthController::adminProfile');
    $routes->post('profile/update', 'AuthController::updateAdminProfile');

    // Profile Perusahaan Admin
    $routes->get('profile-perusahaan/index', 'ProfileController::index_admin');
    $routes->get('profile-perusahaan/add', 'ProfileController::add_admin');
    $routes->post('profile-perusahaan/proses-add', 'ProfileController::store');
    $routes->get('profile-perusahaan/edit/(:num)', 'ProfileController::edit_admin/$1');
    $routes->post('profile-perusahaan/proses-edit/(:num)', 'ProfileController::update/$1');
    $routes->get('profile-perusahaan/delete/(:num)', 'ProfileController::delete/$1');

    // Data Pemesanan
    $routes->get('data-pemesanan/index', 'PemesananController::index_admin');
    $routes->get('data-pemesanan/edit/(:segment)', 'PemesananController::edit_admin/$1');
    $routes->post('data-pemesanan/update/(:segment)', 'PemesananController::update_admin/$1');

    // Ketersediaan Jadwal
    $routes->get('ketersediaan-jadwal', 'JadwalController::index_admin');

    // Laporan Keuangan
    $routes->get('laporan-keuangan/index', 'LaporanKeuanganController::index');
    $routes->get('laporan-keuangan/cetak', 'LaporanKeuanganController::cetak');


    // Riwayat Pemesanan
    $routes->get('data-pemesanan/riwayat', 'RiwayatPemesananController::riwayat');
    $routes->get('data-pemesanan/export-excel', 'RiwayatPemesananController::exportExcel');

    // Portofolio Admin
    $routes->get('portofolio/index', 'PortofolioController::index_admin');
    $routes->get('portofolio/add', 'PortofolioController::add_admin');
    $routes->post('portofolio/proses-add', 'PortofolioController::store');
    $routes->get('portofolio/edit/(:num)', 'PortofolioController::edit_admin/$1');
    $routes->post('portofolio/proses-edit/(:num)', 'PortofolioController::update/$1');
    $routes->get('portofolio/delete/(:num)', 'PortofolioController::delete/$1');

    // Paket Layanan Admin
    $routes->get('paket-layanan/index', 'PaketLayananController::index_admin');
    $routes->get('paket-layanan/add', 'PaketLayananController::add_admin');
    $routes->post('paket-layanan/proses-add', 'PaketLayananController::store');
    $routes->get('paket-layanan/edit/(:num)', 'PaketLayananController::edit_admin/$1');
    $routes->post('paket-layanan/proses-edit/(:num)', 'PaketLayananController::update/$1');
    $routes->get('paket-layanan/delete/(:num)', 'PaketLayananController::delete/$1');
});


// -----------------------------------------------------------------------------------


// Ketersediaan Jadwal
$routes->get('pemesanan/getReservations', 'PemesananController::getReservations');

// Cek Deadline Payment Reservasi H-3
$routes->get('pemesanan/check-cancel', 'PemesananController::checkAndCancelExpiredReservations');

// Notifikasi Payment Sukses or Not
$routes->post('pembayaran/notification', 'PembayaranController::notification');
