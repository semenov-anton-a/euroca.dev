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

            $storeResult = $this->employeeService->create( $data );

            // return $this->htmxToastMessage("success", "Employee.employee_created_successfully" )
            //         ->response->setStatusCode(200);

            return $this->htmxToastMessage("success", lang("Employee.employee_created_successfully") )
                ->response->setBody(
                    '<pre>' . esc(print_r($data, true)) . '</pre>'
                    // . '<pre>' . esc(print_r($storeResult, true)) . '</pre>'
            );

        } catch (\Throwable $e) {

            log_message('error', $e->getMessage());

            return $this->htmxToastMessage("danger", lang( $e->getMessage() ) )->response->setStatusCode(422);
        }
    }
    
    

}