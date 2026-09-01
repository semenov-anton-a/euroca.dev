<?php

declare(strict_types=1);

namespace App\Modules\Auth\Repositories;

use CodeIgniter\Database\BaseConnection;
use Config\Database;

class PermissionRepository
{
    protected BaseConnection $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAll(): array
    {
        return $this->db
            ->table('permissions p')
            ->select('p.*')
            ->orderBy('p.name', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Получить все права пользователя
     * через его роль.
     */
    public function getUserPermissions(int $userId): array
    {
        return $this->db
            ->table('permissions p')
            ->select('p.*')
            ->join('role_permissions rp', 'rp.permission_id = p.id')
            ->join('users u', 'u.role_id = rp.role_id')
            ->where('u.id', $userId)
            ->groupBy('p.id')
            ->get()
            ->getResultArray();
    }

    /**
     * Проверить наличие права у пользователя.
     */
    public function userHasPermission(
        int $userId,
        string $permissionName
    ): bool {
        return $this->db
            ->table('permissions p')
            ->join('role_permissions rp', 'rp.permission_id = p.id')
            ->join('users u', 'u.role_id = rp.role_id')
            ->where('u.id', $userId)
            ->where('p.name', $permissionName)
            ->countAllResults() > 0;
    }

    /**
     * Назначить право роли.
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
     * Удалить право у роли.
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

    /**
     * Получить все разрешения для роли.
     */
    public function getRolePermissions(int $roleId): array
    {
        $result = $this->db
            ->table('permissions p')
            ->select('p.name')
            ->join(
                'role_permissions rp',
                'rp.permission_id = p.id'
            )
            ->where('rp.role_id', $roleId)
            ->orderBy('p.name', 'ASC')
            ->get()
            ->getResultArray();

        return array_column($result, 'name');
    }
}