<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home routes
$routes->get('/', 'Home::index');
$routes->get('/features', 'Home::features');
$routes->get('/admin-info', 'Home::admin_info');
$routes->get('/community', 'Home::community');

// Auth routes
$routes->match(['get', 'post'], '/auth/login', 'Auth::login');
$routes->match(['get', 'post'], '/auth/register', 'Auth::register');
$routes->get('/auth/logout', 'Auth::logout');

// Dashboard routes (protected)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
});

// Shop routes (protected)
$routes->group('shop', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Shop::index');
    $routes->match(['get', 'post'], '/purchase/(:num)', 'Shop::purchase/$1');
});

// Admin routes (protected)
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->match(['get', 'post'], '/payments', 'Admin::payments');
    $routes->match(['get', 'post'], '/shop-items', 'Admin::shop_items');
    $routes->match(['get', 'post'], '/features', 'Admin::features');
    $routes->match(['get', 'post'], '/staff', 'Admin::staff');
    $routes->match(['get', 'post'], '/settings', 'Admin::settings');
});