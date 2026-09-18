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

        $errors = $this->validate($data);

        if ($errors !== []) 
        {
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        $fileErrors = $this->fileService->validate($files);

        if ($fileErrors !== []) 
        {
            return [
                'success' => false,
                'errors' => $fileErrors,
            ];
        }

        $db = db_connect();

        $employeeID = null;
        $savedFiles = [];
        $directory = '';

        try {
            $db->transBegin();

            $employeeID = $this->employeeService->create($data);

            if (!empty($data['enable_access'])) {
                $data['employee_id'] = $employeeID;
                $this->userService->create($data);
            }

            if ($files !== []) 
            {
                $directory = 'employees/' . $employeeID;
                $savedFiles = $this->fileService->save($files, $directory);

                foreach ($savedFiles as $file) 
                {
                    $this->employeeDocumentService->create([
                        'employee_id' => $employeeID,
                        'document_type' => 'document',
                        'title' => $file['original_name'],
                        'file_name' => $file['filename'],
                        'file_path' => $directory . '/' . $file['filename'],
                        'mime_type' => $file['mime_type'],
                        'file_size' => $file['size'],
                    ]);
                }
            }

            if ($db->transStatus() === false) 
            {
                throw new \RuntimeException('Unable to create employee.');
            }

            $db->transCommit();

            return [
                'success' => true,
                'employee_id' => $employeeID,
                'files' => $savedFiles,
            ];
        } catch (\Throwable $e) {
            $db->transRollback();

            if ($savedFiles !== []) 
            {
                $this->fileService->delete($savedFiles, $directory);
            }

            throw $e;
        }
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
                'rules' => 'max_length[100]',
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
