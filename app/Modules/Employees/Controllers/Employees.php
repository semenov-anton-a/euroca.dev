<?php

declare(strict_types=1);

namespace App\Modules\Employees\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Modules\Employees\Enums\RulesRegex;


use App\Services\Modules\EmployeeUserService;

/**
 * Employees controller.
 * Handles employee-related actions.
 */
class Employees extends BaseEmployeesController
{   
    /**
     * Show all employee table
     * @return ResponseInterface|string
     */
    public function index(): ResponseInterface|string
    {
        $roles = $this->roleService->getManageableRoles();
        $employees = $this->employeeService->getPaginatedWithUsers(5);

        $viewTemplatePath = 'App\Modules\Employees\Views\employees-table';

        if ($this->request->getHeaderLine('HX-Request') === 'true') 
        {            
            $view = view($viewTemplatePath, [ 'employees' => $employees ]);
            return $this->response->setStatusCode(200)->setBody( $view );   
        }

        return $this->viewModule('index', [
            'roles' => $roles,
            'employees' => $employees,
            'viewTemplatePath' => $viewTemplatePath,
            'rules' => [
                'username' => trim((string) RulesRegex::Username->value, '/$^'),
                'name' => trim((string) RulesRegex::Name->value, '/$^'),
                'phone' => trim((string) RulesRegex::Phone->value, '/$^'),
                'password' => trim((string) RulesRegex::Password->value, '/$^'),
            ],
        ]);
    }

    /**
     * Get Employeaa data only data
     * @param int $id
     * @return ResponseInterface
     */
    public function employee(int $id): ResponseInterface|string
    {
        $employee = $this->employeeService->findById($id);

        if (!$employee) { return $this->response->setStatusCode(404); }

        $view = view('App\Modules\Employees\Views\employee-details', [
                'employee' => $employee,
                // 'files' => $files ?? null
            ]);        
        
        return $this->response
            ->setStatusCode(200)
            ->setBody( $view );
            // ->setBody('<pre>' . print_r($employee, true) . '</pre>');
    }

    /**
     * Create new employee
     * @return string
     */
    public function create()
    {
        return $this->viewModule( 'newemployee',  [
            'roles' => $this->roleService->getManageableRoles(),
            'rules' => [
                'username' => trim((string) RulesRegex::Username->value, '/$^'),
                'name' => trim((string) RulesRegex::Name->value, '/$^'),
                'phone' => trim((string) RulesRegex::Phone->value, '/$^'),
                'password' => trim((string) RulesRegex::Password->value, '/$^'),
                ],
            ]);
    }


    /**
     * Save new employee
     * @return ResponseInterface
     */
    public function store(): ResponseInterface|string
    {
        try {
            
            $employeeUserService = new EmployeeUserService( 
                $this->employeeService,
                $this->employeeDocumentService,
                $this->userService
            );

            $employee = $this->request->getPost();
            $files = $this->request->getFileMultiple('documents') ?? [];
            
            $result = $employeeUserService->create($employee, $files);            
                        
            if( $result['success'] === true )
            {
                return $this->setHtmxRedirect( route_to('employees.index') )->response;    
            }else{
                return $this->response
                        ->setStatusCode(200)
                        ->setBody( $this->htmlFormViewError($result) );
            }           

        } catch (\Throwable $e) {

            log_message('error', $e->getMessage());
            return $this->htmxToastMessage("danger", "Error create employee." )->response->setStatusCode(422);
        }
    }
    
    

}