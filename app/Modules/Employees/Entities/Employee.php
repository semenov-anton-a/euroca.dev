<?php

namespace App\Modules\Employees\Entities;

use CodeIgniter\Entity\Entity;

class Employee extends Entity
{
    protected $datamap = [];

    protected $casts = [
        'id' => 'integer',
        'user_id' => '?integer',
        'hire_date' => 'date',
        'termination_date' => '?date',
    ];
}