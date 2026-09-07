<?php

declare(strict_types=1);

namespace App\Modules\Employees\Entities;

use CodeIgniter\Entity\Entity;

class EmployeeDocument extends Entity
{
    protected $datamap = [];

    protected $casts = [
        'id' => 'integer',
        'employee_id' => 'integer',
        'file_size' => '?integer',
    ];
}