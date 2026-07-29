<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('', [
    'namespace' => 'App\Modules\Auth\Controllers'
], static function ($routes) {

    $routes->get('/register', 'Auth::register');
    $routes->get('/', 'Auth::login');
    $routes->post('login', 'Auth::authenticate');
    $routes->get('logout', 'Auth::logout');
});