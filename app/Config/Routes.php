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

$routes->get('/dashboard', 'BerandaController::index_admin');
