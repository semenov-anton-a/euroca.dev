<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('admin_settings', [
    'namespace' => 'App\Modules\AdminSettings\Controllers',
    'filter' => 'auth'
], static function ($routes) {
    
    $routes->get('', 'Settings::index', ['as' => 'admin_settings',]);

    /**
     *  Roles & Permissions
     */
    $routes->get('roles', 'Roles::index', [ 'as' => 'admin_settings.roles',]);
    $routes->post('createRole', 'Roles::createRole', [ 'as' => 'admin_settings.create_role',]);
});
