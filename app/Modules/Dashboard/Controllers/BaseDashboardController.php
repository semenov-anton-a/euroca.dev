<?php

declare(strict_types=1);

namespace App\Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

abstract class BaseDashboardController extends BaseController
{  
    public function __construct()
    {      
        // Инициализация необходимых сервисов или зависимостей
    }
}