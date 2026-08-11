<?php

declare(strict_types=1);

namespace App\Modules\Dashboard\Controllers;


class Dashboard extends BaseDashboardController
{
    public function index()
    {
        return $this->viewModule('index', [ 
            'contentID' =>'dashboard', 
            'title' => 'Dashboard',
        ] );
    }

    public function test()
    {
        return "hello dachbourd test";
    }
}