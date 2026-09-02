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
        return $this->viewModule('index');        
    }



    public function create(): ResponseInterface | string
    {
        return $this->viewModule('create');        
    }
    

}