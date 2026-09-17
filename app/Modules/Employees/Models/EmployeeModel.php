<?php

declare(strict_types=1);

namespace App\Modules\Employees\Models;

use App\Modules\Employees\Entities\Employee;
use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $returnType = Employee::class;

    protected $allowedFields = [
        'first_name',
        'last_name',
        'birthday',
        'email',
        'phone',
        'position',
        'status',
        'note',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function pager()
    {
        return $this->pager;
    }
}