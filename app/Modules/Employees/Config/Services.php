<?php

declare(strict_types=1);

namespace App\Modules\Employees\Config;

use CodeIgniter\Config\BaseService;
use App\Modules\Employees\Models\EmployeeModel;
use App\Modules\Employees\Models\EmployeeDocumentModel;
use App\Modules\Employees\Repositories\EmployeeRepository;
use App\Modules\Employees\Repositories\EmployeeDocumentRepository;
use App\Modules\Employees\Services\EmployeeService;
use App\Modules\Employees\Services\EmployeeDocumentService;
use App\Modules\Users\Config\Services as UserServices;

class Services extends BaseService
{
    public static function employeeService(bool $getShared = true): EmployeeService
    {
        if ($getShared) {
            return static::getSharedInstance('employeeService');
        }

        return new EmployeeService(
            new EmployeeRepository(new EmployeeModel()),
            UserServices::userService()
        );
    }

    public static function employeeDocumentService(bool $getShared = true): EmployeeDocumentService
    {
        if ($getShared) {
            return static::getSharedInstance('employeeDocumentService');
        }

        return new EmployeeDocumentService(
            new EmployeeDocumentRepository(new EmployeeDocumentModel())
        );
    }
}