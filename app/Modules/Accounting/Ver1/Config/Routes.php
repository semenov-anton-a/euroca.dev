<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('accounting', [
    'namespace' => 'App\Modules\Accounting\Ver1\Controllers',
    'filter' => 'auth',
], static function ($routes) {

    $routes->get('v1', 'Accounting::index', [ 'as' => 'accounting_ver1' ]);

});