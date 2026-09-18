<?php

declare(strict_types=1);

namespace App\Modules\Employees\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
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

        if ($this->request->getHeaderLine('HX-Request') === 'true') {
            $view = view($viewTemplatePath, ['employees' => $employees]);
            return $this->response->setStatusCode(200)->setBody($view);
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

        /** 404 Error */
        if (!$employee) {
            return $this->response->setStatusCode(404);
        }

        $documents = $this->employeeDocumentService->findByEmployeeId($id);
        $view = view('App\Modules\Employees\Views\employee-details', [
            'employee' => $employee,
            'documents' => $documents ?? null
        ]);

        return $this->response
            ->setStatusCode(200)
            ->setBody($view);        
    }

    /**
     * Create new employee
     * @return string
     */
    public function create()
    {
        return $this->viewModule('newemployee',  [
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

            if ($result['success'] === true) {
                return $this->setHtmxRedirect(route_to('employees.index'))->response;
            } else {
                return $this->response
                    ->setStatusCode(200)
                    ->setBody($this->htmlFormViewError($result));
            }
        } catch (\Throwable $e) {

            log_message('error', $e->getMessage());
            return $this->htmxToastMessage("danger", "Error create employee.")->response->setStatusCode(422);
        }
    }


    public function edit(int $id)
    {
        $employee = $this->employeeService->findById($id);

        if ($employee === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $user = $this->userService->findByEmployeeId($id);
        $documents = $this->employeeDocumentService->findByEmployeeId($id);

        return view('App\Modules\Employees\Views\employee-edit', [
            'employee' => $employee,
            'user' => $user,
            'documents' => $documents,
            'roles' => $this->roleService->getManageableRoles(),
        ]);
    }


    public function update(int $id)
    {
        $employeeUserService = new EmployeeUserService(
            $this->employeeService,
            $this->employeeDocumentService,
            $this->userService,
        );

        $files = $this->request->getFileMultiple('documents') ?? [];

        $files = array_values(array_filter(
            $files,
            static fn ($file) => $file->isValid()
        ));

        try {
            $result = $employeeUserService->update(
                $id,
                $this->request->getPost(),
                $files
            );

            if (!$result['success']) 
            {
                return $this->response
                    ->setStatusCode(200)
                    ->setBody( $this->htmlFormViewError($result) );
            }

            $this->flashToast('success', lang('Employee.employee_updated_successfully') );
            return $this->setHtmxRedirect(route_to('employees.index'))->response;
            
        } catch (\Throwable $e) {

            log_message(
                'error',
                'Employee update failed. Employee ID: {id}. Error: {message}',
                [
                    'id' => $id,
                    'message' => $e->getMessage(),
                ]
            );

            $this->flashToast('danger', lang('Employee.danger_update') );
            return $this->setHtmxRedirect(route_to('employees.index'))->response;
        }
    }

    public function document(string $fileName): ResponseInterface
    {
        $document = $this->employeeDocumentService->findByFileName($fileName);

        if ($document === null) 
        {
            throw PageNotFoundException::forPageNotFound();    
        }

        $path = WRITEPATH . 'uploads/' . $document->file_path;

        if (!is_file($path)) 
        {
            return $this->response->setStatusCode(404);
        }

        return $this->responseShowDocument($path, $document->mime_type, $document->title);

    }
}
