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

    public function existsByNameAndBirthday(
        string $firstName,
        string $lastName,
        ?string $birthday
    ): bool {
        $builder = $this->employeeModel
            ->where('first_name', $firstName)
            ->where('last_name', $lastName);

        if ($birthday === null) {
            $builder->where('birthday IS NULL', null, false);
        } else {
            $builder->where('birthday', $birthday);
        }

        return $builder->countAllResults() > 0;
    }
}