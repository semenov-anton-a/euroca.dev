<?php

declare(strict_types=1);

namespace App\Modules\Cargo\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Modules\Cargo\Services\CargoService;

/**
 * Cargo controller for logistics operations.
 * Handles cargo listing, creation, editing, and viewing.
 */
class Cargo extends BaseController
{
    protected CargoService $cargoService;

    public function __construct()
    {
        $this->cargoService = new CargoService();
    }

    /**
     * List all cargo items.
     */
    public function index(): string
    {
        $cargos = $this->cargoService->getAll();
        
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
    public function store(): ResponseInterface
    {
        // To be implemented
        return redirect()->to('/cargo');
    }

    /**
     * Show cargo details.
     */
    public function show(int $id): string
    {
        $cargo = $this->cargoService->find($id);
        
        return view('show', ['cargo' => $cargo]);
    }

    /**
     * Show cargo edit form.
     */
    public function edit(int $id): string
    {
        $cargo = $this->cargoService->find($id);
        
        return view('edit', ['cargo' => $cargo]);
    }

    /**
     * Update cargo.
     */
    public function update(int $id): ResponseInterface
    {
        // To be implemented
        return redirect()->to('/cargo');
    }

    /**
     * Delete cargo.
     */
    public function delete(int $id): ResponseInterface
    {
        // To be implemented
        return redirect()->to('/cargo');
    }

    /**
     * API index for HTMX.
     */
    public function apiIndex(): string
    {
        $cargos = $this->cargoService->getAll();
        
        return view('Cargo::parts/list', ['cargos' => $cargos]);
    }
}