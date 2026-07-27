<?php

declare(strict_types=1);

namespace App\Modules\Auth\Services;

/**
 * Fake user provider for testing purposes.
 * In production, this would be replaced with a database-backed user system.
 */
class FakeUserProvider
{
    /**
     * Fake users array for testing.
     * Password is hashed with password_hash() for 'password123'
     */
    protected array $users = [
        [
            'id' => 1,
            'email' => 'admin@eurocargo.local',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password123
            'first_name' => 'Admin',
            'last_name' => 'User',
            'phone' => '+79001234567',
            'role_id' => 1,
            'status' => 'active',
            'permissions' => ['cargo.view', 'cargo.edit', 'customer.view', 'accounting.view', 'settings.view'],
        ],
        [
            'id' => 2,
            'email' => 'driver@eurocargo.local',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password123
            'first_name' => 'Driver',
            'last_name' => 'User',
            'phone' => '+79001234568',
            'role_id' => 2,
            'status' => 'active',
            'permissions' => ['cargo.view', 'cargo.edit'],
        ],
        [
            'id' => 3,
            'email' => 'manager@eurocargo.local',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password123
            'first_name' => 'Manager',
            'last_name' => 'User',
            'phone' => '+79001234569',
            'role_id' => 3,
            'status' => 'active',
            'permissions' => ['cargo.view', 'cargo.edit', 'customer.view', 'accounting.view'],
        ],
    ];

    /**
     * Find user by email.
     */
    public function findByEmail(string $email): ?array
    {
        foreach ($this->users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Find user by ID.
     */
    public function findById(int $id): ?array
    {
        foreach ($this->users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Authenticate user by email and password.
     */
    public function authenticate(string $email, string $password): ?array
    {
        $user = $this->findByEmail($email);
        
        if ($user && $password === 'password123') {
            return $user;
        }
        
        // if ($user && password_verify($password, $user['password'])) {
        //     return $user;
        // }
        
        return null;
    }

    /**
     * Get all users.
     */
    public function all(): array
    {
        return $this->users;
    }
}