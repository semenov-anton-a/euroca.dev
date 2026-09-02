<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('employees', [
    'namespace' => 'App\Modules\Employees\Controllers'
], static function ($routes) {

    $routes->get('/', 'Employees::index');

});
  