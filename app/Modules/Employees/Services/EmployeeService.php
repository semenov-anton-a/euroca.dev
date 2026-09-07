<?php

declare(strict_types=1);

namespace App\Modules\Employees\Services;

use App\Modules\Employees\Entities\Employee;
use App\Modules\Employees\Repositories\EmployeeRepository;

/** Auth ENUM */
use App\Modules\Auth\Enums\UserStatus;

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
            'pager'     => $this->employeeRepository->pager(),
        ];
    }

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
        $hasAccess = !empty( $data['enable_access'] );

        $password = $hasAccess
            ? $data['password']
            : bin2hex(random_bytes(16));

        $userId = $this->userService->create([
            'role_id'       => $data['role_id'],
            'email'         => $data['email'],
            'username'      => $data['username'],
            'password_hash' => $password,
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'phone'         => $data['phone'] ?? null,
            'status' => $hasAccess
                ? UserStatus::Active->value
                : UserStatus::Banned->value,
        ]);

        return $this->employeeRepository->create([
            'user_id' => $userId,
            'position' => $data['position'] ?? null,
            'hire_date' => $data['hire_date'] ?? null,
            'status' => 'active',
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

    public function existsByUserId(int $userId): bool
    {
        return $this->employeeRepository->existsByUserId($userId);
    }
}