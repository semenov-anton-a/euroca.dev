<?php

declare(strict_types=1);

namespace App\Modules\AdminSettings\Controllers;
use CodeIgniter\HTTP\ResponseInterface;

use App\Modules\AdminSettings\Enums\RulesRegex;

class Roles extends BaseAdminSettingsController
{   
    
    public function index(): string
    {
        return $this->viewModule("Roles/index2", [
            "title" => "Roles & Permissions",
            "roles" => $this->roleService->getAll(),
            "formRules" => [
                "roleName" => trim(RulesRegex::RoleName->value, "/$^"),
                "description" => trim(RulesRegex::DescriptionName->value, "/$^"),
            ]            
        ]);
    }

    public function getRoleDetalies( int $id ): ResponseInterface | string
    {
        return $this->response->setBody( $this->viewModule('Roles/roledetalies') );
    }

    public function createRole(): ResponseInterface | string 
    {
        $name = trim((string) $this->request->getPost("name"));
        $description = trim((string) $this->request->getPost("description"));
        
        $data = [$name, $description];
        
        return $this->response
            ->setHeader('HX-Trigger', json_encode([
                'roleCreated' => [
                    'id' => 654,
                    'name' => "ServerGET_THIS",
                ],                
            ]));
    }






}