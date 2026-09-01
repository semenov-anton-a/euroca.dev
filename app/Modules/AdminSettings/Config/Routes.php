<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// $routes->group('admin_settings', [
//     'namespace' => 'App\Modules\AdminSettings\Controllers',
//     'filter' => 'auth'
// ], static function ($routes) {
    
//     $routes->get('', 'Settings::index', ['as' => 'admin_settings',]);

//     /**
//      *  Roles & Permissions
//      */
//     $routes->get('roles', 'Roles::index', [ 'as' => 'admin_settings.roles',]);
//     $routes->get('role/(:num)', 'Roles::getRoleDetalies/$1', [ 'as' => 'admin_settings.role_detalies',]);
//     $routes->post('createRole', 'Roles::createRole', [ 'as' => 'admin_settings.create_role',]);
    
//     /**
//      * Permissions
//      */
//     $routes->post('permissions/update', 'Permissions::update', [ 'as' => 'admin_settings.permissions_update' ]);
//     $routes->post('permissions/update/(:num)', 'Permissions::update/$1', [ 'as' => 'admin_settings.permissions_update_role']);

// });

$routes->group('admin_settings', [
    'namespace' => 'App\Modules\AdminSettings\Controllers',
    'filter' => 'auth',
], static function ($routes) {

    $routes->get('', 'General::index', [ 'as' => 'admin_settings' ]);

    /**
     * Roles & Permissions
     */
    $routes->get('roles', 'RolesPermissions::index', [ 'as' => 'admin_settings.roles', ]);

    /**
     * Role details
     */
    $routes->get('role/(:num)', 'RolesPermissions::getRoleDetails/$1', [ 'as' => 'admin_settings.role_detalies' ]);

    /**
     * Role management
     */
    $routes->post('createRole', 'RolesPermissions::createRole', [ 'as' => 'admin_settings.create_role' ]);
    $routes->post('role/(:num)/update', 'RolesPermissions::updateRole/$1', [ 'as' => 'admin_settings.update_role' ]);

    /**
     * Permissions management
     */
    $routes->post('permissions/scan', 'RolesPermissions::scanPermissions', [ 'as' => 'admin_settings.permissions_scan' ]);
    

    /**
     * Logs
     */
    $routes->get('logs', 'Logs::index', ['as' => 'admin_settings.logs']);
    $routes->get('logs/read/(:any)', 'Logs::read/$1', ['as' => 'admin_settings.logs.read']);
    $routes->post('logs/remove-all', 'Logs::removeAll', [ 'as' => 'admin_settings.logs.remove_all' ]);

    // $routes->get('logs/list', 'Logs::list', [ 'as' => 'admin_settings.logs.list', ]);

});