<?php

declare(strict_types=1);

namespace App\Modules\Employees\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Modules\Employees\Enums\RulesRegex as RulesRegex;
/**
 * Employees controller.
 * Handles employee-related actions.
 */
class Employees extends BaseEmployeesController
{    
    public function index(): ResponseInterface | string
    {
        $roles = $this->roleService->getManageableRoles();  

        $employees = $this->employeeService->getPaginated( 20 );

        return $this->viewModule('index', [
            'roles' => $roles,
            'employees' => $employees,
            'rules' => [
                'username' => trim((string) RulesRegex::Username->value, '/$^'),
                'name' => trim((string) RulesRegex::Name->value, '/$^'),
                'phone' => trim((string) RulesRegex::Phone->value, '/$^'),
                'password' => trim((string) RulesRegex::Password->value, '/$^'),
            ],
            // 'pager' => $this->employeeService->pager(),
        ]);        
        
    }



    public function store(): ResponseInterface|string
    {
        try {
            $data = $this->request->getPost();

            $storeResult = $this->employeeService->create($data);

            return $this->response->setBody(
                '<pre>' . esc(print_r($data, true)) . '</pre>'
            );

        } catch (\Throwable $e) {
            $error = '<pre>' . esc(
                $e::class . "\n" .
                $e->getMessage() . "\n\n" .
                $e->getFile() . ':' . $e->getLine() . "\n\n" .
                $e->getTraceAsString()
            ) . '</pre>';

            log_message('error', $error);
            
            return $this->response
                ->setStatusCode(500)
                ->setBody( $error );
        }
    }
    
    

}