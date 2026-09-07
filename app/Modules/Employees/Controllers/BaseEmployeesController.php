<?php

declare(strict_types=1);

namespace App\Modules\Employees\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Modules\Employees\Config\Services as EmployeeServices;
use App\Modules\Employees\Services\EmployeeService;


abstract class BaseEmployeesController extends BaseController
{
    protected EmployeeService $employeeService;


    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);

        
        $this->employeeService = EmployeeServices::employeeService();
    }
}