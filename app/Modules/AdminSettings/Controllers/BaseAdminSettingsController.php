<?php

declare(strict_types=1);

namespace App\Modules\AdminSettings\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use CodeIgniter\Exceptions\PageNotFoundException;

use App\Controllers\BaseController;
use App\Modules\Auth\Enums\UserRole;

abstract class BaseAdminSettingsController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void 
    {
        parent::initController($request, $response, $logger);

        $userId = (int) session()->get('user_id');

        if ($userId === 0) {
            throw PageNotFoundException::forPageNotFound();
        }

        $roleKey = $this->roleService->getUserRoleKey($userId);

        if ($roleKey !== UserRole::SuperAdmin->value) {
            throw PageNotFoundException::forPageNotFound();
        }
    }
}