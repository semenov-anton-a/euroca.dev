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
    $routes->get('role/(:num)', 'RolesPermissions::getRoleDetalies/$1', [ 'as' => 'admin_settings.role_detalies' ]);

    /**
     * Role management
     */
    $routes->post('createRole', 'RolesPermissions::createRole', [ 'as' => 'admin_settings.create_role' ]);
    $routes->post('role/(:num)/update', 'RolesPermissions::updateRole/$1', [ 'as' => 'admin_settings.update_role' ]);

    /**
     * Permissions management
     */
    $routes->post('permissions/update', 'RolesPermissions::updatePermissions', [ 'as' => 'admin_settings.permissions_update' ]);
    
});