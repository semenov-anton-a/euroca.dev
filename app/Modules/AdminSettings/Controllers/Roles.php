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

    public function createRole(): ResponseInterface | string 
    {
        sleep(3);

        $name = trim((string) $this->request->getPost("name"));
        $description = trim((string) $this->request->getPost("description"));
        
        $data = [$name, $description];
        
        return $this->response
            ->setHeader('HX-Trigger', json_encode([
                'roleCreated' => [
                    'id' => 654,
                    'name' => "ServerGET_THIS"
                ],
                'toast' => [
                    'msg'=>'Server say HELLO'
                ]
            ]));


        return $this->response
            ->setStatusCode(200)
            ->setHeader('HX-Trigger', 'roleCreated');

            //->setBody( "data :". print_r($data, true) );
        
        return $this->response->setStatusCode(200)->setBody( $this->request->getPost('name') ) ;

        $roleName = trim( (string) $this->request->getPost('name') );
        
        
        return $this->response->setStatusCode(200)->setBody($this->request->getPost($roleName));

        sleep(5);
        if ($roleName === '') 
        {
            return $this->response
                ->setStatusCode(422)
                ->setBody(
                    '<div class="alert alert-danger">
                        Role name is required.
                    </div>'
                );
        }

        return $this->response->setBody(
            '<div class="alert alert-success">
                Role successfully created.
            </div>');

        return $this->response->setStatusCode(200)->setBody( "HELLO" );

    }






}