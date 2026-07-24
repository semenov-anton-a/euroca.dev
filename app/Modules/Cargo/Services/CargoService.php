<?php

declare(strict_types=1);

namespace App\Modules\Cargo\Services;

use App\Modules\Cargo\Models\CargoModel;

/**
 * Cargo service for business logic.
 * Handles cargo operations with proper formatting and validation.
 */
class CargoService
{
    protected CargoModel $model;

    public function __construct()
    {
        $this->model = new CargoModel();
    }

    /**
     * Get all cargos with formatted data.
     */
    public function getAll(): array
    {
        $cargos = $this->model->findAll();
        
        return array_map(function ($cargo) {
            $cargo['formatted_weight'] = number_format($cargo['weight'], 2) . ' kg';
            $cargo['formatted_cost'] = number_format($cargo['cost'], 2) . ' ₽';
            return $cargo;
        }, $cargos);
    }

    /**
     * Find cargo by ID.
     */
    public function find(int $id): ?array
    {
        $cargo = $this->model->find($id);
        if ($cargo) {
            $cargo['formatted_weight'] = number_format($cargo['weight'], 2) . ' kg';
            $cargo['formatted_cost'] = number_format($cargo['cost'], 2) . ' ₽';
        }
        return $cargo;
    }

    /**
     * Create new cargo.
     */
    public function create(array $data): int
    {
        $data['number'] = 'CARGO-' . strtoupper(uniqid());
        return $this->model->insert($data);
    }

    /**
     * Update cargo.
     */
    public function update(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }

    /**
     * Delete cargo.
     */
    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }
}