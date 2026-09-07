<?php

declare(strict_types=1);

namespace App\Modules\AdminSettings\Enums;


enum RulesRegex: string
{
    case RoleName = '/^[a-z][a-z0-9_]{2,49}$/';
    case DescriptionName = '/^.{10,255}$/';
    case PermissionName = '/^[a-z][a-z0-9_.]*$/';

    public static function values(): array
    {
        return array_map( fn(self $role) => $role->value, self::cases() );
    }

}