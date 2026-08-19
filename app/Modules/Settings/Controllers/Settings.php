<?php

declare(strict_types=1);

namespace App\Modules\Settings\Controllers;

// use CodeIgniter\HTTP\ResponseInterface;


class Settings extends BaseSettingsController
{    
    public function index(): string
    {
        return $this->viewModule("index", [ 'title' => 'Welcome to Settings'] );
    }
}