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
     * Проверяет наличие одного разрешения.
     */
    public function can(int $userId, string $permission): bool
    {
        if ($this->roleService->isSuperAdmin($userId)) {
            return true;
        }

        return $this->permissionRepository
            ->userHasPermission($userId, $permission);
    }


    /**
     * Пользователь должен иметь ВСЕ разрешения.
     */
    public function canAll(
        int $userId,
        array $permissions
    ): bool {

        foreach ($permissions as $permission) {

            if (! $this->can($userId, $permission)) {
                return false;
            }
        }

        return true;
    }


    /**
     * Пользователю достаточно иметь хотя бы ОДНО разрешение.
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
     *
     * Всегда возвращает массив.
     */
    public function getUserPermissions( int $userId ): array
    {
        
        $useCache = filter_var( env('AUTH_PERMISSION_CACHE', false), FILTER_VALIDATE_BOOLEAN );

        

        $cacheKey = "user_permissions_{$userId}";

        /*
         * Проверяем cache.
         */
        if ($useCache) 
        {
            $cachedPermissions = cache($cacheKey);

            if ($cachedPermissions !== null) 
            {
                return $cachedPermissions;
            }
        }


        /*
         * Получаем permissions из Repository.
         */
        $permissions = $this->permissionRepository->getUserPermissions($userId);

        /*
         * На всякий случай гарантируем array.
         */
        $permissions ??= [];

        /*
         * Сохраняем в cache.
         */
        if ($useCache) 
        {
            $cacheTtl = (int) env( 'AUTH_PERMISSION_CACHE_TTL', 3600 );
            cache()->save( $cacheKey, $permissions, $cacheTtl );
        }

        return $permissions;
    }


    /**
     * Проверить, есть ли permission в уже загруженном списке.
     *
     * Это особенно удобно для MenuService.
     */
    public function hasPermission(
        array $permissions,
        string $permission
    ): bool {

        return in_array(
            $permission,
            $permissions,
            true
        );
    }
}