<?php

declare(strict_types=1);

namespace App\Modules\Users\Config;

use CodeIgniter\Config\BaseService;
use App\Modules\Users\Models\UserModel;
use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Services\UserService;
use App\Modules\Auth\Repositories\PermissionRepository;
use App\Modules\Auth\Repositories\RoleRepository;

class Services extends BaseService
{
    public static function userService(bool $getShared = true): UserService
    {
        if ($getShared) {
            return static::getSharedInstance('userService');
        }

        return new UserService(
            new UserRepository(new UserModel()),
            new PermissionRepository(),
            new RoleRepository()
        );
    }
}