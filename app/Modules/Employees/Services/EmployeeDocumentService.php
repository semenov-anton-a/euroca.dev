<?php

declare(strict_types=1);

namespace App\Modules\Employees\Services;

use App\Modules\Employees\Entities\EmployeeDocument;
use App\Modules\Employees\Repositories\EmployeeDocumentRepository;

class EmployeeDocumentService
{
    public function __construct(
        protected EmployeeDocumentRepository $repository
    ) {}

    public function findById(int $id): ?EmployeeDocument
    {
        return $this->repository->findById($id);
    }

    public function findByEmployeeId(int $employeeId): array
    {
        return $this->repository->findByEmployeeId($employeeId);
    }

    public function create(array $data): int
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}