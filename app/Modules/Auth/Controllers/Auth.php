<?php

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use CodeIgniter\Controller;

/**
 * Authentication controller.
 * Handles login, logout, and registration pages.
 */
class Auth extends Controller
{
    /**
     * Show login page.
     */
    public function login(): string
    {
        return view('login');
    }

    /**
     * Handle login form submission.
     */
    public function authenticate(): void
    {
        // To be implemented
    }

    /**
     * Show registration page.
     */
    public function register(): string
    {
        return view('register');
    }

    /**
     * Handle registration form submission.
     */
    public function create(): void
    {
        // To be implemented
    }

    /**
     * Logout user.
     */
    public function logout(): Response
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}