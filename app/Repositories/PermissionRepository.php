<?php

namespace App\Repositories;

use CodeIgniter\Database\BaseConnection;
use Config\Database;

class PermissionRepository
{
    protected BaseConnection $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Получить все права пользователя
     * через его роли
     */
    public function getUserPermissions(int $userId): array
    {
        return $this->db
            ->table('permissions p')
            ->select('p.*')
            ->join(
                'role_permissions rp',
                'rp.permission_id = p.id'
            )
            ->join(
                'roles_users ru',
                'ru.role_id = rp.role_id'
            )
            ->where('ru.user_id', $userId)
            ->groupBy('p.id')
            ->get()
            ->getResultArray();
    }

    /**
     * Проверить наличие права
     */
    public function userHasPermission(
        int $userId,
        string $permissionName
    ): bool {
        return $this->db
            ->table('permissions p')
            ->join(
                'role_permissions rp',
                'rp.permission_id = p.id'
            )
            ->join(
                'roles_users ru',
                'ru.role_id = rp.role_id'
            )
            ->where('ru.user_id', $userId)
            ->where('p.name', $permissionName)
            ->countAllResults() > 0;
    }

    /**
     * Назначить право роли
     */
    public function assignToRole(
        int $roleId,
        int $permissionId
    ): bool {
        return $this->db
            ->table('role_permissions')
            ->insert([
                'role_id' => $roleId,
                'permission_id' => $permissionId,
            ]);
    }

    /**
     * Удалить право у роли
     */
    public function removeFromRole(
        int $roleId,
        int $permissionId
    ): bool {
        return $this->db
            ->table('role_permissions')
            ->where('role_id', $roleId)
            ->where('permission_id', $permissionId)
            ->delete();
    }


    
}
