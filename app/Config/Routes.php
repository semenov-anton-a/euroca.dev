<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */


// Module routes
$moduleRoutes = [
    'Tests' => APPPATH . 'Modules/Tests/Config/Routes.php',

    'Auth'      => APPPATH . 'Modules/Auth/Config/Routes.php',
    'Cargo'     => APPPATH . 'Modules/Cargo/Config/Routes.php',
];


// Load module routes
foreach ($moduleRoutes as $module => $file)
{
    if (is_file($file))
    {
        require $file;
    }
}