<?php

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use App\Controllers\BaseController;
use App\Modules\Auth\Models\UserModel;


abstract class BaseAuthController extends BaseController
{  
    protected UserModel $userModel; 

    public function __construct()
    {
        // Инициализация необходимых сервисов или зависимостей
        $this->userModel = new UserModel();
        
    }
}