<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */


// Module routes
$moduleRoutes = [
    'Auth'      => APPPATH . 'Modules/Auth/Config/Routes.php',
    'Tests' => APPPATH . 'Modules/Tests/Config/Routes.php',

    // Modules
    'AdminSettings'    => APPPATH . 'Modules/AdminSettings/Config/Routes.php',
    'Dashboard'        => APPPATH . 'Modules/Dashboard/Config/Routes.php',
    'AccountingVer1'    => APPPATH . 'Modules/Accounting/Ver1/Config/Routes.php',
    // 'AccountingVer2'    => APPPATH . 'Modules/Accounting/Ver2/Config/Routes.php',
    // 'Cargo'      => APPPATH . 'Modules/Cargo/Config/Routes.php',
    

];


// Load module routes
foreach ($moduleRoutes as $module => $file)
{
    if (is_file($file))
    {
        require $file;
    }
}