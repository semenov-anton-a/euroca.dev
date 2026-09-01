<?php

declare(strict_types=1);

namespace App\Modules\Auth\Config;

use CodeIgniter\Config\BaseService;

use App\Modules\Auth\Repositories\PermissionRepository;
use App\Modules\Auth\Repositories\RoleRepository;
use App\Modules\Auth\Services\PermissionService;
use App\Modules\Auth\Services\RoleService;

class Services extends BaseService
{
    public static function roleService(bool $getShared = true): RoleService
    {
        if ($getShared) {
            return static::getSharedInstance('roleService');
        }

        return new RoleService( new RoleRepository() );
    }

    public static function permissionService(bool $getShared = true): PermissionService
    {
        if ($getShared) {
            return static::getSharedInstance('permissionService');
        }

        return new PermissionService( new PermissionRepository(), static::roleService() );
    }
}