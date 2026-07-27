<?php

declare(strict_types=1);

namespace App\Modules\Cargo\Config;

/**
 * Cargo module configuration.
 */
class CargoConfig
{
    /**
     * Default status for new cargo.
     */
    public string $defaultStatus = 'pending';

    /**
     * Available cargo statuses.
     */
    public array $statuses = [
        'pending' => 'Pending',
        'processing' => 'Processing',
        'in_transit' => 'In Transit',
        'delivered' => 'Delivered',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    /**
     * Weight unit.
     */
    public string $weightUnit = 'kg';

    /**
     * Currency.
     */
    public string $currency = '₽';
}