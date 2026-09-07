<?php

declare(strict_types=1);

namespace App\Modules\Accounting\Ver1\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use CodeIgniter\Exceptions\PageNotFoundException;

use App\Controllers\BaseController;

abstract class BaseAccounting extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void 
    {
        parent::initController($request, $response, $logger);

        $userId = $this->authService->currentUserId();

        if (!$this->roleService->isSuperAdmin($userId)) 
        {
             throw PageNotFoundException::forPageNotFound();
        }
    }

}