<?php

declare(strict_types=1);

namespace App\Modules\Employees\Services;

use App\Modules\Employees\Entities\Employee;
use App\Modules\Employees\Repositories\EmployeeRepository;
use App\Modules\Users\Services\UserService;

class EmployeeService
{
    public function __construct(
        protected EmployeeRepository $employeeRepository,
        protected UserService $userService
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
                'Employee.employee_name_birthday_exist'
            );
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $employeeId = $this->employeeRepository->create([
                'first_name' => trim($data['first_name']),
                'last_name' => trim($data['last_name']),
                'birthday' => $data['birthday'] ?? null,
                'email' => trim($data['email'] ?? '') ?: null,
                'phone' => trim($data['phone'] ?? '') ?: null,
                'position' => trim($data['position'] ?? '') ?: null,
                'hire_date' => $data['hire_date'] ?? null,
                'status' => $data['status'] ?? 'active',
                'note' => $data['note'] ?? null,
            ]);

            if (!$employeeId) {
                throw new \RuntimeException('Failed to create employee.');
            }

            if (!empty($data['username'])) {
                $this->userService->create([
                    'employee_id' => $employeeId,
                    'customer_id' => null,
                    'role_id' => (int) $data['role_id'],
                    'username' => trim($data['username']),
                    'password_hash' => $data['password_hash'],
                    'status' => $data['user_status'] ?? 'active',
                    'locale' => $data['locale'] ?? 'en',
                ]);
            }

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Failed to create employee.');
            }

            $db->transCommit();

            return $employeeId;
        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }

    public function update(int $id, array $data): bool
    {
        return $this->employeeRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->employeeRepository->delete($id);
    }

    
}