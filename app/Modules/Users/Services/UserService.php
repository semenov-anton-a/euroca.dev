<?php

declare(strict_types=1);

namespace App\Modules\Users\Services;

use App\Modules\Users\Entities\User;
use App\Modules\Users\Repositories\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function findById(int $userId): ?User
    {
        return $this->userRepository->findById($userId);
    }


    public function findByUsername(string $username): ?User
    {
        return $this->userRepository->findByUsername($username);
    }

    public function getOwnerId(User $user): ?int
    {
        return $user->employee_id ?? $user->customer_id;
    }

    public function create(array $data): int
    {
        return $this->userRepository->create($data);
    }

    public function update(int $userId, array $data): bool
    {
        return $this->userRepository->update($userId, $data);
    }

    public function delete(int $userId): bool
    {
        return $this->userRepository->delete($userId);
    }

    public function existsByUsername(string $username): bool
    {
        return $this->userRepository->existsByUsername($username);
    }
}