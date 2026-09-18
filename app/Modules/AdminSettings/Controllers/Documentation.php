<?php

namespace App\Modules\AdminSettings\Controllers;

use App\Controllers\BaseController;
class Documentation extends BaseController
{
    public function index()
    {
        return $this->viewModule("Docs/index");
    }
}