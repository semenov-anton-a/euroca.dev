<?php

declare(strict_types=1);

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Enums\UserStatus;
use App\Modules\Users\Entities\User;
use App\Modules\Users\Services\UserService;

class AuthService
{
    public function __construct(
        protected UserService $userService,
        protected RoleService $roleService,
        protected PermissionService $permissionService
    ) {}

    /**
     * Проверить учетные данные пользователя.
     */
    public function authenticate(string $email, string $password): ?User
    {
        $user = $this->userService->findByEmail($email);

        if ($user === null) {
            return null;
        }

        if ($user->isDeleted()) {
            return null;
        }

        if (!$user->isActive()) {
            return null;
        }

        if (!password_verify($password, $user->password_hash)) {
            return null;
        }

        return $user;
    }

    /**
     * Авторизовать пользователя.
     */
    public function login(
        string $email,
        string $password,
        bool $remember = false
    ): bool {
        $user = $this->authenticate($email, $password);

        if ($user === null) {
            return false;
        }

        $role = $this->roleService->getUserRole($user->id);

        if ($role === null) {
            return false;
        }

        $permissions = $this->permissionService
            ->getUserPermissions($user->id);

        session()->set([
            'user_id'     => $user->id,
            'user_email'  => $user->email,
            'user_name'   => $user->fullName,
            'role_id'     => (int) $role['id'],
            'role'        => $role['name'],
            'permissions' => array_column($permissions, 'name'),
            'logged_in'   => true,
            'locale'      => 'en',
        ]);

        return true;
    }

    /**
     * Выйти из системы.
     */
    public function logout(): void
    {
        session()->destroy();
    }

    /**
     * Проверить авторизацию.
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

        return $userId !== null ? (int) $userId : null;
    }

    /**
     * Получить текущего пользователя.
     */
    public function currentUser(): ?User
    {
        $userId = $this->currentUserId();

        if ($userId === null) {
            return null;
        }

        return $this->userService->findById($userId);
    }
}