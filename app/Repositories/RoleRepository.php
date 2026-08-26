<?php

declare(strict_types=1);

namespace App\Repositories;

use CodeIgniter\Database\BaseConnection;
use Config\Database;

class RoleRepository
{
    protected BaseConnection $db;

    private $_tableName = 'roles';

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
     *
     * В текущей архитектуре предполагается,
     * что пользователю назначена одна основная роль.
     */
    public function getUserRole(int $userId): ?array
    {
        return $this->db
            ->table($this->_tableName . ' r')
            ->select('r.*')
            ->join(
                'roles_users ru',
                'ru.role_id = r.id'
            )
            ->where('ru.user_id', $userId)
            ->get()
            ->getRowArray() ?: null;
    }

    /**
     * Получить ID роли пользователя.
     */
    public function getUserRoleId(int $userId): ?int
    {
        $role = $this->getUserRole($userId);

        return $role !== null
            ? (int) $role['id']
            : null;
    }

    public function getManageableRoles(string ...$excludedRoles): array
    {
        return $this->db
            ->table($this->_tableName)
            ->whereNotIn('name', $excludedRoles)
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultObject();
    }

    /**
     * Получить все роли.
     */
    public function findAll() : array
    {
        return $this->db
            ->table($this->_tableName)
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultObject();
            // ->getResultArray();
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
    public function update(
        int $roleId,
        array $data
    ): bool {
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

    /**
     * Назначить роль пользователю.
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
     * Удалить роль у пользователя.
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
