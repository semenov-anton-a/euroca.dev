<?php

declare(strict_types=1);

namespace App\Modules\Employees\Repositories;

use App\Modules\Employees\Entities\Employee;
use App\Modules\Employees\Models\EmployeeModel;

class EmployeeRepository
{
    public function __construct(
        protected EmployeeModel $model
    ) {}

    public function paginate(int $perPage = 20): array
    {
        return $this->model
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
    }

    public function pager()
    {
        return $this->model->pager;
    }

    public function findById(int $id): ?Employee
    {
        return $this->model->find($id);
    }

    public function findByUserId(int $userId): ?Employee
    {
        return $this->model
            ->where('user_id', $userId)
            ->first();
    }

    public function findAll(): array
    {
        return $this->model
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    public function findActive(): array
    {
        return $this->model
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    public function create(array $data): int
    {
        return $this->model->insert($data, true);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    public function existsByUserId(int $userId): bool
    {
        return $this->model
            ->where('user_id', $userId)
            ->countAllResults() > 0;
    }
}