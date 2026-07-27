<?php

declare(strict_types=1);

namespace App\Modules\Auth\Config;

/**
 * Authentication module configuration.
 */
class AuthConfig
{
    /**
     * Session lifetime in minutes.
     */
    public int $sessionLifetime = 120;

    /**
     * Password minimum length.
     */
    public int $passwordMinLength = 8;

    /**
     * Password maximum length.
     */
    public int $passwordMaxLength = 255;

    /**
     * Enable password hashing.
     */
    public bool $hashPasswords = true;

    /**
     * Default role for new users.
     */
    public int $defaultRoleId = 1;
}