<?php

declare(strict_types=1);

namespace App\Modules\Settings\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use CodeIgniter\Exceptions\PageNotFoundException;

use App\Controllers\BaseController;

abstract class BaseSettingsController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void 
    {
        parent::initController($request, $response, $logger);

        $userId = $this->userService->currentUserId();

        if (!$this->roleService->isSuperAdmin($userId)) 
        {
             throw PageNotFoundException::forPageNotFound();
        }
    }
}