<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('', [
    'namespace' => 'App\Modules\AdminSettings\Controllers',
    'filter' => 'auth'
], static function ($routes) {

    $routes->get('/admin_settings', 'Settings::index', ['as'=> 'admin_settings',]);
    $routes->get('/admin_settings/roles', 'Roles::index', ['as'=> 'admin_settings.roles',]);
    // $routes->get('logout', 'Auth::logout');
});