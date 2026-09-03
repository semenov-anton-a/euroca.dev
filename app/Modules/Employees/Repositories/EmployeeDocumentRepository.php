<?php

declare(strict_types=1);

namespace App\Modules\Employees\Repositories;

use App\Modules\Employees\Entities\EmployeeDocument;
use App\Modules\Employees\Models\EmployeeDocumentModel;

class EmployeeDocumentRepository
{
    public function __construct(
        protected EmployeeDocumentModel $model
    ) {}

    public function findById(int $id): ?EmployeeDocument
    {
        return $this->model->find($id);
    }

    public function findByEmployeeId(int $employeeId): array
    {
        return $this->model
            ->where('employee_id', $employeeId)
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
}