<?php

declare(strict_types=1);

namespace App\Modules\Settings\Controllers;


class Roles extends BaseSettingsController
{    
    public function index(): string
    {
        return $this->viewModule("Roles/index", [
            "title" => "Roles & Permissions",
        ]);
    }
}