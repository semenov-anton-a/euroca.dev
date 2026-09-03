<?php

declare(strict_types=1);

namespace App\Modules\Users\Config;

use CodeIgniter\Config\BaseService;

use App\Modules\Users\Models\UserModel;
use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Services\UserService;

class Services extends BaseService
{  
    public static function userRepository(bool $getShared = true): UserRepository
    {
        if ($getShared) {
            return static::getSharedInstance('userRepository');
        }

        return new UserRepository(new UserModel());
    }

    public static function userService(bool $getShared = true): UserService
    {
        if ($getShared) {
            return static::getSharedInstance('userService');
        }

        return new UserService(static::userRepository());
    }
}