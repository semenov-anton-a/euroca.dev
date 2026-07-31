<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use App\Repositories\PermissionRepository;


class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected PermissionRepository $permissionRepository
    ) {
    }


    /**
     * Authenticate user.
     */
    public function authenticate( string $email,string $password ): ?array 
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) { 
            return null; 
        }

        // Пользователь удалён (Soft Delete)
        if ($user['deleted_at'] !== null) {
            return null;
        }

        if ($user['status'] !== 'active') { 
            return null; 
        }

        if (!password_verify(
            $password,
            $user['password_hash']
        )) {
            return null;
        }

        $permissions = $this->permissionRepository->getUserPermissions( (int)$user['id'] );

        $user['permissions'] = array_column( $permissions, 'name' );

        unset($user['password_hash']);

        return $user;
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
            ? (int)$userId
            : null;
    }

    /**
     * Получить текущего пользователя.
     */
    public function currentUser(): ?array
    {
        $userId = $this->currentUserId();

        if ($userId === null) {
            return null;
        }

        return $this->userRepository->findById($userId);
    }
}
