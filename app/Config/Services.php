<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseService;

/** Users Module */
use App\Modules\Users\Models\UserModel;
use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Services\UserService;

/** Auth Module */
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Repositories\PermissionRepository;
use App\Modules\Auth\Repositories\RoleRepository;
use App\Modules\Auth\Services\PermissionService;
use App\Modules\Auth\Services\RoleService;

class Services extends BaseService
{

    // =====================================================
    // Auth
    // =====================================================

    public static function authService(bool $getShared = true): AuthService
    {
        if ($getShared) {
            return static::getSharedInstance('authService');
        }

        return new AuthService(
            static::userService(),
            static::roleService(),
            static::permissionService()
        );
    }

    // =====================================================
    // Users
    // =====================================================

    public static function userRepository(bool $getShared = true): UserRepository
    {
        if ($getShared) {
            return static::getSharedInstance('userRepository');
        }

        return new UserRepository(
            new UserModel()
        );
    }

    public static function userService(bool $getShared = true): UserService
    {
        if ($getShared) {
            return static::getSharedInstance('userService');
        }

        return new UserService( static::userRepository() );
    }


    // =====================================================
    // Auth
    // =====================================================

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

        return new RoleService(
            static::roleRepository()
        );
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

    // =====================================================
    // Clients
    // =====================================================

    public static function clientRepository()
    {
        // FEATURE
    }

    public static function clientService()
    {
        // FEATURE
    }

}
