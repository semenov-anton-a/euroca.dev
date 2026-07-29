<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use CodeIgniter\Database\BaseConnection;
// use RuntimeException;

class AuthService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected RoleRepository $roleRepository,
        protected BaseConnection $db
    ) {

    }   

    



}
