<?php

declare(strict_types=1);

namespace App\Modules\Employees\Models;

use CodeIgniter\Model;
use App\Modules\Employees\Entities\Employee;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $returnType = Employee::class;

    protected $allowedFields = [
        'user_id',
        'position',
        'hire_date',
        'termination_date',
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
        return $this->model->pager;
    }
}