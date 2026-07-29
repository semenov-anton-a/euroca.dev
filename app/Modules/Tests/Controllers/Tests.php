<?php

namespace App\Modules\Tests\Controllers;


use App\Controllers\BaseController;


class Tests extends BaseController
{
    public function index() 
    {
        return $this->viewModule("postreq");
    }


    public function postreq() 
    {
        $data = $this->request->getPost();
        return $this->response->setJSON($data);
    }
}