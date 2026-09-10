<?php

declare(strict_types=1);

namespace App\Modules\Employees\Repositories;

use App\Modules\Employees\Entities\Employee;
use App\Modules\Employees\Models\EmployeeModel;

class EmployeeRepository
{
    public function __construct(
        protected EmployeeModel $employeeModel
    ) {}

    public function existsByNameAndBirthday(
        string $firstName,
        string $lastName,
        ?string $birthday
    ): bool
    {
        return $this->employeeModel
            ->join('users', 'users.id = employees.user_id')
            ->where('users.first_name', $firstName)
            ->where('users.last_name', $lastName)
            ->where('employees.birthday', $birthday)
            ->countAllResults() > 0;
    }

    public function paginate(int $perPage = 20): array
    {
        return $this->employeeModel
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
    }

    public function pager()
    {
        return $this->employeeModel->pager;
    }

    public function findById(int $id): ?Employee
    {
        return $this->employeeModel->find($id);
    }

    public function findByUserId(int $userId): ?Employee
    {
        return $this->employeeModel
            ->where('user_id', $userId)
            ->first();
    }

    public function findAll(): array
    {
        return $this->employeeModel
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    public function findActive(): array
    {
        return $this->employeeModel
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    public function create(array $data): int
    {
        return $this->employeeModel->insert($data, true);
    }

    public function update(int $id, array $data): bool
    {
        return $this->employeeModel->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->employeeModel->delete($id);
    }

    public function existsByUserId(int $userId): bool
    {
        return $this->employeeModel
            ->where('user_id', $userId)
            ->countAllResults() > 0;
    }
}