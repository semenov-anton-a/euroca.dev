<?php

declare(strict_types=1);

namespace App\Modules\Auth\Config;

use CodeIgniter\Config\BaseService;

/** Auth Repos */
use App\Modules\Auth\Repositories\PermissionRepository;
use App\Modules\Auth\Repositories\RoleRepository;
/** Auth Services */
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Services\PermissionService;
use App\Modules\Auth\Services\RoleService;
/** Users Services */
use App\Modules\Users\Config\Services as UserServices;


/** Employee Service */
use App\Modules\Employees\Config\Services as EmployeeServices;


class Services extends BaseService
{
    public static function authService(bool $getShared = true): AuthService
    {
        if ($getShared) {
            return static::getSharedInstance('authService');
        }


        return new AuthService(
            UserServices::userService(),
            static::roleService(),
            static::permissionService(),
            EmployeeServices::employeeService()
        );
    }

    public static function roleRepository(bool $getShared = true): RoleRepository
    {
        if ($getShared) {
            return static::getSharedInstance('roleRepository');
        }

        return new RoleRepository();
    }

    public static function roleService(bool $getShared = true): RoleService
    {
        if ($getShared) {
            return static::getSharedInstance('roleService');
        }

        return new RoleService(static::roleRepository());
    }

    public static function permissionRepository(bool $getShared = true): PermissionRepository
    {
        if ($getShared) {
            return static::getSharedInstance('permissionRepository');
        }

        return new PermissionRepository();
    }

    public static function permissionService(bool $getShared = true): PermissionService
    {
        if ($getShared) {
            return static::getSharedInstance('permissionService');
        }

        return new PermissionService(
            static::permissionRepository(),
            static::roleService()
        );
    }
}