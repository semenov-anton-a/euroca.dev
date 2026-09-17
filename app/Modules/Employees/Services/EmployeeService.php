<?php

declare(strict_types=1);

namespace App\Modules\Employees\Services;

use App\Modules\Employees\Entities\Employee;
use App\Modules\Employees\Repositories\EmployeeRepository;
use App\Modules\Users\Services\UserService;

class EmployeeService
{
    public function __construct(
        protected EmployeeRepository $employeeRepository
    ) {}

    public function paginate(int $perPage = 20): array
    {
        return $this->employeeRepository->paginate($perPage);
    }

    public function getPaginated(int $perPage = 20): array
    {
        return [
            'employees' => $this->employeeRepository->paginate($perPage),
            'pager' => $this->employeeRepository->pager(),
        ];
    }

    public function findById(int $id): ?Employee
    {
        return $this->employeeRepository->findById($id);
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
        if ($this->employeeRepository->existsByNameAndBirthday(
            $data['first_name'],
            $data['last_name'],
            $data['birthday'] ?? null
        )) {
            throw new \RuntimeException(
                lang('Employee.employee_name_birthday_exist')
            );
        }

        return $this->employeeRepository->create([
            'first_name' => trim($data['first_name']),
            'last_name' => trim($data['last_name']),
            'birthday' => $data['birthday'] ?? null,
            'email' => trim($data['email'] ?? '') ?: null,
            'phone' => trim($data['phone'] ?? '') ?: null,
            'position' => trim($data['position'] ?? '') ?: null,
            'status' => $data['status'] ?? 'active',
            'note' => $data['note'] ?? null,
        ]);
    }

    public function update(int $id, array $data): bool
    {
        return $this->employeeRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->employeeRepository->delete($id);
    }

    public function getPaginatedWithUsers(int $perPage = 20): array
    {
        return [
            'employees' => $this->employeeRepository->paginateWithUsers($perPage),
            'pager' => $this->employeeRepository->pager(),
        ];
    }
}