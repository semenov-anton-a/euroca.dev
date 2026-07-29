<?php

declare(strict_types=1);

namespace App\Modules\Auth\Models;

use CodeIgniter\Model;

/**
 * User model for authentication.
 *
 * Handles user data and authentication.
 * User roles are stored separately in the roles_users table.
 */
class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'email',
        'username',
        'password_hash',
        'first_name',
        'last_name',
        'phone',
        'status',
    ];

    protected $useTimestamps = true;

    /**
     * Hash password before inserting a new user.
     */
    protected $beforeInsert = [
        'hashPassword',
    ];

    /**
     * Hash password before updating a user.
     */
    protected $beforeUpdate = [
        'hashPassword',
    ];

    /**
     * Hash password.
     *
     * Password is hashed only if it is not already hashed.
     */
    protected function hashPassword(
        array $data
    ): array {
        if (
            isset($data['data']['password_hash'])
            && !empty($data['data']['password_hash'])
        ) {
            $password = $data['data']['password_hash'];

            // Do not hash an already hashed password.
            if (
                password_get_info($password)['algo'] === 0
            ) {
                $data['data']['password_hash'] = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );
            }
        }

        return $data;
    }

    /**
     * Find user by email.
     */
    public function findByEmail(
        string $email
    ): ?array {
        return $this
            ->where('email', $email)
            ->first();
    }

    /**
     * Authenticate user.
     *
     * Returns user data if credentials are valid.
     */
    public function authenticate(
        string $email,
        string $password
    ): ?array {
        $user = $this->findByEmail($email);

        if (
            $user !== null
            && password_verify(
                $password,
                $user['password']
            )
        ) {
            return $user;
        }

        return null;
    }

    /**
     * Check if user exists by email.
     */
    public function existsByEmail(
        string $email
    ): bool {
        return $this
            ->where('email', $email)
            ->countAllResults() > 0;
    }

    /**
     * Check if user exists by username.
     */
    public function existsByUsername(
        string $username
    ): bool {
        return $this
            ->where('username', $username)
            ->countAllResults() > 0;
    }
}