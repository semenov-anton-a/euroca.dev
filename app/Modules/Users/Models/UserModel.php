<?php

declare(strict_types=1);

namespace App\Modules\Users\Models;

use App\Modules\Users\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = User::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = true;

    protected $dateFormat = 'datetime';

    protected $allowedFields = [
        'employee_id',
        'customer_id',
        'username',
        'password',
        'password_hash',
        'role_id',
        'status',
        'failed_login_count',
        'locked_until',
        'locale',
        'last_login_at',
        'last_login_ip',
        'password_changed_at',
    ];

    protected $beforeInsert = [
        'hashPassword',
    ];

    protected $beforeUpdate = [
        'hashPassword',
    ];

    protected function hashPassword(array $data): array
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password_hash'] = password_hash(
                $data['data']['password'],
                PASSWORD_DEFAULT
            );

            unset($data['data']['password']);
        }

        return $data;
    }
}