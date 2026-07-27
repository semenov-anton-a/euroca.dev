<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Base routes
$routes->get('/', 'Home::index');
//$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);


// Module routes
$moduleRoutes = [
    'Auth'      => APPPATH . 'Modules/Auth/Config/Routes.php',
    'Cargo'     => APPPATH . 'Modules/Cargo/Config/Routes.php',
];

foreach ($moduleRoutes as $module => $file)
{
    if (is_file($file))
    {
        require $file;
    }
}