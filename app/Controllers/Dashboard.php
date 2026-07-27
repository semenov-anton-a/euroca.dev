<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Dashboard controller.
 * Main landing page for authenticated users.
 */
class Dashboard extends BaseController
{
    public function index(): string
    {
        $menu = $this->buildMenu();

        return view('welcome_message', [
            'menu' => $menu,
        ]);
    }
}