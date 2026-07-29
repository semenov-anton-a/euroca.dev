<?php

declare(strict_types=1);

namespace App\Services\View;

use CodeIgniter\HTTP\UserAgent;

/**
 * Toast service for displaying notifications.
 * Returns HX-Trigger headers for HTMX toast notifications.
 */
class ToastService
{
    /**
     * Send success toast message.
     */
    public function success(string $message, string $title = 'Success'): void
    {
        $this->triggerToaster('success', $title, $message);
    }

    /**
     * Send error toast message.
     */
    public function error(string $message, string $title = 'Error'): void
    {
        $this->triggerToaster('error', $title, $message);
    }

    /**
     * Send info toast message.
     */
    public function info(string $message, string $title = 'Info'): void
    {
        $this->triggerToaster('info', $title, $message);
    }

    /**
     * Trigger HX-Trigger header for toast.
     */
    protected function triggerToaster(string $type, string $title, string $message): void
    {
        $toastData = [
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ];

        header("HX-Trigger: showToast=" . json_encode($toastData));
    }
}