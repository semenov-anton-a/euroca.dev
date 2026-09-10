<?php

declare(strict_types=1);

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Enums\UserStatus;
use App\Modules\Users\Entities\User;
use App\Modules\Users\Services\UserService;

use App\Modules\Employees\Services\EmployeeService;


class AuthService
{
    public function __construct(
        protected UserService $userService,
        protected RoleService $roleService,
        protected PermissionService $permissionService,
        protected EmployeeService $employeeService
    ) {}

    /**
     * Проверить учетные данные пользователя.
     */
    public function authenticate(string $login, string $password): ?User
    {
        $user = $this->userService->findByUsername($login);

        if ($user === null) {
            return null;
        }

        if ($user->isDeleted() || !$user->isActive()) {
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
        string $login,
        string $password,
        bool $remember = false
    ): bool {

        /** USERS */
        $user = $this->authenticate($login, $password);
        if ($user === null) { return false; }

        /** ROLES */
        $role = $this->roleService->getUserRole($user->id);
        if ($role === null) { return false; }


        if( ! $this->_ownUserType($user) ) return false;
        

        $employeeName = null;

        if ($user->employee_id !== null) 
        {
            $employeeName = $this->employeeService->findById($user->employee_id)->getFullName();             
        }

        $costumerName = null;

        // if ($user->employee_id !== null) 
        // {
        //     $employee = $this->employeeService->findById($user->employee_id);

        //     if ($employee === null) {
        //         return false;
        //     }

        //     $employeeName = $this->employeeService->getFullName( $employee->id );
        // }

        $displayName = $employeeName ?? $costumerName;

        $permissions = $this->permissionService
            ->getUserPermissions($user->id);

        session()->set([
            'user_id'     => $user->id,            
            
            'employee_id' => $user->employee_id,
            'customer_id' => $user->customer_id,
            'diplayName'  => $displayName,
            'role_id'     => (int) $role['id'],
            'role'        => $role['name'],
            'permissions' => array_column($permissions, 'name'),
            'logged_in'   => true,
            'locale'      => $user->locale,
        ]);

        return true;
    }

    /** 
     *  
     *  Check Employee OR Costumer 
        employee_id = 5, customer_id = NULL    ✅
        employee_id = NULL, customer_id = 12   ✅

        employee_id = 5, customer_id = 12       ❌
        employee_id = NULL, customer_id = NULL  ❌
    */
    private function _ownUserType( User $user )
    {
        return ($user->employee_id !== null) xor ($user->customer_id !== null);
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

    public function getOwnerId( User $user ): ?int
    {
        return $user->employee_id ?? $user->customer_id;
    }

    public function getOwnerType( User $user ): string
    {
        return $user->employee_id !== null
            ? 'employee'
            : 'customer';
    }

    public function isEmployee(): bool
    {
        return session('employee_id') !== null;
    }

    public function isCustomer(): bool
    {
        return session('customer_id') !== null;
    }

    public function getEmployeeId(): ?int
    {
        return session('employee_id');
    }

    public function getCustomerId(): ?int
    {
        return session('customer_id');
    }

}