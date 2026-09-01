<?php

declare(strict_types=1);

namespace App\Modules\Users\Entities;

use App\Modules\Auth\Enums\UserStatus;
use CodeIgniter\Entity\Entity;

/**
 * @property int|null $id
 * @property int|null $role_id
 * @property string|null $email
 * @property string|null $username
 * @property string|null $password_hash
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property UserStatus $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class User extends Entity
{
    protected $attributes = [
        'id'            => null,
        'role_id'       => null,
        'email'         => null,
        'username'      => null,
        'password_hash' => null,
        'first_name'    => null,
        'last_name'     => null,
        'phone'         => null,
        'status'        => UserStatus::Active->value,
        'created_at'    => null,
        'updated_at'    => null,
        'deleted_at'    => null,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id'      => 'int',
        'role_id' => 'int',
        // 'status'  => UserStatus::class,
    ];

    public function getStatus(): UserStatus
    {
        return UserStatus::from($this->attributes['status']);
    }

    public function setStatus(UserStatus|string $status): void
    {
        $this->attributes['status'] = $status instanceof UserStatus
            ? $status->value
            : $status;
    }

    public function getFullName(): string
    {
        return trim(
            $this->first_name . ' ' . $this->last_name
        );
    }

    public function isActive(): bool
    {
        return $this->getStatus() === UserStatus::Active;
    }

    public function isDeleted(): bool
    {
        return $this->deleted_at !== null;
    }
}