<?php

declare(strict_types=1);

namespace App\Modules\Cargo\Models;

use CodeIgniter\Model;

/**
 * Cargo model for logistics tracking.
 * Handles cargo data operations.
 */
class CargoModel extends Model
{
    protected $table = 'cargo';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'number',
        'sender_name',
        'sender_phone',
        'recipient_name',
        'recipient_phone',
        'pickup_address',
        'delivery_address',
        'weight',
        'cost',
        'status',
        'pickup_date',
        'delivery_date',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'number' => 'required|is_unique[cargo.number,id,{id}]',
        'sender_name' => 'required|min_length[3]|max_length[100]',
        'recipient_name' => 'required|min_length[3]|max_length[100]',
        'pickup_address' => 'required',
        'delivery_address' => 'required',
        'weight' => 'required|decimal',
        'cost' => 'required|decimal',
    ];
}