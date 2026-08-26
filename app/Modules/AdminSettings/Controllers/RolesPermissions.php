<?php

declare(strict_types=1);

namespace App\Modules\AdminSettings\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Modules\AdminSettings\Enums\RulesRegex;

class RolesPermissions extends BaseAdminSettingsController
{
    /**
     * Display Roles & Permissions page.
     */
    public function index(): string
    {
        return $this->viewModule('RolesPermissions/index2', [
            'title' => 'Roles & Permissions',
            'roles' => $this->roleService->getManageableRoles(),
            'formRules' => [
                'roleName' => trim((string) RulesRegex::RoleName->value, '/$^'),
                'description' => trim((string) RulesRegex::DescriptionName->value, '/$^'),
            ],
        ]);
    }

    /**
     * Display role details.
     *
     * @param int $id Role ID.
     */
    public function getRoleDetails(int $id): ResponseInterface|string
    {

        // $rolePermissions = $this->permissionService->getRolePermissions($id);
       
        // try{
        //     $this->roleService->create( $id );
        // }


        return $this->response->setBody(
            $this->viewModule('RolesPermissions/roledetalies', [
                'rolePermissions' => $this->permissionService->getRolePermissions($id),
                'permissions' => $this->permissionService->getAll(),
                'role' => $this->roleService->getRoleById( $id ),
                'formRules' => [
                    'roleName' => trim( (string) RulesRegex::RoleName->value, '/$^'),
                    'description' => trim( (string) RulesRegex::DescriptionName->value, '/$^'),
                ],
            ])
        );
    }

    /**
     * Create a new role.
     */
    public function createRole(): ResponseInterface|string
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


        $roleData = [ 'name' => $name, 'description' => $description, ];

        if (! $this->validateData($roleData, $rules)) 
        {   
            return $this->addHtmxTrigger( "errorMessage", [ 'message' => $this->validator->getErrors() ])->response;
        }

        try{
            $this->roleService->create( $roleData );
        }catch( \Throwable $err ){
            log_message( 'error', 'Failed to create role: ' . $e->getMessage() );
            return $this->addHtmxTrigger( "errorMessage", [ 'message' => "Failed to create role." ])->response;
        }
        

        return $this->addHtmxTrigger( "roleCreated", [ 'id' => 654, 'name' => $name ]  )->response;
        
    }

    /**
     * Update an existing role.
     *
     * @param int $id Role ID.
     */
    public function updateRole(int $id): ResponseInterface|string
    {
        return $this->htmxToastMessage('success', "FAKE - role {$id} updated")->response;
    }

    /**
     * Update permissions.
     *
     * If no ID is provided, updates the global permissions data.
     * If an ID is provided, updates permissions for the specified role.
     *
     * @param int|null $id Role ID.
     */
    public function updatePermissions(?int $id = null): ResponseInterface|string
    {
        return $this->htmxToastMessage('success', 'FAKE - Permissions updated')->response;
    }
}