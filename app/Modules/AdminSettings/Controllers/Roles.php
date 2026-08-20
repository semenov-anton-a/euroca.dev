<?php

declare(strict_types=1);

namespace App\Modules\AdminSettings\Controllers;


class Roles extends BaseAdminSettingsController
{    
    public function index(): string
    {
        $roles = $this->roleService->getAll();

        return $this->viewModule("Roles/index", [
            "title" => "Roles & Permissions",
            "roles" => $roles
        ]);
    }




}