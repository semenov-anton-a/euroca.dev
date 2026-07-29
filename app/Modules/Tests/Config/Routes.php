<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('', [
    'namespace' => 'App\Modules\Tests\Controllers'
], static function ($routes) {
    $routes->get('/test', 'Tests::index');
    $routes->get('/test/getreq', 'Tests::getreq');
    
    $routes->post('/test/postreq', 'Tests::postreq');    
});