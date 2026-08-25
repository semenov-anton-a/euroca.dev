<?php

// return $this->response
//     ->setHeader(
//         'HX-Trigger',
//         service('toastService')->trigger('alert', 'Привет')
//     )
//     ->setBody(
//         $this->viewModule('Roles/roledetalies')
//     );



declare(strict_types=1);

namespace App\Services\View;

class ToastService
{
    public function success(
        string $message,
        string $title = 'Success'
    ): array {
        return $this->trigger('alert', $title, $message);
    }

    public function danger(
        string $message,
        string $title = 'Error'
    ): array {
        return $this->trigger('alert', $title, $message);
    }

    public function warning(
        string $message,
        string $title = 'Warning'
    ): array {
        return $this->trigger('alert', $title, $message);
    }

    public function info(
        string $message,
        string $title = 'Information'
    ): array {
        return $this->trigger('alert', $title, $message);
    }

    public function alert(
        string $message,
        string $title = 'Notification'
    ): array {
        return $this->trigger('alert', $title, $message);
    }

    protected function trigger( string $type, string $title, string $message ): array 
    {
        return [ 'type' => $type, 'title' => $title, 'message' => $message, ];
    }
}