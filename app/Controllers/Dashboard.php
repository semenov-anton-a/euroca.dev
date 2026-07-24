<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Dashboard controller.
 * Main landing page for authenticated users.
 */
class Dashboard extends Controller
{
    public function index(): string
    {
        $menuService = new \App\Services\MenuService();
        $menu = $menuService->getMenu(session('permissions', []));

        return view('welcome_message', [
            'menu' => $menu,
        ]);
    }
}