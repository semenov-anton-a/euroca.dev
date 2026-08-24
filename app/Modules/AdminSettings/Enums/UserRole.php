<?php

declare(strict_types=1);

namespace App\Modules\Auth\Enums;


// use in a code
// if ($role === UserRole::SuperAdmin->value) 

enum UserRole: string
{
    case SuperAdmin = 'super_admin';

    case Admin = 'admin';

    case Employee = 'employee';

    case Client = 'client';


    /**
     * Получить все роли.
     */
    public static function values(): array
    {
        return array_map( fn(self $role) => $role->value, self::cases() );
    }
}