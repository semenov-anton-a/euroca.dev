<?php

namespace App\Modules\Employees\Models;

use App\Modules\Employees\Entities\EmployeeDocument;
use CodeIgniter\Model;

class EmployeeDocumentModel extends Model
{
    protected $table = 'employee_documents';
    protected $primaryKey = 'id';
    protected $returnType = EmployeeDocument::class;

    protected $allowedFields = [
        'employee_id',
        'document_type',
        'document_number',
        'title',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'issued_at',
        'expires_at',
        'note',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
