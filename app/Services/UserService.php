<?php

declare(strict_types=1);

namespace App\Services;

/**
 * User service for current user information.
 */
class UserService
{
    /**
     * Check if user is logged in.
     */
    public function isLoggedIn(): bool
    {
        return session()->has('user_id');
    }

    /**
     * Get current user data.
     */
    public function currentUser(): ?array
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return [
            'id' => session('user_id'),
            'email' => session('user_email'),
            'name' => session('user_name'),
            'role_id' => session('role_id'),
            'permissions' => session('permissions'),
        ];
    }

    /**
     * Check if user has specific permission.
     */
    public function hasPermission(string $permission): bool
    {
        $permissions = session('permissions', []);
        return in_array($permission, $permissions, true);
    }
}