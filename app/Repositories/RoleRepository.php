<?php

namespace App\Repositories;

use CodeIgniter\Database\BaseConnection;
use Config\Database;

class RoleRepository
{
    protected BaseConnection $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Найти роль по ID
     */
    public function findById(int $roleId): ?array
    {
        return $this->db
            ->table('roles')
            ->where('id', $roleId)
            ->get()
            ->getRowArray() ?: null;
    }

    /**
     * Найти роль по имени
     */
    public function findByName(string $name): ?array
    {
        return $this->db
            ->table('roles')
            ->where('name', $name)
            ->get()
            ->getRowArray() ?: null;
    }

    /**
     * Получить роли пользователя
     */
    public function getUserRoles(int $userId): array
    {
        return $this->db
            ->table('roles r')
            ->select('r.*')
            ->join(
                'roles_users ru',
                'ru.role_id = r.id'
            )
            ->where('ru.user_id', $userId)
            ->get()
            ->getResultArray();
    }

    /**
     * Назначить роль пользователю
     */
    public function assignToUser(
        int $userId,
        int $roleId
    ): bool {
        return $this->db
            ->table('roles_users')
            ->insert([
                'user_id' => $userId,
                'role_id' => $roleId,
            ]);
    }

    /**
     * Удалить роль у пользователя
     */
    public function removeFromUser(
        int $userId,
        int $roleId
    ): bool {
        return $this->db
            ->table('roles_users')
            ->where('user_id', $userId)
            ->where('role_id', $roleId)
            ->delete();
    }
}