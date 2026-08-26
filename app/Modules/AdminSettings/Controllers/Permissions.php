<?php

declare(strict_types=1);

namespace App\Modules\AdminSettings\Controllers;
use CodeIgniter\HTTP\ResponseInterface;

class Permissions extends BaseAdminSettingsController
{      

    /**
     * Update of all data permission
     * @return ResponseInterface
     */
    public function update(): ResponseInterface | string
    {
        sleep(3);
        $this->htmxToastMessage( 'success', "FAKE - Permissions updated" );
        return $this->response;
    }
}