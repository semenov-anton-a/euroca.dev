<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('accounting', [
    'namespace' => 'App\Modules\Accounting\Ver2\Controllers',
    'filter' => 'auth',
], static function ($routes) {

    $routes->get('v2', 'Accounting::index', [ 'as' => 'accounting_ver2' ]);

});