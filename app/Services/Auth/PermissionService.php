<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Repositories\PermissionRepository;

class PermissionService
{
    public function __construct(
        protected PermissionRepository $permissionRepository,
        protected RoleService $roleService
    ) {
    }

    /**
     * Проверить, есть ли у пользователя указанное разрешение.
     */
    public function can( int $userId, string $permission ): bool 
    {
        if ($this->roleService->isSuperAdmin($userId)) 
        {
            return true;
        }

        return $this->permissionRepository->userHasPermission( $userId,$permission );
    }

    /**
     * Проверить несколько разрешений.
     * Пользователь должен иметь ВСЕ разрешения.
     */
    public function canAll( int $userId, array $permissions): bool 
    {
        foreach ($permissions as $permission) 
        {
            if ( ! $this->can($userId, $permission)) 
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Проверить несколько разрешений.
     * Пользователю достаточно иметь ХОТЯ БЫ ОДНО.
     */
    public function canAny( int $userId, array $permissions ): bool 
    {
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
    public function getUserPermissions(int $userId): ?array
    {
        $useCache = filter_var(
            env('AUTH_PERMISSION_CACHE', false), FILTER_VALIDATE_BOOLEAN
        );

        if ($useCache) 
        {
            $cacheKey = "user_permissions_{$userId}";
            $cacheTtl = (int) env('AUTH_PERMISSION_CACHE_TTL', 3600);

            $cachedPermissions = cache($cacheKey);

            if ($cachedPermissions !== null) {
                return $cachedPermissions;
            }

            $permissions = $this->permissionRepository->getUserPermissions($userId);
            cache()->save($cacheKey, $permissions, $cacheTtl);

            return $permissions;
        }

        return null;
        
    }
}