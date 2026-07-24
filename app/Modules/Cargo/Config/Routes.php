<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Cargo module routes - protected by auth filter
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('cargo', 'Cargo::index');
    $routes->get('cargo/create', 'Cargo::create');
    $routes->post('cargo', 'Cargo::store');
    $routes->get('cargo/(:num)', 'Cargo::show/$1');
    $routes->get('cargo/(:num)/edit', 'Cargo::edit/$1');
    $routes->post('cargo/(:num)', 'Cargo::update/$1');
    $routes->delete('cargo/(:num)', 'Cargo::delete/$1');
});

// API routes for HTMX
$routes->get('api/cargo', 'Cargo::apiIndex');