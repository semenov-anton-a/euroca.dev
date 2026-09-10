<?php

declare(strict_types=1);

namespace App\Modules\Employees\Entities;

use CodeIgniter\Entity\Entity;

class Employee extends Entity
{
    protected $datamap = [];

    protected $casts = [
        'id' => 'integer',        
    ];

    public function getFullName(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }


}

