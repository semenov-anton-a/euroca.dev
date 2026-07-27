<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Regular expression patterns for validation.
 * Centralized regex patterns for consistent validation across the application.
 */
class Regex
{
    /**
     * Phone number pattern.
     * Matches Russian phone numbers in various formats.
     */
    public const PHONE = '/^(\+7|8)?[\s\-]?\(?([0-9]{3})\)?[\s\-]?([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})$/';

    /**
     * Company name pattern.
     * Allows letters, numbers, spaces, and common punctuation.
     */
    public const COMPANY_NAME = '/^[a-zA-Z\u0400-\u04FF\u0400-\u04FF0-9\s\.\-\_]{2,100}$/u';

    /**
     * Car registration pattern.
     * Matches Russian car license plates (A123BC77 format).
     */
    public const CAR_REGISTRATION = '/^[A-Z]{1}[0-9]{3}[A-Z]{2}[0-9]{2,3}$/';

    /**
     * Email pattern.
     */
    public const EMAIL = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    /**
     * ICO (International Civil Aviation) code pattern.
     */
    public const ICAO_CODE = '/^[A-Z]{3}[0-9]$/';

    /**
     * VIN code pattern.
     */
    public const VIN = '/^[A-HJ-NPR-Z0-9]{17}$/';

    /**
     * Passport series pattern (Russian format).
     */
    public const PASSPORT_SERIES = '/^[0-9]{2}\s?[0-9]{2}$/';

    /**
     * Validate string against pattern.
     */
    public static function matches(string $pattern, string $value): bool
    {
        return preg_match($pattern, $value) === 1;
    }
}