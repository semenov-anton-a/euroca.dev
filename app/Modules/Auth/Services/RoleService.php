<?php

declare(strict_types=1);

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Enums\UserRole;
use App\Modules\Auth\Repositories\RoleRepository;

class RoleService
{
    public function __construct(
        protected RoleRepository $roleRepository
    ) {}

    public function getUserRole(int $userId): ?array
    {
        return $this->roleRepository->getUserRole($userId);
    }

    public function getUserRoleId(int $userId): ?int
    {
        return $this->roleRepository->getUserRoleId($userId);
    }

    public function getUserRoleName(int $userId): ?string
    {
        $role = $this->getUserRole($userId);

        return $role['name'] ?? null;
    }

    public function hasRole(int $userId, UserRole $role): bool
    {
        return $this->getUserRoleName($userId) === $role->value;
    }

    public function isSuperAdmin(int $userId): bool
    {
        return $this->hasRole($userId, UserRole::SuperAdmin);
    }

    public function isAdmin(int $userId): bool
    {
        return $this->hasRole($userId, UserRole::Admin);
    }

    public function isEmployee(int $userId): bool
    {
        return $this->hasRole($userId, UserRole::Employee);
    }

    public function isClient(int $userId): bool
    {
        return $this->hasRole($userId, UserRole::Client);
    }

    public function getRoleById(int $id): ?array
    {
        return $this->roleRepository->findById($id);
    }

    public function getAll(): array
    {
        return $this->roleRepository->findAll();
    }

    public function create(array $data): int
    {
        return $this->roleRepository->create($data);
    }

    public function update(int $roleId, array $data): bool
    {
        return $this->roleRepository->update($roleId, $data);
    }

    public function getManageableRoles( string ...$excludedRoles ): array
    {
        $excludedRoles[] = UserRole::SuperAdmin->value;        
        return $this->roleRepository->getManageableRoles( ...$excludedRoles );
    }

    public function delete(int $roleId): bool
    {
        return $this->roleRepository->delete($roleId);
    }
}