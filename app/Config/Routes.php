<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/beranda', 'BerandaController::index');
$routes->get('/about-us', 'ProfileController::index');
$routes->get('/portofolio', 'PortofolioController::index');
$routes->get('/detail-portofolio', 'PortofolioController::detail_portofolio');
