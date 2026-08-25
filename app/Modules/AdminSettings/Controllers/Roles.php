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
            "roles" => $this->roleService->getManageableRoles(),
            "formRules" => [
                "roleName" => trim(RulesRegex::RoleName->value, "/$^"),
                "description" => trim(RulesRegex::DescriptionName->value, "/$^"),
            ]            
        ]);
    }

    public function getRoleDetalies( int $id ): ResponseInterface | string
    {        
        return $this->response->setBody( $this->viewModule('Roles/roledetalies', 
            [   
                "role" => [
                    'id' => 1,
                    'name' => "Test",
                    'description' => 'description description description description'
                ],
                "formRules" => [
                    "roleName" => trim(RulesRegex::RoleName->value, "/$^"),
                    "description" => trim(RulesRegex::DescriptionName->value, "/$^"),
                ]
            ]));
    }


    public function createRole(): ResponseInterface | string 
    {
        $name = trim((string) $this->request->getPost('name'));
        $description = trim((string) $this->request->getPost('description'));

        $rules = [
            'name' => [
                'rules' => 'required|regex_match[' . RulesRegex::RoleName->value . ']',
                'errors' => [
                    'required' => 'Role name is required.',
                    'regex_match' => 'Role name must contain only lowercase letters, numbers and underscores.',
                ],
            ],

            'description' => [
                'rules' => 'required|regex_match[' . RulesRegex::DescriptionName->value . ']',
                'errors' => [
                    'required' => 'Description is required.',
                    'regex_match' => 'Description must be between 10 and 255 characters.',
                ],
            ],
        ]; 
        
        $validData = [
            'name' => $name, 
            'description' => $description ];

        if (! $this->validateData($validData, $rules) ) 
        {
            return $this->response->setHeader( 'HX-Trigger', 
                json_encode([
                    'errorMessage' => [
                        'message' => $this->validator->getErrors() 
                    ] ] )
                );            
        }

        // $roleId = $this->roleService->create($data);

        return $this->response->setHeader('HX-Trigger', 
                json_encode([
                    'roleCreated' => [ 'id' => 654, 'name' => $name ] ])
            );



        return "";
    }

    // public function createRole(): ResponseInterface | string 
    // {
    //     $name = trim((string) $this->request->getPost("name"));
    //     $description = trim((string) $this->request->getPost("description"));
        
    //     $data = [$name, $description];
        
    //     return $this->response
    //         ->setHeader('HX-Trigger', json_encode([
    //             'roleCreated' => [
    //                 'id' => 654,
    //                 'name' => "ServerGET_THIS",
    //             ],                
    //         ]));
    // }






}