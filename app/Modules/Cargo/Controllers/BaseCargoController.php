<?php

declare(strict_types=1);

namespace App\Modules\Cargo\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

abstract class BaseCargoController extends BaseController
{  
    public function __construct()
    {      
        // Инициализация необходимых сервисов или зависимостей
    }
}