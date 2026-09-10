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

    public function generateUsernameIncrement(string $baseUsername): string
    {
        if ( !$this->userRepository->existsByUsername($baseUsername) ) {
            return $baseUsername;
        }

        $counter = 2;

        do {
            $username = $baseUsername . '_' . $counter;
            $counter++;
        } while ($this->userRepository->existsByUsername($username));

        return $username;
    }

    public function findById(int $userId): ?User
    {
        return $this->userRepository->findById($userId);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function findByUsername(string $username): ?User
    {
        return $this->userRepository->findByUsername($username);
    }

    public function findByLogin(string $login): ?User
    {
        return $this->userRepository->findByLogin($login);
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

    public function existsByEmail(string $email): bool
    {
        return $this->userRepository->existsByEmail($email);
    }

    public function existsByUsername(string $username): bool
    {
        return $this->userRepository->existsByUsername($username);
    }
}