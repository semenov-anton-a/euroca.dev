<?php

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;



/**
 * Authentication controller.
 * Handles login, logout, and registration pages.
 */
class Auth extends BaseAuthController
{    
    /**
     * GET Method
     * Show login page. 
     */
    public function login(): string
    {       
        return $this->viewModule('login');
    }

    /**
     * POST Method
     * Handle login form submission.
     */
    public function authenticate(): string
    {
        return lang('Auth.login_error');


        return $this->response
            ->setHeader('HX-Redirect', '/cargo')
            ->setStatusCode(200);


        $email =    $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        $user = $this->userProvider->authenticate($email, $password);

        if (!$user) {
            return redirect()
                    ->to('/')
                    ->with('error', 'Invalid email or password');
        }

       

        // Set session data
        session()->set([
            'user_id' => $user['id'],
            'user_email' => $user['email'],
            'user_name' => $user['first_name'] . ' ' . $user['last_name'],
            'role_id' => $user['role_id'],
            'permissions' => $user['permissions'],
            'logged_in' => true,
        ]);

        if ($remember) {
            session()->setExpiration(2880); // 48 hours
        }
        
        return redirect()
            ->to('/cargo')
            ->with('success', 'Login successful');
    }

    /**
     * Show registration page.
     */
    public function register(): string
    {
        echo 1;
        die;
        return view('register');
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