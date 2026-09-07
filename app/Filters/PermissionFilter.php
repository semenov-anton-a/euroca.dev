<?php

declare(strict_types=1);

namespace App\Filters;

use App\Services\Auth\PermissionService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PermissionFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ): ?ResponseInterface {

        // Какое permission требуется маршруту
        $requiredPermission = $arguments[0] ?? null;

        // Если permission не указан
        if ($requiredPermission === null) {
            return null;
        }

        // Получаем текущего пользователя
        $userId = auth()->id();

        // Пользователь не авторизован
        if ($userId === null) {
            return redirect()->to('/login');
        }

        // Проверяем permission
        $permissionService = service(PermissionService::class);

        if (!$permissionService->can(
            $userId,
            $requiredPermission
        )) {
            return redirect()
                ->to('/')
                ->with('error', 'Access denied');
        }

        return null;
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ): ?ResponseInterface {
        return null;
    }
}