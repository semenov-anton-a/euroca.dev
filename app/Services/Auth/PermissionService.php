<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Repositories\PermissionRepository;

class PermissionService
{
    public function __construct(
        protected PermissionRepository $permissionRepository
    ) {
    }

    /**
     * Проверить, есть ли у пользователя указанное разрешение.
     */
    public function can(
        int $userId,
        string $permission
    ): bool {
        return $this->permissionRepository
            ->userHasPermission(
                $userId,
                $permission
            );
    }

    /**
     * Проверить несколько разрешений.
     * Пользователь должен иметь ВСЕ разрешения.
     */
    public function canAll(
        int $userId,
        array $permissions
    ): bool {
        foreach ($permissions as $permission) {
            if (!$this->can($userId, $permission)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Проверить несколько разрешений.
     * Пользователю достаточно иметь ХОТЯ БЫ ОДНО.
     */
    public function canAny(
        int $userId,
        array $permissions
    ): bool {
        foreach ($permissions as $permission) {
            if ($this->can($userId, $permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Получить все разрешения пользователя.
     */
    public function getUserPermissions(int $userId): array
    {
        return $this->permissionRepository
            ->getUserPermissions($userId);
    }
}