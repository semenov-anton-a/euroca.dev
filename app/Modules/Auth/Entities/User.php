<?php

declare(strict_types=1);

namespace App\Modules\Auth\Entities;

use CodeIgniter\Entity\Entity;
use App\Modules\Auth\Enums\UserStatus;

class User extends Entity
{
    protected $attributes = [
        'id'         => null,
        'email'      => null,
        'password'   => null,
        'first_name' => null,
        'last_name'  => null,
        'phone'      => null,
        'status'     => UserStatus::Active->value,
        'created_at' => null,
        'updated_at' => null,
    ];

    protected $datamap = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id'     => 'int',
        'status' => UserStatus::class,
    ];

    public function getFullName(): string
    {
        return trim(
            $this->first_name . ' ' . $this->last_name
        );
    }
}