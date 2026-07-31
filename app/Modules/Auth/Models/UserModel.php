<?php

declare(strict_types=1);

namespace App\Modules\Auth\Models;

use CodeIgniter\Model;

/**
 * User model.
 *
 * Handles only user table operations.
 */
class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $useSoftDeletes = true;
    

    protected $dateFormat = 'datetime';


    protected $allowedFields = [
        'email',
        'username',
        'password_hash',
        'first_name',
        'last_name',
        'phone',
        'status',
        'deleted_at',
    ];


    /**
     * Hash password before insert.
     */
    protected $beforeInsert = [
        'hashPassword',
    ];


    /**
     * Hash password before update.
     */
    protected $beforeUpdate = [
        'hashPassword',
    ];


    /**
     * Hash password if it is plain text.
     */
    protected function hashPassword(array $data): array
    {
        if (
            isset($data['data']['password_hash'])
            && !empty($data['data']['password_hash'])
        ) {

            $password = $data['data']['password_hash'];


            // Check if password is already hashed
            if (
                password_get_info($password)['algo'] === 0
            ) {
                $data['data']['password_hash'] =
                    password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    );
            }
        }

        return $data;
    }
}