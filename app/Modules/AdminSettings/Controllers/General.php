<?php

declare(strict_types=1);

namespace App\Modules\AdminSettings\Controllers;

// use CodeIgniter\HTTP\ResponseInterface;


class General extends BaseAdminSettingsController
{    
    public function index(): string
    {
        return $this->viewModule("index", [ 'title' => 'Welcome to Settings'] );
    }
}