<?php

declare(strict_types=1);

namespace App\Modules\Employees\Enums;

enum RulesRegex: string
{
    case Username = '/^[a-z][a-z0-9_.-]{2,49}$/';
    // case Name = '/^[\p{L} -]{2,100}$/u';
    case Name = '/^[A-Za-z \'-.]{2,100}$/';
    case Phone = '/^\+?[0-9\s().-]{7,30}$/';
    case Password = '/^.{8,255}$/';

    public static function values(): array
    {
        return array_map(
            fn(self $rule) => $rule->value,
            self::cases()
        );
    }
}