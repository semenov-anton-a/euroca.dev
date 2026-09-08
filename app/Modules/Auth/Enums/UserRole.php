<?php

declare(strict_types=1);

namespace App\Modules\Auth\Enums;

enum UserRole: string
{
    case NoSystemAccess = 'No System Access';
    case SuperAdmin = 'Super Admin';
    case Admin = 'Administrator';
    case Manager = 'Manager';
    case Employee = 'Employee';
    case Accountant = 'Accountant';

    case Client = 'Client';

    public static function values(): array
    {
        return array_map(
            fn(self $role) => $role->value,
            self::cases()
        );
    }
}