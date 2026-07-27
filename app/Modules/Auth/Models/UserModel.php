<?php

declare(strict_types=1);

namespace App\Modules\Auth\Models;

use CodeIgniter\Model;

/**
 * User model for authentication.
 * Handles user data operations.
 */
class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'role_id',
        'status',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Hash password before insert.
     */
    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $password = $data['data']['password'];
            if (!password_get_info($password)['algo']) {
                $data['data']['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        return $data;
    }

    /**
     * Find user by email.
     */
    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Authenticate user.
     */
    public function authenticate(string $email, string $password): ?array
    {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }
}