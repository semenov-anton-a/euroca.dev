<?php

declare(strict_types=1);

namespace App\Modules\Employees\Controllers;

use CodeIgniter\HTTP\ResponseInterface;


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
            // 'pager' => $this->employeeService->pager(),
        ]);        
        
    }



    public function store(): ResponseInterface | string
    {

        $storeResult = $this->employeeService->create( $this->request->getPost() );

        return $this->response->setBody(
        '<pre>' . esc(print_r( $storeResult, true)) . '</pre>'
    );

        return $this->htmxToastMessage( 'success',  'Employee created successfully.')->response;

        echo "Create Employee";
        die;

    
        return $this->viewModule('create');        
    }
    

}