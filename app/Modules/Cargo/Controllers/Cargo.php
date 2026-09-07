<?php

declare(strict_types=1);

namespace App\Modules\Cargo\Controllers;


/**
 * Cargo controller for logistics operations.
 * Handles cargo listing, creation, editing, and viewing.
 */
class Cargo extends BaseCargoController
{  
    /**
     * List all cargo items.
     */
    public function index(): string
    {
        return $this->viewModule('index_test');
    }

    /**
     * Show cargo creation form.
     */
    // public function create(): string
    // {
    //     return $this->viewModule('create');
    // }

    // /**
    //  * Store new cargo.
    //  */
    // public function store(): ResponseInterface
    // {
    //     // To be implemented
    //     return redirect()->to('/cargo');
    // }

    // /**
    //  * Show cargo details.
    //  */
    // public function show(int $id): string
    // {

    //     return "TEST show";
    //     // $cargo = $this->cargoService->find($id);
        
    //     // return $this->viewModule('show', ['cargo' => $cargo]);
    // }

    // /**
    //  * Show cargo edit form.
    //  */
    // public function edit(int $id): string
    // {
        
    //     return "TEST edit";
    // }

    // /**
    //  * Update cargo.
    //  */
    // public function update(int $id): ResponseInterface
    // {
    //      return "TEST UPDATE";
    // }

    // /**
    //  * Delete cargo.
    //  */
    // public function delete(int $id): ResponseInterface
    // {
    //      return "TEST DELETE";
    // }

    // /**
    //  * API index for HTMX.
    //  */
    // public function apiIndex(): string
    // {
    //      return "TEST API iNDEX";
    // }
}