<?php

declare(strict_types=1);

namespace App\Modules\Auth\Repositories;

use CodeIgniter\Database\BaseConnection;
use Config\Database;

class RoleRepository
{
    protected BaseConnection $db;

    private string $_tableName = 'roles';

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Найти роль по ID.
     */
    public function findById(int $roleId): ?array
    {
        return $this->db
            ->table($this->_tableName)
            ->where('id', $roleId)
            ->get()
            ->getRowArray() ?: null;
    }

    /**
     * Найти роль по имени.
     */
    public function findByName(string $name): ?array
    {
        return $this->db
            ->table($this->_tableName)
            ->where('name', $name)
            ->get()
            ->getRowArray() ?: null;
    }

    /**
     * Получить роль пользователя.
     */
    public function getUserRole(int $userId): ?array
    {
        return $this->db
            ->table('roles r')
            ->select('r.*')
            ->join('users u', 'u.role_id = r.id')
            ->where('u.id', $userId)
            ->get()
            ->getRowArray() ?: null;
    }

    /**
     * Получить ID роли пользователя.
     */
    public function getUserRoleId(int $userId): ?int
    {
        $result = $this->db
            ->table('users')
            ->select('role_id')
            ->where('id', $userId)
            ->get()
            ->getRowArray();

        return $result !== null
            ? (int) $result['role_id']
            : null;
    }

    /**
     * Получить роли, доступные для управления.
     */
    public function getManageableRoles(string ...$excludedRoles): array
    {
        return $this->db
            ->table($this->_tableName)
            ->whereNotIn('name', $excludedRoles)
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResultObject();
    }

    /**
     * Получить все роли.
     */
    public function findAll(): array
    {
        return $this->db
            ->table($this->_tableName)
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResultObject();
    }

    /**
     * Создать роль.
     */
    public function create(array $data): int
    {
        $this->db
            ->table($this->_tableName)
            ->insert($data);

        return (int) $this->db->insertID();
    }

    /**
     * Обновить роль.
     */
    public function update(int $roleId, array $data): bool
    {
        return $this->db
            ->table($this->_tableName)
            ->where('id', $roleId)
            ->update($data);
    }

    /**
     * Удалить роль.
     */
    public function delete(int $roleId): bool
    {
        return $this->db
            ->table($this->_tableName)
            ->where('id', $roleId)
            ->delete();
    }
}