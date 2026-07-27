<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Input normalizer for user data.
 * Provides methods to normalize and sanitize input data.
 */
class InputNormalizer
{
    /**
     * Normalize email address.
     * Converts to lowercase and trims whitespace.
     */
    public static function normalizeEmail(string $email): string
    {
        return strtolower(trim($email));
    }

    /**
     * Normalize phone number.
     * Removes all non-digit characters.
     */
    public static function normalizePhone(string $phone): string
    {
        return preg_replace('/[^0-9]/', '', $phone);
    }

    /**
     * Normalize name.
     * Trims whitespace and capitalizes first letter of each word.
     */
    public static function normalizeName(string $name): string
    {
        return ucwords(strtolower(trim($name)));
    }

    /**
     * Normalize company name.
     * Trims whitespace and normalizes special characters.
     */
    public static function normalizeCompanyName(string $name): string
    {
        $name = trim($name);
        return preg_replace('/\s+/', ' ', $name);
    }
}