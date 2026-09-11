<?php

declare(strict_types=1);

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Entities\User;
use App\Modules\Users\Models\UserModel;

class UserRepository
{
    public function __construct(
        protected UserModel $userModel
    ) {}

    public function findById(int $userId): ?User
    {
        return $this->userModel->find($userId);
    }

    public function findByUsername(string $username): ?User
    {
        return $this->userModel
            ->where('username', $username)
            ->first();
    }
    
    public function existsByUsername(string $username): bool
    {
        return $this->userModel
            ->where('username', $username)
            ->countAllResults() > 0;
    }

    public function create(array $data): int
    {
        $this->userModel->insert($data);
        return (int) $this->userModel->getInsertID();
    }

    public function update(int $userId, array $data): bool
    {
        return $this->userModel->update($userId, $data);
    }
    public function delete(int $userId): bool
    {
        return $this->userModel->delete($userId);
    }
}