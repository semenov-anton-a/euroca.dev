<?php

declare(strict_types=1);

namespace App\Modules\Employees\Models;

use CodeIgniter\Model;
use App\Modules\Employees\Entities\EmployeeDocument;

class EmployeeDocumentModel extends Model
{
    protected $table = 'employee_documents';
    protected $primaryKey = 'id';
    protected $returnType = EmployeeDocument::class;

    protected $allowedFields = [
        'employee_id',
        'document_type',
        'document_name',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}