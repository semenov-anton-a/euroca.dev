<?php

declare(strict_types=1);

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * Permission filter for route access control.
 * Checks if the authenticated user has required permissions.
 */
class PermissionFilter implements FilterInterface
{
    /**
     * List of permissions for each route.
     * These are hardcoded for now, will be moved to database later.
     */
    protected array $routePermissions = [
        'cargo' => ['cargo.view', 'cargo.edit', 'cargo.delete'],
        'customers' => ['customer.view', 'customer.edit', 'customer.delete'],
        'accounting' => ['accounting.view', 'accounting.edit'],
        'settings' => ['settings.view', 'settings.edit'],
        'employees' => ['employees.view', 'employees.edit'],
        'documents' => ['documents.view', 'documents.edit'],
        'warehouse' => ['warehouse.view', 'warehouse.edit'],
    ];

    /**
     * Check if user has required permission.
     */
    public function before(RequestInterface $request, $arguments = null): ?ResponseInterface
    {
        $requiredPermission = $arguments[0] ?? null;
        $userPermissions = session()->get('permissions') ?? [];

        if ($requiredPermission && !in_array($requiredPermission, $userPermissions, true)) {
            return redirect()->to('/')->with('error', 'Access denied');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): ?ResponseInterface
    {
        return null;
    }
}