<?php

declare(strict_types=1);

namespace App\Modules\Auth\Entities;

use CodeIgniter\Entity\Entity;

/**
 * User entity for authentication.
 * Represents a user in the system.
 */
class User extends Entity
{
    protected $attributes = [
        'id' => null,
        'email' => null,
        'password' => null,
        'first_name' => null,
        'last_name' => null,
        'phone' => null,
        'role_id' => null,
        'status' => 'active',
        'created_at' => null,
        'updated_at' => null,
    ];

    protected $datamap = [];

    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'id' => 'int',
        'role_id' => 'int',
        'status' => 'string',
    ];

    /**
     * Get full name.
     */
    public function getFullName(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Check if user has role.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}