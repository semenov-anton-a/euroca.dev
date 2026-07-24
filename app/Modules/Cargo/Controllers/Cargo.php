<?php

declare(strict_types=1);

namespace App\Modules\Cargo\Controllers;

use CodeIgniter\Controller;

/**
 * Cargo controller for logistics operations.
 * Handles cargo listing, creation, editing, and viewing.
 */
class Cargo extends Controller
{
    /**
     * List all cargo items.
     */
    public function index(): string
    {
        $cargoService = new \App\Modules\Cargo\Services\CargoService();
        $cargos = $cargoService->getAll();
        
        return view('index', ['cargos' => $cargos]);
    }

    /**
     * Show cargo creation form.
     */
    public function create(): string
    {
        return view('create');
    }

    /**
     * Store new cargo.
     */
    public function store(): void
    {
        // To be implemented
    }

    /**
     * Show cargo details.
     */
    public function show(int $id): string
    {
        $cargoService = new \App\Modules\Cargo\Services\CargoService();
        $cargo = $cargoService->find($id);
        
        return view('show', ['cargo' => $cargo]);
    }

    /**
     * Show cargo edit form.
     */
    public function edit(int $id): string
    {
        $cargoService = new \App\Modules\Cargo\Services\CargoService();
        $cargo = $cargoService->find($id);
        
        return view('edit', ['cargo' => $cargo]);
    }

    /**
     * Update cargo.
     */
    public function update(int $id): void
    {
        // To be implemented
    }

    /**
     * Delete cargo.
     */
    public function delete(int $id): void
    {
        // To be implemented
    }

    /**
     * API index for HTMX.
     */
    public function apiIndex(): string
    {
        $cargoService = new \App\Modules\Cargo\Services\CargoService();
        $cargos = $cargoService->getAll();
        
        return view('parts/list', ['cargos' => $cargos]);
    }
}