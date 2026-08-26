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
                'roleName' => trim(RulesRegex::RoleName->value, '/$^'),
                'description' => trim(RulesRegex::DescriptionName->value, '/$^'),
            ],
        ]);
    }

    /**
     * Display role details.
     *
     * @param int $id Role ID.
     */
    public function getRoleDetalies(int $id): ResponseInterface|string
    {
        return $this->response->setBody(
            $this->viewModule('RolesPermissions/roledetalies', [
                'role' => [
                    'id' => $id,
                    'name' => 'accounterbes',
                    'description' => 'description description description description',
                ],
                'formRules' => [
                    'roleName' => trim(RulesRegex::RoleName->value, '/$^'),
                    'description' => trim(RulesRegex::DescriptionName->value, '/$^'),
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

        if (! $this->validateData([
            'name' => $name,
            'description' => $description,
        ], $rules)) {
            return $this->response->setHeader(
                'HX-Trigger',
                json_encode([
                    'errorMessage' => [
                        'message' => $this->validator->getErrors(),
                    ],
                ])
            );
        }

        return $this->response->setHeader(
            'HX-Trigger',
            json_encode([
                'roleCreated' => [
                    'id' => 654,
                    'name' => $name,
                ],
            ])
        );
    }

    /**
     * Update an existing role.
     *
     * @param int $id Role ID.
     */
    public function updateRole(int $id): ResponseInterface|string
    {
        $this->htmxToastMessage('success', "FAKE - role {$id} updated");
        return $this->response;
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
        $this->htmxToastMessage('success', 'FAKE - Permissions updated');
        return $this->response;
    }
}