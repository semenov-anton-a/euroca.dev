<?php

use CodeIgniter\Router\RouteCollection;
use App\Helpers\ClassHelper;

/** @var RouteCollection $routes */

$routes->group('', [
    'namespace' => 'App\Modules\Dashboard\Controllers',
    'filter' => 'auth'
], static function ($routes) {
    
    $methodsArr = ClassHelper::_getControllerMethods(\App\Modules\Dashboard\Controllers\Dashboard::class);

    $routes->get('/dashboard', 'Dashboard::index');

    foreach ($methodsArr as $method) 
    {
        if( str_starts_with($method, 'post_') )
        {
            $routes->post("/dashboard/{$method}", "Dashboard::{$method}");    
        }else{
            $routes->get("/dashboard/{$method}", "Dashboard::{$method}");   
        }    
    }

    // $routes->get('/test/getreq', 'Tests::getreq');
    // $routes->post('/test/postreq', 'Tests::postreq');    
});