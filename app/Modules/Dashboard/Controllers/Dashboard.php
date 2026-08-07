<?php

declare(strict_types=1);

namespace App\Modules\Dashboard\Controllers;


class Dashboard extends BaseDashboardController
{
    public function index()
    {
        return "Hello from Dashboard module!";
    }

    public function test()
    {
        return "hello dachbourd test";
    }
}