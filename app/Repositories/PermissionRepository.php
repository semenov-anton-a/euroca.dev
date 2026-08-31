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

    public function getAll() : array
    {
        return [
            // 'cargo' => [
            //     'view' => ['id' => 1, 'label' => 'View'],
            //     'create' => ['id' => 2, 'label' => 'Create'],
            //     'edit' => ['id' => 3, 'label' => 'Edit'],
            //     'delete' => ['id' => 4, 'label' => 'Delete'],
            // ],
            'customers' => [
                'view' => ['id' => 5, 'label' => 'View'],
                'create' => ['id' => 6, 'label' => 'Create'],
                'edit' => ['id' => 7, 'label' => 'Edit'],
                'delete' => ['id' => 8, 'label' => 'Delete'],
            ],
            // 'warehouse' => [
            //     'view' => ['id' => 9, 'label' => 'View'],
            //     'create' => ['id' => 10, 'label' => 'Create'],
            //     'edit' => ['id' => 11, 'label' => 'Edit'],
            //     'delete' => ['id' => 12, 'label' => 'Delete'],
            // ],
            'invoices' => [
                'view' => ['id' => 13, 'label' => 'View'],
                'create' => ['id' => 14, 'label' => 'Create'],
                'edit' => ['id' => 15, 'label' => 'Edit'],
                'delete' => ['id' => 16, 'label' => 'Delete'],
            ],
            'accounting' => [
                'view' => ['id' => 17, 'label' => 'View'],
                'create' => ['id' => 18, 'label' => 'Create'],
                'edit' => ['id' => 19, 'label' => 'Edit'],
                'delete' => ['id' => 20, 'label' => 'Delete'],
            ],
        ];

        return $this->db
            ->table('permissions p')
            ->select('p.*')
            ->get()
            ->getResultArray();      
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
    public function removeFromRole( int $roleId, int $permissionId
    ): bool 
    {
        return $this->db
            ->table('role_permissions')
            ->where('role_id', $roleId)
            ->where('permission_id', $permissionId)
            ->delete();
    }


    /**
     * Получить все разрешения для РОЛИ
     * @param int $roleId
     * @return array
     */
    public function getRolePermissions(int $roleId): array
    {
        $result = $this->db->table('permissions p')
            ->select('p.name')
            ->join('role_permissions rp', 'rp.permission_id = p.id')
            ->where('rp.role_id', $roleId)
            ->orderBy('p.name', 'ASC')
            ->get()
            ->getResultArray();

        return array_column($result, 'name');
    }
    
}
