<?php

declare(strict_types=1);

namespace App\Services;

use CodeIgniter\I18n\Time;

/**
 * File storage service for managing uploaded files.
 * Handles file organization and storage paths.
 */
class FileStorageService
{
    /**
     * Base upload directory.
     */
    protected string $uploadPath;

    /**
     * Initialize storage paths.
     */
    public function __construct()
    {
        $this->uploadPath = WRITEPATH . 'uploads';
    }

    /**
     * Get cargo storage path.
     */
    public function getCargoPath(int $cargoId): string
    {
        return $this->uploadPath . "/cargo/{$cargoId}";
    }

    /**
     * Get cargo photos path.
     */
    public function getCargoPhotosPath(int $cargoId): string
    {
        return $this->getCargoPath($cargoId) . '/photos';
    }

    /**
     * Get cargo documents path.
     */
    public function getCargoDocumentsPath(int $cargoId): string
    {
        return $this->getCargoPath($cargoId) . '/documents';
    }

    /**
     * Get customer files path.
     */
    public function getCustomerPath(int $customerId): string
    {
        return $this->uploadPath . "/customers/{$customerId}";
    }

    /**
     * Get document storage path.
     */
    public function getDocumentPath(): string
    {
        return $this->uploadPath . '/documents';
    }

    /**
     * Generate unique filename with timestamp.
     */
    public function generateFilename(string $originalName): string
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $basename = pathinfo($originalName, PATHINFO_FILENAME);
        $timestamp = Time::now()->getTimestamp();
        $random = uniqid();

        return "{$basename}_{$timestamp}_{$random}.{$extension}";
    }
}