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
    public function login(): string
    {       
        return $this->viewModule('login');
    }

    /**
     * POST Method
     * Handle login form submission.
     */
    public function authenticate(): ResponseInterface | string
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        // Проверяем пользователя в БД
        $user = $this->userModel->authenticate($email, $password);

        // Пользователь не найден или пароль неверный
        if ( ! $user ) 
        {
            return $this->response
                ->setStatusCode(401)
                ->setBody(
                    '<div class="alert alert-danger">
                        Неверный email или пароль
                    </div>'
                );
        }

        // Авторизация пользователя
        session()->set([
            'user_id'      => $user['id'],
            'user_email'   => $user['email'],
            'user_name'    => $user['first_name'] . ' ' . $user['last_name'],
            'role_id'      => $user['role_id'],
            'permissions'  => $user['permissions'],
            'logged_in'    => true,
        ]);

    // Remember Me
    // if ($remember) {
    //     session()->setExpiration(2880); // 48 часов
    // }

        // Перенаправляем HTMX после успешной авторизации
        return $this->response->setHeader('HX-Redirect', '/cargo')->setStatusCode(200);
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