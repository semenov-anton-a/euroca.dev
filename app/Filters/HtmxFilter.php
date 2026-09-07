<?php

declare(strict_types=1);

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class HtmxFilter implements FilterInterface
{
    public function before( RequestInterface $request, $arguments = null )
    {
        log_message('debug', 'CSRF HEADER: ' . $request->getHeaderLine('X-CSRF-TOKEN'));
        // log_message('debug', 'CSRF COOKIE: ' . ($request->getCookie(config('Security')->cookieName) ?? 'NONE'));

        return null;
    }

    public function after( RequestInterface $request, ResponseInterface $response, $arguments = null ): void 
    {
        if ($request->getHeaderLine('HX-Request') !== 'true') 
        {
            return;
        }
        $token = csrf_hash();
        
        // log_message('debug', 'CSRF RESPONSE TOKEN: ' . $token);

        $response->setHeader('X-CSRF-TOKEN', $token);
    }
}