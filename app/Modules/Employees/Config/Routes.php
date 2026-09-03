<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('employees', [
    'namespace' => 'App\Modules\Employees\Controllers'
], static function ($routes) {

    $routes->get('/', 'Employees::index', ['as' => 'employees.index']);
    
    /** Show */
    $routes->get('(:num)', 'Employees::show/$1', ['as' => 'employees.show']);
    
    /** Create */
    $routes->get('create', 'Employees::create', ['as' => 'employees.create']);
    
    /** Edit */
    $routes->post('create', 'Employees::store', ['as' => 'employees.store']);
    $routes->get('(:num)/edit', 'Employees::edit/$1', ['as' => 'employees.edit']);
    
    /** Update */
    $routes->post('(:num)/update', 'Employees::update/$1', ['as' => 'employees.update']);
    
    /**Delete */
    $routes->post('(:num)/delete', 'Employees::delete/$1', ['as' => 'employees.delete']);

});
  