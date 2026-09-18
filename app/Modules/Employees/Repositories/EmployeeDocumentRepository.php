<?php

namespace App\Modules\Employees\Repositories;

use App\Modules\Employees\Entities\EmployeeDocument;
use App\Modules\Employees\Models\EmployeeDocumentModel;

class EmployeeDocumentRepository
{
    public function __construct(
        protected EmployeeDocumentModel $documentModel
    ) {}

    public function findById(int $id): ?EmployeeDocument
    {
        return $this->documentModel->find($id);
    }

    public function findByEmployeeId(int $employeeId): array
    {
        return $this->documentModel
            ->where('employee_id', $employeeId)
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    public function findByFileName(string $fileName): ?EmployeeDocument 
    { 
        return $this->documentModel 
            ->where('file_name', $fileName) 
            ->first(); 
    }

    public function create(array $data): int
    {
        return $this->documentModel->insert($data, true);
    }

    public function update(int $id, array $data): bool
    {
        return $this->documentModel->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->documentModel->delete($id);
    }
}