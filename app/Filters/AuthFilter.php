<?php

declare(strict_types=1);

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * Authentication filter.
 * Protects routes that require user authentication.
 */
class AuthFilter implements FilterInterface
{
    /**
     * Checks if user is authenticated.
     * If not, redirects to login page.
     */
    public function before(RequestInterface $request, $arguments = null): ?ResponseInterface
    {
        if (!session()->has('user_id')) 
        {
            return redirect()->to('/');
        }
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): ?ResponseInterface
    {
        return null;
    }
}