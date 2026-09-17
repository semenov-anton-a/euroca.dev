<?php

namespace App\Modules\Employees\Entities;

use CodeIgniter\Entity\Entity;

class EmployeeDocument extends Entity
{
    protected $attributes = [
        'id' => null,
        'employee_id' => null,
        'document_type' => null,
        'document_number' => null,
        'title' => null,
        'file_name' => null,
        'file_path' => null,
        'mime_type' => null,
        'file_size' => null,
        'issued_at' => null,
        'expires_at' => null,
        'note' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];

    protected $dates = [
        'issued_at',
        'expires_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id' => 'int',
        'employee_id' => 'int',
        'file_size' => '?int',
    ];
}
