<?php

declare(strict_types=1);

namespace App\Modules\Cargo\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Cargo entity for logistics tracking.
 * Represents a cargo shipment in the system.
 */
class Cargo extends Entity
{
    protected $attributes = [
        'id' => null,
        'number' => null,
        'sender_name' => null,
        'sender_phone' => null,
        'recipient_name' => null,
        'recipient_phone' => null,
        'pickup_address' => null,
        'delivery_address' => null,
        'weight' => null,
        'cost' => null,
        'status' => 'pending',
        'pickup_date' => null,
        'delivery_date' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    protected $datamap = [];

    protected $dates = ['created_at', 'updated_at', 'pickup_date', 'delivery_date'];
    protected $casts = [
        'id' => 'int',
        'weight' => 'float',
        'cost' => 'float',
        'status' => 'string',
    ];

    /**
     * Get formatted weight with unit.
     */
    public function getFormattedWeight(): string
    {
        return number_format($this->weight, 2) . ' kg';
    }

    /**
     * Get formatted cost with currency.
     */
    public function getFormattedCost(): string
    {
        return number_format($this->cost, 2) . ' ₽';
    }

    /**
     * Check if cargo can be edited.
     */
    public function isEditable(): bool
    {
        return in_array($this->status, ['pending', 'processing']);
    }
}