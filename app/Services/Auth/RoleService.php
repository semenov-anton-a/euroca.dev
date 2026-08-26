<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Repositories\RoleRepository;
use App\Modules\Auth\Enums\UserRole;

class RoleService
{
    
    public function __construct(
        protected RoleRepository $roleRepository
    ) {        
    }

    /**
     * Получить роль пользователя.
     */
    public function getUserRole(int $userId): ?array
    {
        return $this->roleRepository->getUserRole($userId);
    }

    /**
     * Получить ID роли пользователя.
     */
    public function getUserRoleId(int $userId): ?int
    {
        return $this->roleRepository->getUserRoleId($userId);
    }

    /**
     * Получить название роли пользователя.
     */
    public function getUserRoleName(int $userId): ?string
    {
        $role = $this->getUserRole($userId);

        return $role['name'] ?? null;
    }

    /**
     * Проверить роль пользователя.
     */
    public function hasRole(
        int $userId,
        UserRole $role
    ): bool {
        return $this->getUserRoleName($userId)
            === $role->value;
    }

    /**
     * Проверить Super Admin.
     */
    public function isSuperAdmin(int $userId): bool
    {
        return $this->hasRole(
            $userId,
            UserRole::SuperAdmin
        );
    }

    /**
     * Проверить Admin.
     */
    public function isAdmin(int $userId): bool
    {
        return $this->hasRole(
            $userId,
            UserRole::Admin
        );
    }

    /**
     * Проверить Employee.
     */
    public function isEmployee(int $userId): bool
    {
        return $this->hasRole(
            $userId,
            UserRole::Employee
        );
    }

    /**
     * Проверить Client.
     */
    public function isClient(int $userId): bool
    {
        return $this->hasRole(
            $userId,
            UserRole::Client
        );
    }

    /**
     * Назначить роль пользователю.
     */
    public function assignRole(
        int $userId,
        int $roleId
    ): bool {
        return $this->roleRepository->assignToUser(
            $userId,
            $roleId
        );
    }

    /**
     * Удалить роль у пользователя.
     */
    public function removeRole(
        int $userId,
        int $roleId
    ): bool {
        return $this->roleRepository->removeFromUser(
            $userId,
            $roleId
        );
    }

    /**
     * Получить данные роли
     * @param int $id
     * @return array|null
     */
    public function getRoleById( int $id ) :? array
    {
        return $this->roleRepository->findById( $id );
    }

    /**
     * Получить все роли.
     */
    public function getAll(): array
    {
        return $this->roleRepository->findAll();
    }

    /**
     * Создать роль.
     */
    public function create(array $data): int
    {
        return $this->roleRepository->create($data);
    }

    /**
     * Обновить роль.
     */
    public function update(
        int $roleId,
        array $data
    ): bool {
        return $this->roleRepository->update(
            $roleId,
            $data
        );
    }

    public function getManageableRoles(): array
    {
        return $this->roleRepository->getManageableRoles( UserRole::SuperAdmin->value, UserRole::Admin->value  );
    }

    /**
     * Удалить роль.
     */
    public function delete(int $roleId): bool
    {
        return $this->roleRepository->delete($roleId);
    }
}
