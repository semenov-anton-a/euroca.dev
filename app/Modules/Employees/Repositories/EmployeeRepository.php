<?php

namespace App\Modules\Employees\Repositories;

use App\Modules\Employees\Models\EmployeeModel;
use App\Modules\Employees\Entities\Employee;

class EmployeeRepository
{
    public function __construct(
        protected EmployeeModel $model = new EmployeeModel()
    ) {}

    public function find(int $id): ?Employee
    {
        return $this->model->find($id);
    }

    public function findByUserId(int $userId): ?Employee
    {
        return $this->model
            ->where('user_id', $userId)
            ->first();
    }

    public function all(): array
    {
        return $this->model->findAll();
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
}