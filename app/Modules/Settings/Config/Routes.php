<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('', [
    'namespace' => 'App\Modules\Settings\Controllers',
    'filter' => 'auth'
], static function ($routes) {

    $routes->get('/settings', 'Settings::index');
    $routes->get('/settings/roles', 'Roles::index');
    // $routes->get('logout', 'Auth::logout');
});