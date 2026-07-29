<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;
use App\Modules\Auth\Entities\User;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    /**
     * Проверить, авторизован ли пользователь.
     */
    public function isLoggedIn(): bool
    {
        return session()->has('user_id');
    }

    /**
     * Получить ID текущего пользователя.
     */
    public function currentUserId(): ?int
    {
        $userId = session('user_id');

        return $userId !== null
            ? (int) $userId
            : null;
    }

    /**
     * Получить текущего пользователя из базы.
     */
    public function currentUser(): ?User
    {
        $userId = $this->currentUserId();

        if ($userId === null) {
            return null;
        }

        return $this->userRepository->findById($userId);
    }
}