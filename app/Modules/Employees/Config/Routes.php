<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('employees', [
    'namespace' => 'App\Modules\Employees\Controllers'
], static function ($routes) {

    $routes->get('/', 'Employees::index', ['as' => 'employees.index']);
   
    /** Show Employee */
    $routes->get('(:num)', 'Employees::employee/$1', ['as' => 'employees.show']);

    $routes->get('create', 'Employees::create', ['as' => 'employees.new_employee']);
    
    /** Store */
    $routes->post('store', 'Employees::store', ['as' => 'employees.store']);
    
    /** Edit */    
    $routes->get('(:num)/edit', 'Employees::edit/$1', ['as' => 'employees.edit']);
    
    /** Update */
    $routes->post('(:num)/update', 'Employees::update/$1', ['as' => 'employees.update']);
    
    /**Delete */
    $routes->post('(:num)/delete', 'Employees::delete/$1', ['as' => 'employees.delete']);


    /** Get documents */
    // $routes->get('documents/(:num)', 'Employees::document/$1', ['as' => 'employees.document']);
    $routes->get('documents/(:segment)', 'Employees::document/$1', [ 'as' => 'employees.document' ]);

});
  