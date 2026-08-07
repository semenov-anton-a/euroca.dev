<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseService;

use App\Services\Auth\UserService;
use App\Services\Auth\RoleService;
use App\Services\Auth\PermissionService;

use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

use App\Modules\Auth\Models\UserModel;

class Services extends BaseService
{
    /**
     * User Service.
     */
    public static function userService( bool $getShared = true ): UserService 
    {
        if ($getShared) 
        {
            return static::getSharedInstance('userService');
        }

        return new UserService( 
                    new UserRepository( new UserModel() ), 
                    new PermissionRepository(), 
                    new RoleRepository()
                );
    }


    /**
     * Role Service.
     */
    public static function roleService( bool $getShared = true ): RoleService 
    {
        if ($getShared) {
            return static::getSharedInstance('roleService');
        }

        return new RoleService( new RoleRepository() );
    }


    /**
     * Permission Service.
     */
    public static function permissionService( bool $getShared = true ): PermissionService 
    {
        if ($getShared) {
            return static::getSharedInstance('permissionService');
        }

        return new PermissionService( new PermissionRepository(), static::roleService() );
    }
}
