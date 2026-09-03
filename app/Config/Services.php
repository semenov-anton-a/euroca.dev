<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function authService(bool $getShared = true): \App\Modules\Auth\Services\AuthService
    {
        return \App\Modules\Auth\Config\Services::authService($getShared);
    }

    public static function employeeDocumentService(bool $getShared = true): \App\Modules\Employees\Services\EmployeeDocumentService
    {
        return \App\Modules\Employees\Config\Services::employeeDocumentService($getShared);
    }

    public static function employeeService(bool $getShared = true): \App\Modules\Employees\Services\EmployeeService
    {
        return \App\Modules\Employees\Config\Services::employeeService($getShared);
    }

    public static function permissionRepository(bool $getShared = true): \App\Modules\Auth\Repositories\PermissionRepository
    {
        return \App\Modules\Auth\Config\Services::permissionRepository($getShared);
    }

    public static function permissionService(bool $getShared = true): \App\Modules\Auth\Services\PermissionService
    {
        return \App\Modules\Auth\Config\Services::permissionService($getShared);
    }

    public static function roleRepository(bool $getShared = true): \App\Modules\Auth\Repositories\RoleRepository
    {
        return \App\Modules\Auth\Config\Services::roleRepository($getShared);
    }

    public static function roleService(bool $getShared = true): \App\Modules\Auth\Services\RoleService
    {
        return \App\Modules\Auth\Config\Services::roleService($getShared);
    }

    public static function userRepository(bool $getShared = true): \App\Modules\Users\Repositories\UserRepository
    {
        return \App\Modules\Users\Config\Services::userRepository($getShared);
    }

    public static function userService(bool $getShared = true): \App\Modules\Users\Services\UserService
    {
        return \App\Modules\Users\Config\Services::userService($getShared);
    }
}
