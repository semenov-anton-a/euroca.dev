<?php

declare(strict_types=1);

namespace App\Modules\Auth\Enums;

enum UserRole: string
{
    case NoSystemAccess = 'no_system_access';
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case Manager = 'manager';
    case Employee = 'employee';
    case Accountant = 'accountant';
    case Client = 'client';

    public static function values(): array
    {
        return array_map(
            fn(self $role) => $role->value,
            self::cases()
        );
    }
}