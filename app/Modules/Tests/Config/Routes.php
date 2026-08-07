<?php

use CodeIgniter\Router\RouteCollection;
use App\Helpers\ClassHelper;

/** @var RouteCollection $routes */


// function getClassMethods($class) : array
// {
//     $reflection = new \ReflectionClass( $class );

//     // $methods = array_filter(
//     //     $reflection->getMethods(),
//     //     fn($method) => $method->getDeclaringClass()->getName() === $reflection->getName()
//     // );

//     $publicMethods = array_filter(
//         $reflection->getMethods( \ReflectionMethod::IS_PUBLIC),
//         fn($method) => $method->getDeclaringClass()->getName() === $class
//     );
    
//     return array_map(fn($method) => $method->name, $publicMethods);
// }


$routes->group('', [
    'namespace' => 'App\Modules\Tests\Controllers',
    'filter' => 'auth'
], static function ($routes) {
    // $methodsArr = $this->_getClassMethods(\App\Modules\Tests\Controllers\Tests::class);
    
    $methodsArr = ClassHelper::_getControllerMethods(\App\Modules\Tests\Controllers\Tests::class);

    $routes->get('/test', 'Tests::index');

    foreach ($methodsArr as $method) 
    {
        if( str_starts_with($method, 'post_') )
        {
            $routes->post("/tests/{$method}", "Tests::{$method}");    
        }else{
            $routes->get("/tests/{$method}", "Tests::{$method}");   
        }    
    }

    // $routes->get('/test/getreq', 'Tests::getreq');
    // $routes->post('/test/postreq', 'Tests::postreq');    
});