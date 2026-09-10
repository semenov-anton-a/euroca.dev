<?php

declare(strict_types=1);

namespace App\Modules\Employees\Services;

use App\Modules\Auth\Enums\UserStatus;
use App\Modules\Employees\Entities\Employee;
use App\Modules\Employees\Repositories\EmployeeRepository;
// use App\Modules\Employees\Models\EmployeeModel as EmployeeModel;

use App\Modules\Users\Services\UserService;

class EmployeeService
{
    public function __construct(
        protected EmployeeRepository $employeeRepository,
        protected UserService $userService,
        // protected EmployeeModel $employeeModel
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
        if ( 
            $this->employeeRepository
                ->existsByNameAndBirthday(
                    $data['first_name'], $data['last_name'], $data['birthday']) 
        )
        {
            return throw new \RuntimeException( 'Employee.employee_username_birtday_exist' );
        }
        
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $userId = $this->userService->create([
                'role_id' => $data['role_id'],
                'username' => $data['username'],
                'email' => trim($data['email'] ?? '') ?: null,
                'first_name' => trim($data['first_name']),
                'last_name' => trim($data['last_name']),
                'phone' => trim($data['phone'] ?? '') ?: null,
                'status' => ( (int) $data['role_id'] === 0 ) ? UserStatus::Banned->value : UserStatus::Active->value
            ]);

            $employeeId = $this->employeeRepository->create([
                'user_id' => $userId,
                'birthday' => $data['birthday'],
                'position' => $data['position'] ?? '',
                'note' => $data['note'] ?? null,
            ]);

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

    public function existsByUserId(int $userId): bool
    {
        return $this->employeeRepository->existsByUserId($userId);
    }
}