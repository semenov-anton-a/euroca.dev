<?php

declare(strict_types=1);

namespace App\Modules\Users\Entities;

use App\Modules\Auth\Enums\UserStatus;
use CodeIgniter\Entity\Entity;

/**
 * @property int|null $id
 * @property int|null $employee_id
 * @property int|null $customer_id
 * @property int|null $role_id
 * @property string|null $username
 * @property string|null $password_hash
 * @property string|null $locale
 * @property UserStatus $status
 * @property int|null $failed_login_count
 * @property string|null $locked_until
 * @property string|null $last_login_at
 * @property string|null $last_login_ip
 * @property string|null $password_changed_at
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class User extends Entity
{
    protected $attributes = [
        'id'                  => null,
        'employee_id'         => null,
        'customer_id'         => null,
        'role_id'             => null,
        'username'            => null,
        'password_hash'       => null,
        'locale'              => 'en',
        'status'              => UserStatus::Active->value,
        'failed_login_count'  => 0,
        'locked_until'        => null,
        'last_login_at'       => null,
        'last_login_ip'       => null,
        'password_changed_at' => null,
        'created_at'          => null,
        'updated_at'          => null,
        'deleted_at'          => null,
    ];

    protected $dates = [
        'locked_until',
        'last_login_at',
        'password_changed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id' => 'int',
        'employee_id' => '?int',
        'customer_id' => '?int',
        'role_id' => 'int',
        'failed_login_count' => 'int',
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

    public function isActive(): bool
    {
        return $this->getStatus() === UserStatus::Active;
    }

    public function isDeleted(): bool
    {
        return $this->deleted_at !== null;
    }

    public function isEmployee(): bool
    {
        return $this->employee_id !== null;
    }

    public function isCustomer(): bool
    {
        return $this->customer_id !== null;
    }
}