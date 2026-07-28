<?php

namespace App\Repositories;

use CodeIgniter\Database\BaseConnection;
use Config\Database;

class UserRepository
{
    protected BaseConnection $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Найти пользователя по ID
     */
    public function findById(int $userId): ?array
    {
        return $this->db
            ->table('users')
            ->where('id', $userId)
            ->get()
            ->getRowArray() ?: null;
    }

    /**
     * Найти пользователя по Email
     */
    public function findByEmail(string $email): ?array
    {
        return $this->db
            ->table('users')
            ->where('email', $email)
            ->get()
            ->getRowArray() ?: null;
    }

    /**
     * Создать пользователя
     */
    public function create(array $data): int
    {
        $this->db
            ->table('users')
            ->insert($data);

        return (int) $this->db->insertID();
    }

    /**
     * Обновить пользователя
     */
    public function update(int $userId, array $data): bool
    {
        return $this->db
            ->table('users')
            ->where('id', $userId)
            ->update($data);
    }

    /**
     * Удалить пользователя
     */
    public function delete(int $userId): bool
    {
        return $this->db
            ->table('users')
            ->where('id', $userId)
            ->delete();
    }
}