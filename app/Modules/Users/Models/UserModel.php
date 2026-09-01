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
        'role_id', 
        'email', 
        'username', 
        'password_hash', 
        'first_name', 
        'last_name', 
        'phone', 
        'status', 
        'deleted_at', 
        'created_at', 
        'updated_at' 
    ];

    protected $beforeInsert = [
        'hashPassword',
    ];

    protected $beforeUpdate = [
        'hashPassword',
    ];

    protected function hashPassword(array $data): array
    {
        if (
            isset($data['data']['password_hash'])
            && !empty($data['data']['password_hash'])
        ) {
            $password = $data['data']['password_hash'];

            if (password_get_info($password)['algo'] === 0) {
                $data['data']['password_hash'] = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );
            }
        }

        return $data;
    }
}