<?php
declare(strict_types=1);

namespace App\Services\Modules;

use CodeIgniter\Validation\ValidationInterface;
use App\Modules\Users\Services\UserService;
use App\Modules\Employees\Enums\RulesRegex;
use App\Modules\Employees\Services\EmployeeService;
use App\Modules\Employees\Services\EmployeeDocumentService;
use App\Services\FileService;

class EmployeeUserService
{
    protected ValidationInterface $validation;
    protected FileService $fileService;

    public function __construct(
        protected EmployeeService $employeeService,
        protected EmployeeDocumentService $employeeDocumentService,
        protected UserService $userService,
    ) {
        $this->validation = service('validation');
        $this->fileService = service('fileService');
    }

    public function create(array $data, array $files = []): array
    {
        $data = $this->normalizeInput($data);

        if ($errors = $this->validateData($data, $files)) 
        {
            return ['success' => false, 'errors' => $errors];
        }

        [ $employeeData, $userData ] = $this->splitData($data);

        return $this->transaction( function () use ($employeeData, $userData, $files) 
        {
            $employeeId = $this->employeeService->create($employeeData);

            if (!empty($userData['enable_access'])) {
                $userData['employee_id'] = $employeeId;
                $this->userService->create($userData);
            }

            $savedFiles = $this->saveDocuments($employeeId, $files);

            return [
                'employee_id' => $employeeId,
                'files' => $savedFiles,
            ];
        }, 'Unable to create employee.');
    }

    public function update(int $employeeId, array $data, array $files = []): array
    {
        $data = $this->normalizeInput($data);

        if ($errors = $this->validateData($data, $files)) {
            return ['success' => false, 'errors' => $errors];
        }

        $employee = $this->employeeService->findById($employeeId);

        if ($employee === null) {
            return [
                'success' => false,
                'errors' => ['employee' => 'Employee not found.'],
            ];
        }

        $user = $this->userService->findByEmployeeId($employeeId);
        [$employeeData, $userData] = $this->splitData($data);

        return $this->transaction(function () use (
            $employeeId,
            $employeeData,
            $userData,
            $user,
            $files
        ) {
            $this->employeeService->update($employeeId, $employeeData);

            $this->updateUser(
                $employeeId,
                $user,
                $userData
            );

            $savedFiles = $this->saveDocuments($employeeId, $files);

            return [
                'employee_id' => $employeeId,
                'files' => $savedFiles,
            ];
        }, 'Unable to update employee.');
    }

    protected function splitData(array $data): array
    {
        $employeeData = [
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'position' => $data['position'] ?? null,
            'birthday' => $data['birthday'] ?? null,
            'status' => $data['status'] ?? 'active',
            'note' => $data['note'] ?? null,
        ];

        $userData = [
            'enable_access' => !empty($data['enable_access']),
            'username' => $data['username'] ?? null,
            'password' => $data['password'] ?? null,
            'role_id' => $data['role_id'] ?? null,
        ];

        return [$employeeData, $userData];
    }

    protected function updateUser( int $employeeId, ?object $user, array $data ): void 
    {        
        if ($data['enable_access']) 
        {
            $userData = [
                'username' => $data['username'],
                'role_id' => $data['role_id'],
                'status' => 'active',
            ];

            if (!empty($data['password'])) 
            {
                $userData['password'] = $data['password'];
            }

            if ($user !== null) 
            {
                $this->userService->update($user->id, $userData);
            } else {
                $userData['employee_id'] = $employeeId;
                $this->userService->create($userData);
            }

            return;
        }

        if ($user !== null) 
        {
            $this->userService->update(
                $user->id, [ 'status' => 'inactive', ] );
        }
    }

    protected function saveDocuments(int $employeeId, array $files): array
    {
        if ($files === []) {
            return [];
        }

        $directory = 'employees/' . $employeeId;
        $savedFiles = $this->fileService->save($files, $directory);

        foreach ($savedFiles as $file) {
            $this->employeeDocumentService->create([
                'employee_id' => $employeeId,
                'document_type' => 'document',
                'title' => $file['original_name'],
                'file_name' => $file['filename'],
                'file_path' => $directory . '/' . $file['filename'],
                'mime_type' => $file['mime_type'],
                'file_size' => $file['size'],
            ]);
        }

        return $savedFiles;
    }

    protected function transaction(callable $callback, string $errorMessage): array
    {
        $db = db_connect();
        $savedFiles = [];

        try {
            $db->transBegin();

            $result = $callback();

            $savedFiles = $result['files'] ?? [];

            if ($db->transStatus() === false) 
            {
                throw new \RuntimeException($errorMessage);
            }

            $db->transCommit();

            return [
                'success' => true,
                ...$result,
            ];
        } catch (\Throwable $e) {
            $db->transRollback();

            if ($savedFiles !== []) {
                $employeeId = $result['employee_id'] ?? null;

                if ($employeeId !== null) {
                    $this->fileService->delete(
                        $savedFiles,
                        'employees/' . $employeeId
                    );
                }
            }

            throw $e;
        }
    }

    protected function validateData(array $data, array $files = []): array
    {
        $errors = $this->validate($data);

        if ($errors !== []) {
            return $errors;
        }

        return $this->fileService->validate($files);
    }

    protected function validate(array $data): array
    {
        $rules = [
            'first_name' => [
                'rules' => 'required|max_length[100]|regex_match[' . RulesRegex::Name->value . ']',
                'errors' => [
                    'required' => 'First name is required.',
                    'regex_match' => 'First name contains invalid characters.',
                ],
            ],
            'last_name' => [
                'rules' => 'required|max_length[100]|regex_match[' . RulesRegex::Name->value . ']',
                'errors' => [
                    'required' => 'Last name is required.',
                    'regex_match' => 'Last name contains invalid characters.',
                ],
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email|max_length[255]',
            ],
            'phone' => [
                'rules' => 'permit_empty|regex_match[' . RulesRegex::Phone->value . ']',
            ],
            'position' => [
                'rules' => 'permit_empty|max_length[100]',
            ],
            'birthday' => [
                'rules' => 'required|valid_date[Y-m-d]',
            ],
            'note' => [
                'rules' => 'permit_empty|max_length[5000]',
            ],
        ];

        $this->validation->setRules($rules);

        if ($this->validation->run($data)) {
            return [];
        }

        return $this->validation->getErrors();
    }

    protected function normalizeInput(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = trim(stripslashes($value));
            }
        }

        return $data;
    }
}
