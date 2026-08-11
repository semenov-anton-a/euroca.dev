<?php

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use CodeIgniter\HTTP\ResponseInterface;


/**
 * Authentication controller.
 * Handles login, logout, and registration pages.
 * return lang('Auth.login_error');
 */
class Auth extends BaseAuthController
{    
    /**
     * GET Method
     * Show login page. 
     */
    public function login(): ResponseInterface|string
    {   
        if( $this->userService->isLoggedIn() ) 
        {
            return redirect()->to('/dashboard');
        }

        return $this->viewModule('login');
    }

    /**
     * POST Method
     * Handle login form submission.
     */
    public function authenticate(): ResponseInterface|string
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        if (! $this->userService->login( $email, $password, $remember )) 
        {
            return $this->response
                ->setStatusCode(200)
                ->setBody(lang('Auth.error_login'));
        }

        return $this->response
            ->setHeader('HX-Redirect', '/dashboard')
            ->setStatusCode(200);
    }


    /**
     * Handle registration form submission.
     */
    public function create(): ResponseInterface
    {
        // To be implemented
        return redirect()->to('/register');
    }

    /**
     * Logout user.
     */
    public function logout(): ResponseInterface
    {
        session()->destroy();
        return redirect()->to('/');
    }
}