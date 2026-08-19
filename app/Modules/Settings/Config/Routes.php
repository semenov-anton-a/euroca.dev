<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('', [
    'namespace' => 'App\Modules\Settings\Controllers',
    'filter' => 'auth'
], static function ($routes) {

    $routes->get('/settings', 'Settings::index', ['as'=> 'settings',]);
    $routes->get('/settings/roles', 'Roles::index', ['as'=> 'settings.roles',]);
    // $routes->get('logout', 'Auth::logout');
});