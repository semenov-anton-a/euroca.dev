<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('', [
    'namespace' => 'App\Modules\Auth\Controllers'
], static function ($routes) {

    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::authenticate');

    // $routes->get('register', 'Auth::register');
    // $routes->post('register', 'Auth::create');

    $routes->get('logout', 'Auth::logout');
});