<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Modules\Auth\Models\UserModel;

class UserRepository
{
    public function __construct( protected UserModel $userModel ) {}

    public function findById(int $userId): ?array
    {
        return $this->userModel->find($userId);
    }

    public function findByEmail(string $email): ?array
    {
        return $this->userModel->where('email', $email)->first();
    }

    public function existsByEmail(string $email): bool
    {
        return $this->userModel->where('email', $email)->countAllResults() > 0;
    }

    public function existsByUsername(string $username): bool
    {
        return $this->userModel->where('username', $username)->countAllResults() > 0;
    }

    public function create(array $data): int
    {
        $this->userModel->insert($data);

        return (int)$this->userModel->getInsertID();
    }

    public function update( int $userId, array $data): bool 
    {
        return $this->userModel->update($userId, $data);
    }

    public function delete(int $userId): bool
    {
        return $this->userModel->delete($userId);
    }
}