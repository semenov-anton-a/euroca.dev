<?php

declare(strict_types=1);

namespace App\Modules\Employees\Services;

use App\Modules\Employees\Entities\Employee;
use App\Modules\Employees\Repositories\EmployeeRepository;

class EmployeeService
{
    public function __construct(
        protected EmployeeRepository $employeeRepository
    ) {}

    public function findById(int $id): ?Employee
    {
        return $this->employeeRepository->findById($id);
    }

    public function findByUserId(int $userId): ?Employee
    {
        return $this->employeeRepository->findByUserId($userId);
    }

    public function findAll(): array
    {
        return $this->employeeRepository->findAll();
    }

    public function findActive(): array
    {
        return $this->employeeRepository->findActive();
    }

    public function create(array $data): int
    {
        return $this->employeeRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->employeeRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->employeeRepository->delete($id);
    }

    public function existsByUserId(int $userId): bool
    {
        return $this->employeeRepository->existsByUserId($userId);
    }
}