<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;

class UserService
{
    //  Current user data, cached after first retrieval
    protected ?array $currentUser = null;

    public function __construct(
        protected UserRepository $userRepository,
        protected PermissionRepository $permissionRepository,
        protected RoleRepository $roleRepository
    ) {
        
    }

    /**
     * Проверить учетные данные пользователя.
     *
     * Возвращает пользователя с ролью и permissions
     * или null, если авторизация невозможна.
     */
    public function authenticate( string $email, string $password ): ?array 
    {
    
        $user = $this->userRepository->findByEmail($email);

        if ($user === null) {
            return null;
        }

        // Пользователь удалён (Soft Delete)
        if ($user['deleted_at'] !== null) {
            return null;
        }

        // Пользователь не активен
        if ($user['status'] !== 'active') {
            return null;
        }

        // Проверяем пароль
        if (!password_verify( $password, $user['password_hash'])) {
            return null;
        }

        // Получаем роль пользователя
        $role = $this->roleRepository->getUserRole( (int) $user['id'] );

        // У пользователя обязательно должна быть роль
        if ($role === null) {
            return null;
        }

        $user['role_id'] = (int) $role['id'];
        $user['role'] = $role['name'];

        // Получаем permissions
        $permissions = $this->permissionRepository
            ->getUserPermissions(
                (int) $user['id']
            );

        $user['permissions'] = array_column(
            $permissions,
            'name'
        );

        // Пароль никогда не передаём дальше
        unset($user['password_hash']);

        return $user;
    }

    /**
     * Авторизовать пользователя.
     *
     * Проверяет учетные данные и создаёт сессию.
     */
    public function login(
        string $email,
        string $password,
        bool $remember = false
    ): bool {
        
        $user = $this->authenticate( $email, $password );

        if ($user === null) {
            return false;
        }

        unset( $user['password_hash'] );       

        // Данные сессии
        session()->set([
            'user_id' => (int) $user['id'],
            'user_email' => $user['email'],
            'user_name' => trim( $user['first_name'] . ' ' . $user['last_name'] ),
            'role_id' => $user['role_id'],
            'role' => $user['role'],
            'logged_in' => true,
            'locale' => 'en' // Use the session locale or set a default
        ]);

        $this->currentUser = $user;

        // Remember Me
        // if ($remember) {
        //     session()->setExpiration(2880);
        // }

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
     * Получить текущего пользователя.
     */
    public function currentUser(): ?array
    {
        if ( $this->currentUser !== null ) 
        {
            return $this->currentUser;
        }   

        $userId = $this->currentUserId();

        if ($userId === null) {
            return null;
        }

        return $this->userRepository->findProfileById($userId);
        // return $this->userRepository->findById( $userId );
    }
}
